<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/png" href="../Super brocoli.png"/>
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería</title>
</head>
<body>
    <?php

		session_start();
		if (!isset($_SESSION["nombre"])) {
			header("location: login.php");
		}



    if (isset($_POST["formulario"])) {


			//Conexión con base de datos
			$c = mysqli_connect("localhost", "root", "");
			$db = mysqli_select_db($c, "biblioteca");

			//Join tables para mostrar los datos de el historial de descargas
			$consulta = "SELECT fecha, titulo, autor, nombre
			FROM historial_descargas t1
			INNER JOIN libros t2 ON t1.id_libro = t2.id_libro
			INNER JOIN usuario t3 ON t1.id_usuario = t3.num_cuenta_rfc
			ORDER BY fecha DESC;";

			//Consulta de base
			$r = mysqli_query($c, $consulta);


			if (isset($_POST["autor"])) {

				$id_autor = $_POST["autor"];
			}
			elseif ($_POST["nuevo_autor_apellido"]) {

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
					$consulta = "INSERT INTO autor (nombre) VALUES ('$autorNombre');";
					//Consulta de base
					$r = mysqli_query($c, $consulta);

					//Join tables para mostrar los datos de el historial de descargas
					$consulta = "SELECT id_autor FROM autor WHERE nombre='$autorNombre';";
					//Consulta de base
					$r = mysqli_query($c, $consulta);

					while($row=mysqli_fetch_array($r))
					{
						$id_autor = $row["id_autor"];
					}
				}
			}

			if (isset($_POST["editorial"])) {
				$id_editorial = $_POST["editorial"];
			}
			elseif (isset($_POST["nueva_editorial"])) {
				$nuevaEditorialNombre = $_POST["nueva_editorial"];

				//Join tables para mostrar los datos de el historial de descargas
				$consulta = "INSERT INTO editorial (editorial) VALUES ('$nuevaEditorialNombre');";
				//Consulta de base
				$r = mysqli_query($c, $consulta);

				//Join tables para mostrar los datos de el historial de descargas
				$consulta = "SELECT id_autor FROM autor WHERE nombre='$autorNombre';";
				//Consulta de base
				$r = mysqli_query($c, $consulta);

				//Datos ingresados erroneamente
				$contadorCoincidencias = 0;
				while($row=mysqli_fetch_array($r))
				{
					$id_editorial = $row["id_autor"];
					$contadorCoincidencias ++;
				}
			}



			if (isset($_POST["anno"])) {
				$year = $_POST["anno"];
			} 
			else {
				$year = NULL;
			}

			if (isset($_POST["genero"])) {
				$genero = $_POST["genero"];
			} 
			else {
				$genero = NULL;
			}

			if (isset($_FILES['archivo'])) {
				$arch = $_FILES['archivo']['tmp_name'];
				$name = $_FILES['archivo']['name'];
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				if ($ext == "pdf") {
					$nombreArchivo = "";
					$nombreArchivo .= $_POST["titulo"] . "_" . $id_autor . "." . $ext;
					$rutaLibro = '../libros/' . $nombreArchivo;
					rename($arch, $rutaLibro);
				}
			}
			$titulo = $_POST["titulo"];

			//Join tables para mostrar los datos de el historial de descargas
			$consulta = "INSERT INTO libros (year, editorial, autor, titulo, libro) VALUES ($year, $id_editorial, $id_autor, '$titulo', '$rutaLibro');";
			//Consulta de base
			$r = mysqli_query($c, $consulta);
			//header("location: nuevo_libro.php");
			mysqli_close($c);

    }



		
    else {

			if (isset($_SESSION["Error"])) {
				echo $_SESSION["Error"] . "<br>";
			}

			$c = mysqli_connect("localhost", "root", "");
			$db = mysqli_select_db($c, "biblioteca");

			$consulta = "SELECT id_genero, genero FROM genero";

			$r = mysqli_query($c, $consulta);

			$generos = [];
			while($row=mysqli_fetch_array($r)) {
				$generos += [$row["id_genero"]=>$row["genero"]];
			}

			$consulta = "SELECT id_editorial, editorial FROM editorial";

			$r = mysqli_query($c, $consulta);

			$editoriales = [];
			while($row=mysqli_fetch_array($r)) {
				$editoriales += [$row["id_editorial"]=>$row["editorial"]];
			}

			$consulta = "SELECT id_autor, nombre FROM autor";

			$r = mysqli_query($c, $consulta);

			$autores = [];
			while($row=mysqli_fetch_array($r)) {
				$autores += [$row["id_autor"]=>$row["nombre"]];
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

									echo '<br><br>
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