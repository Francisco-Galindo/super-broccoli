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
	require_once("./util.php");
	require_once("./config.php");


	redireccionarSiSesionInvalida();
	encabezados($_SESSION["tipo_usuario"]);

	$valorTitulo =  "";
	$valorAnno = date("Y");
	$valorDescripcion = "";

    if (isset($_POST["formulario"]) || isset($_POST["editar"])) {


		//Conexión con base de datos
		$c = connectdb();

		if ($_POST["nuevo_autor_apellido"]) {

			$autorNombre = "";
			$autorNombre .= $_POST["nuevo_autor_apellido"];
			$autorNombre .= isset($_POST["nuevo_autor_nombre"]) ? ", " .  $_POST["nuevo_autor_nombre"]: "";

			//Join tables para mostrar los datos de el historial de descargas
			$consulta = "SELECT id_autor FROM autor WHERE nombre='$autorNombre';";
			//Consulta de base
			$r = mysqli_query($c, $consulta);


			if (!$r || mysqli_num_rows($r) == 0) {
				//Join tables para mostrar los datos de el historial de descargas
				$consulta = "INSERT INTO autor (nombre) VALUES ('$autorNombre');";
				//Consulta de base
				$r = mysqli_query($c, $consulta);
			}

			// Obteniendo la id del autor recién creado
			$consulta = "SELECT id_autor FROM autor WHERE nombre='$autorNombre';";
			//Consulta de base
			$r = mysqli_query($c, $consulta);

			$row = mysqli_fetch_array($r);
			$id_autor = $row["id_autor"];
		}
		elseif (isset($_POST["autor"])) {
			$id_autor = $_POST["autor"];
		}


		if (isset($_POST["nueva_editorial"]) && $_POST["nueva_editorial"] != "") {
			$nuevaEditorialNombre = $_POST["nueva_editorial"];
			$consulta = "SELECT id_editorial FROM editorial WHERE editorial='$nuevaEditorialNombre';";
			//Consulta de base
			$r = mysqli_query($c, $consulta);


			if (!$r || mysqli_num_rows($r) == 0) {
				$consulta = "INSERT INTO editorial (editorial) VALUES ('$nuevaEditorialNombre');";
				//Consulta de base
				$r = mysqli_query($c, $consulta);
			}


			$consulta = "SELECT id_editorial FROM editorial WHERE editorial='$nuevaEditorialNombre';";
			$r = mysqli_query($c, $consulta);

			$row = mysqli_fetch_array($r);
			$id_editorial = $row["id_editorial"];
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


		if (isset($_POST["editar"])) {
			$id_libro = $_POST["id_libro"];

			if (!isset($_FILES['archivo']) || $_FILES['archivo']['size'] == 0) {
				$consulta = "SELECT libro FROM libro WHERE id_libro=$id_libro;";
				$r = mysqli_query($c, $consulta);
				$rutaLibro = mysqli_fetch_array($r)["libro"];

			}
			if (!isset($_FILES['imagen']) || $_FILES['imagen']['size'] == 0) {
				$consulta = "SELECT imagen_referencia FROM libro WHERE id_libro=$id_libro;";
				$r = mysqli_query($c, $consulta);
				$rutaLibro = mysqli_fetch_array($r)["imagen_referencia"];

			}

			$consulta = "UPDATE libro 
			SET year=$year, imagen_referencia='$rutaImagen', editorial=$id_editorial, autor=$id_autor, descripcion='$desc', titulo='$titulo', libro='$rutaLibro', categoria=$categoria 
			WHERE id_libro=$id_libro;";

			$r = mysqli_query($c, $consulta);
		}
		else {
			$consulta = "INSERT INTO libro (year, imagen_referencia, editorial, autor, descripcion, titulo, libro, categoria) VALUES ($year, '$rutaImagen', $id_editorial, $id_autor, '$desc', '$titulo', '$rutaLibro', $categoria);";

			$r = mysqli_query($c, $consulta);
		}


		$consulta = "SELECT id_libro FROM libro WHERE titulo='$titulo' AND autor=$id_autor;";

		$r = mysqli_query($c, $consulta);
		while($row=mysqli_fetch_array($r)) {
			$id_libro = $row["id_libro"];
		}

		if (isset($_POST["generos"])) {
			foreach ($_POST["generos"] as $id_genero) {

				$consulta = "INSERT INTO libro_has_genero (id_libro, id_genero) VALUES ($id_libro, $id_genero);";

				$r = mysqli_query($c, $consulta);
			}
		}

		mysqli_close($c);

		if ($r) {
			if (isset($_POST["editar"])) {
				echo "<h2>Libro editado correctamente</h2>";
			}
			else {
				echo "<h2>Libro creado correctamente</h2>";
			}
			echo '<a href="./index.php"><button>Regresar a página principal</button></a>';
		}
		//header("location: ./formulario_libro.php");
    }


    else {

		$c = connectdb();
		$consulta = "SELECT id_genero, genero FROM genero";

		$r = mysqli_query($c, $consulta);

		$generos = [];
		while($row = mysqli_fetch_array($r)) {
			$generos += [$row["id_genero"] => $row["genero"]];
		}

		$consulta = "SELECT id_editorial, editorial FROM editorial";

		$r = mysqli_query($c, $consulta);

		$editoriales = [];
		while($row = mysqli_fetch_array($r)) {
			$editoriales += [$row["id_editorial"] => $row["editorial"]];
		}

		$consulta = "SELECT id_autor, nombre FROM autor";

		$r = mysqli_query($c, $consulta);

		$autores = [];
		while($row = mysqli_fetch_array($r)) {
			$autores += [$row["id_autor"] => $row["nombre"]];
		}


		$consulta = "SELECT id_categoria, categoria FROM categoria";

		$r = mysqli_query($c, $consulta);

		$categorias = [];
		while($row=mysqli_fetch_array($r)) {
			$categorias += [$row["id_categoria"] => $row["categoria"]];
		}

		if (isset($_POST["prellenar"])) {
			$id_libro = $_POST["id_libro"];

			$consulta = "SELECT * FROM libro WHERE id_libro=$id_libro";
			$r = mysqli_query($c, $consulta);
			$row = mysqli_fetch_array($r);

			$valorAutor = $row["autor"];
			$valorEditorial = $row["editorial"];
			$valorCategoria = $row["categoria"];

			$valorTitulo =  $row["titulo"];
			$valorAnno = $row["year"];
			$valorDescripcion = $row["descripcion"];


			$consulta = "SELECT id_autor, nombre FROM autor WHERE id_autor=$valorAutor";
			$r = mysqli_query($c, $consulta);
			$row = mysqli_fetch_array($r);
			$valorAutor = [$valorAutor => $row["nombre"]];
			$autores = array_unique($valorAutor + $autores);

			
			$consulta = "SELECT id_editorial, editorial FROM editorial 
			WHERE id_editorial=$valorEditorial";
			$r = mysqli_query($c, $consulta);
			$row = mysqli_fetch_array($r);
			$valorEditorial = [$valorEditorial => $row["editorial"]];
			$editoriales = array_unique($valorEditorial + $editoriales);

			$valoresGenero = [];

			$consulta = "SELECT id_categoria, categoria FROM categoria 
			WHERE id_categoria=$valorCategoria";
			$r = mysqli_query($c, $consulta);
			$row = mysqli_fetch_array($r);
			$valorCategoria = [$valorCategoria => $row["categoria"]];
			$categorias = array_unique($valorCategoria + $categorias);

		}


		mysqli_close($c);

		echo '<fieldset>
						<legend><h2>Registro de nuevo libro</h2></legend>
							<form action="formulario_libro.php" method="POST" enctype="multipart/form-data">
								<label>
									Título:
									<input type="text" name="titulo" value="'.$valorTitulo.'" required>
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
									<input type="number" name="anno" max="' . date("Y") .'" value="'.$valorAnno.'" required>
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
									<textarea  rows="4" cols="50" name="desc">'.$valorDescripcion.'</textarea>
								</label>
								<br><br>
								<label>
									';
									if (isset($_POST["prellenar"])) {
										echo 'Sube el archivo del libro (opcional): <input type="file" name="archivo" >';
									}
									else {
										echo 'Sube el archivo del libro: <input type="file" name="archivo" required>';
									}
									
								echo '</label>
								<br><br>
								<label>
									Sube una imagen de referencia (opcional):
									<input type="file" name="imagen">
								</label>
								<br><br>';
								if (isset($_POST["prellenar"])) {
									$id_libro = $_POST["id_libro"];
									echo '<input type="hidden" value="'.$id_libro.'" name="id_libro">';
									echo '<input type="submit" name="editar" value="Editar libro">';
								}
								else {
									echo '<input type="submit" name="formulario" value="Subir libro">';
								}
							echo '</form>
					</fieldset>';
    }
    ?>

</body>
</html>
</body>
</html>