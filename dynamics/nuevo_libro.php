<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/png" href="../Super brocoli.png"/>
    <title>Galería</title>
</head>

<body>
    <?php
	require "./config.php";
	require "./util.php";
	redireccionarSiSesionInvalida();

    if (isset($_POST["formulario"])) {


			//Conexión con base de datos
			$c = conectdb($id_usuario, $password);

			
			if ($_POST["nuevo_autor_apellido"]) {

				$autorNombre = "";
				$autorNombre .= $_POST["nuevo_autor_apellido"];
				$autorNombre .= isset($_POST["nuevo_autor_nombre"]) ? ", " .  $_POST["nuevo_autor_nombre"]: "";

				//Join tables para mostrar los datos de el historial de descargas
				$consulta = "SELECT id_autor FROM autor WHERE nombre='$autorNombre';";
				//Consulta de base
				$r = mysqli_query($c, $consulta);

				//Datos ingresados erroneamente
				$contadorCoincidencias = 0;
				while($row=mysqli_fetch_array($r))
				{
					$id_autor = $row["id_autor"];
					$contadorCoincidencias ++;
				}

				if ($contadorCoincidencias == 0) {
					//Join tables para mostrar los datos de el historial de descargas
					$consulta1 = "INSERT INTO autor (nombre) VALUES ('$autorNombre');";
					//Consulta de base
					$r = mysqli_query($c, $consulta1);

					//Join tables para mostrar los datos de el historial de descargas
					$consulta2 = "SELECT id_autor FROM autor WHERE nombre='$autorNombre';";
					//Consulta de base
					$r = mysqli_query($c, $consulta2);

					while($row=mysqli_fetch_array($r))
					{
						$id_autor = $row["id_autor"];
					}
				}
			}
			elseif (isset($_POST["autor"])) {

				$id_autor = $_POST["autor"];
			}


			if (isset($_POST["nueva_editorial"]) && $_POST["nueva_editorial"] != "") {
				$nuevaEditorialNombre = $_POST["nueva_editorial"];

				//Join tables para mostrar los datos de el historial de descargas
				$consulta3 = "INSERT INTO editorial (editorial) VALUES ('$nuevaEditorialNombre');";
				//Consulta de base
				$r = mysqli_query($c, $consulta3);

				//Join tables para mostrar los datos de el historial de descargas
				$consulta4 = "SELECT id_editorial FROM editorial WHERE editorial='$nuevaEditorialNombre';";
				//Consulta de base
				$r = mysqli_query($c, $consulta4);

				//Datos ingresados erroneamente
				$contadorCoincidencias = 0;
				while($row=mysqli_fetch_array($r))
				{
					$id_editorial = $row["id_editorial"];
					$contadorCoincidencias ++;
				}
			}
			elseif (isset($_POST["editorial"])) {
				$id_editorial = $_POST["editorial"];
			}



			if (isset($_POST["anno"])) {
				$year = $_POST["anno"];
			} 
			else {
				$year = NULL;
			}

			if (isset($_POST["categoria"])) {
				$categoria = $_POST["categoria"];
			} 
			else {
				$categoria = NULL;
			}

			if (isset($_FILES['archivo'])) {
				$arch = $_FILES['archivo']['tmp_name'];
				$name = $_FILES['archivo']['name'];
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				if ($ext == "pdf") {
					$nombreArchivo = "";
					$nombreArchivo .= $_POST["titulo"] . "_" . $id_autor . "." . $ext;
					$rutaLibro = '../statics/libros/' . $nombreArchivo;
					rename($arch, $rutaLibro);
				}
			}

			$rutaImagen = '../statics/img_referencia/imagen_default.png';
			if (isset($_FILES['imagen'])) {
				$arch = $_FILES['imagen']['tmp_name'];
				$name = $_FILES['imagen']['name'];
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				if ($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
					$nombreArchivo = "";
					$nombreArchivo .= $_POST["titulo"] . "_" . $id_autor . "." . $ext;
					$rutaImagen = '../statics/img_referencia/' . $nombreArchivo;
					rename($arch, $rutaImagen);
				}
			}



			$titulo = $_POST["titulo"];
			$desc = $_POST["desc"];


			$consulta5 = "INSERT INTO libro (year, imagen_referencia, editorial, autor, descripcion, titulo, libro, categoria) VALUES ($year, '$rutaImagen', $id_editorial, $id_autor, '$desc', '$titulo', '$rutaLibro', $categoria);";

			$r = mysqli_query($c, $consulta5);


			$consulta6 = "SELECT id_libro FROM libro WHERE titulo='$titulo' AND autor=$id_autor;";

			$r = mysqli_query($c, $consulta6);
			while($row=mysqli_fetch_array($r)) {
				$id_libro = $row["id_libro"];
			}

			var_dump($_POST["generos"]);
			if (isset($_POST["generos"])) {
				foreach ($_POST["generos"] as $id_genero) {

					$consulta7 = "INSERT INTO libro_has_genero (id_libro, id_genero) VALUES ($id_libro, $id_genero);";

					$r = mysqli_query($c, $consulta7);
				}
			}

			//header("location: nuevo_libro.php");
			mysqli_close($c);

    }




    else {

			$c = mysqli_connect("localhost", "root", "");
			$consulta8 = "SELECT id_genero, genero FROM genero";

			$r = mysqli_query($c, $consulta8);

			$generos = [];
			while($row=mysqli_fetch_array($r)) {
				$generos += [$row["id_genero"]=>$row["genero"]];
			}

			$consulta9 = "SELECT id_editorial, editorial FROM editorial";

			$r = mysqli_query($c, $consulta9);

			$editoriales = [];
			while($row=mysqli_fetch_array($r)) {
				$editoriales += [$row["id_editorial"]=>$row["editorial"]];
			}

			$consulta10 = "SELECT id_autor, nombre FROM autor";

			$r = mysqli_query($c, $consulta10);

			$autores = [];
			while($row=mysqli_fetch_array($r)) {
				$autores += [$row["id_autor"]=>$row["nombre"]];
			}


			$consulta11 = "SELECT id_categoria, categoria FROM categoria";

			$r = mysqli_query($c, $consulta11);

			$categorias = [];
			while($row=mysqli_fetch_array($r)) {
				$categorias += [$row["id_categoria"]=>$row["categoria"]];
			}


			mysqli_close($c);

			echo '<fieldset>
							<legend><h2>Registro de nuevo libro</h2></legend>
								<form action="nuevo_libro.php" method="POST" enctype="multipart/form-data">
									<label>
										Título:
										<input type="text" name="titulo" required>
									</label>
									<br><br>
									<label>
										Autor (solo autor principal):'; 
										
										if (count($autores) > 0) {
											echo '<br><select name="autor">';
											foreach ($autores as $id => $autor) {
												echo "<option value='$id'>$autor</option>";
											}
											echo "</select><br>
											Otro (especificar): <br> 
											Nombre(s): <input type='text' name='nuevo_autor_nombre'> <br>
											Apellido(s): <input type='text' name='nuevo_autor_apellido'> <br>";
										}
										else {
											echo "<br>Nombre(s): <input type='text' name='nuevo_autor_nombre' required> <br>
											Apellido(s): <input type='text' name='nuevo_autor_apellido' required>";
										}
									echo	'
									</label>
									<br><br>
									<label>
										Editorial:
										';

										if (count($editoriales) > 0) {
											echo '<br><select name="editorial">';
											foreach ($editoriales as $id => $editorial) {
												echo "<option value='$id'>$editorial</option>";
											}
											echo "</select><br>
											Otra (especificar): <input type='text' name='nueva_editorial'>";
										}
										else {
											echo '<input type="text" name="nueva_editorial" required>';
										}
										
										echo '
									</label>
									<br><br>
									<label>
										Año de publicación:
										<input type="number" name="anno" max="' . date("Y") .'" required>
									</label>
									<br><br>
									Géneros
									<br>';


									foreach ($generos as $id => $genero) {
										echo '<label><input type="checkbox" name="generos[]" value="' . $id . '">' . $genero . '</label><br>';
									}
									echo "<br><br>Categoría:
									<select name='categoria'>";
									foreach ($categorias as $id => $categoria) {
										echo '<option value="' . $id . '">' . $categoria . '</option>';
									}
									echo "</select>";

									echo '<br><br>
									<label>
										Descripción: <br> 
										<textarea  rows="4" cols="50" name="desc"></textarea>
									</label>
									<br><br>
									<label>
										Sube el archivo del libro:
										<input type="file" name="archivo" required>
									</label>
									<br><br>
									<label>
										Sube una imagen de referencia:
										<input type="file" name="imagen">
									</label>
									<br><br>
									<input type="submit" name="formulario" value="Subir libro">
								</form>
						</fieldset>';
    }
    ?>

</body>
</html>
</body>
</html>