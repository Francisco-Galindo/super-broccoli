<?php
session_start();
if (!isset($_SESSION["nombre"])) {
	header("location: login.php");
}
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
		echo "Bienvenido, <strong>" . $_SESSION["nombre"] . "</strong>";
	?>

	<br>
	<a href="cerrar.php"><button>Cerrar sesión</button></a>

	<br><br>
	<fieldset>
		<legend>Busca el libro que necesites</legend>
		<form action="">
			<label> Libro a buscar <br>
				<input type="text">
			</label>
			<input type="sumbit" value="Buscar">
		</form>
	</fieldset>

	<p>En este programa encontrarás libros de dominio público elegidos especialmente para tí</p>
</body>
</html>