<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    if (isset($_POST["titulo"])) {
			// subirlo a la base de datos

			//header("location: nuevo_libro.php");
			echo "XD";
    }
    else {

			$c = mysqli_connect("localhost", "root", "");
			$db = mysqli_select_db($c, "biblioteca");

			$consulta = "SELECT genero FROM genero";

			$r = mysqli_query($c, $consulta);

			$generos = [];
			while($row=mysqli_fetch_array($r)) {
				array_push($generos, $row["genero"]);
			}

			$consulta = "SELECT editorial FROM editorial";

			$r = mysqli_query($c, $consulta);

			$editoriales = [];
			while($row=mysqli_fetch_array($r)) {
				array_push($generos, $row["editorial"]);
			}

			$consulta = "SELECT nombre FROM autor";

			$r = mysqli_query($c, $consulta);

			$autores = [];
			while($row=mysqli_fetch_array($r)) {
				array_push($generos, $row["nombre"]);
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
											foreach ($autores as $autor) {
												echo "<option value='$autor'>$autor</option>";
											}
											echo "</select><br>
											Otro (especificar): <input type='text' name='autor' required>";
										}
										else {
											echo '<input type="text" name="autor" required>';
										}
									echo	'
									</label>
									<br><br>
									<label>
										Editorial:
										';

										if (count($editoriales) > 0) {
											echo '<br><select name="editorial">';
											foreach ($editoriales as $editorial) {
												echo "<option value='volvo'>$editorial</option>";
											}
											echo "</select><br>
											Otra (especificar): <input type='text' name='editorial' required>";
										}
										else {
											echo '<input type="text" name="editorial" required>';
										}
										
										echo '
									</label>
									<br><br>
									<label>
										Año de publicación:
										<input type="number" name="anno" required>
									</label>
									<br><br>
									Géneros
									<br>';


									foreach ($generos as $genero) {
										echo '<label><input type="checkbox" name="generos[]">' . $genero . '</label><br>';
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
									<input type="submit">
								</form>
						</fieldset>';
    }
    ?>
    
</body>
</html>
</body>
</html>