<?php
require "./config.php";
require "./util.php";
redireccionarSiSesionInvalida();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="../Super brocoli.png"/>
	<title>Súper brócoli</title>
</head>
<body>
	<h1>La biblioteca de Super-broccoli</h1>

	<?php
		encabezadol("xd");
		echo "Bienvenido, <strong>" . $_SESSION["nombre"] . "</strong>";
	?>
	<br>
	<a href="cerrar.php"><button>Cerrar sesión</button></a>
 	<a href="perfil.php"><button>Ver Perfil</button></a> <!--No estoy seguro de como se vea pero se me ocurre que puede ir aqui.-->
	<br>

	<br><br>
	<fieldset>
		<legend>Busca el libro que necesites</legend>
		<form action="search_results.php" method="POST">

		<table border="1">
			<thead>
				<tr>
					<th>Géneros</th>
					<th>Autor</th>
					<th>Editorial</th>
					<th>Año</th>
					<th>Categoría</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<?php
						$c = conectdb();

						$consulta = "SELECT id_genero, genero FROM genero ORDER BY genero";

						$r = mysqli_query($c, $consulta);

						$generos = [];
						while($row=mysqli_fetch_array($r)) {
							$generos += [$row["id_genero"]=>$row["genero"]];
						}

						foreach ($generos as $id => $genero) {
							echo "<input type='checkbox' name='genero[]' value='$id'> $genero <br>";
						}
			
						?>
					</td>
					<td>
						<?php

						$consulta = "SELECT id_autor, nombre FROM autor ORDER BY nombre";

						$r = mysqli_query($c, $consulta);

						$autores = [];
						while($row=mysqli_fetch_array($r)) {
							$autores += [$row["id_autor"]=>$row["nombre"]];
						}

						foreach ($autores as $id => $autor) {
							echo "<input type='checkbox' name='autor[]' value='$id'> $autor <br>";
						}

						?>
					</td>
					<td>
						<?php
						$consulta = "SELECT id_editorial, editorial FROM editorial ORDER BY editorial";

						$r = mysqli_query($c, $consulta);
						
						$editoriales = [];
						while($row=mysqli_fetch_array($r)) {
							$editoriales += [$row["id_editorial"]=>$row["editorial"]];
						}

						foreach ($editoriales as $id => $editorial) {
							echo "<input type='checkbox' name='editorial[]' value='$id'> $editorial <br>";
						}

						?>
					
					</td>
					<td>
						<?php
						echo 'Desde: <input type="number" name="anno_min" max="' . date("Y") .'">';
						echo ' Hasta: <input type="number" name="anno_max" max="' . date("Y") .'">';
						?>
					</td>
					<td>
					<?php
						$consulta = "SELECT id_categoria, categoria FROM categoria";

						$r = mysqli_query($c, $consulta);
						
						$categorias = [];
						while($row=mysqli_fetch_array($r)) {
							$categorias += [$row["id_categoria"]=>$row["categoria"]];
						}

						foreach ($categorias as $id => $categoria) {
							echo "<input type='checkbox' name='categoria[]' value='$id'> $categoria <br>";
						}
						//cerrar conexión con base de datos
						mysqli_close($c);
						
						?>
					</td>
				</tr>
			</tbody>
		</table>
		<br><br>
			<label> Libro a buscar <br>
				<input type="text" name="palabra_clave">
			</label>
			<input type="hidden" name="busqueda" value="busqueda xd">
			<input type="submit" value="Buscar" name="busqueda">
		</form>
	</fieldset>

	<p>En este programa encontrarás libros de dominio público elegidos especialmente para tí</p>
</body>
</html>