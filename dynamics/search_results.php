<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Resultados de búsqueda</title>
</head>
<body>

<a href="cerrar.php"><button>Cerrar sesión</button></a>

<?php
session_start();


if (isset($_POST["busqueda"])) {
	//Conexión con base de datos
	$c = mysqli_connect("localhost", "root", "");
	$db = mysqli_select_db($c, "biblioteca");

	$filtros = "";
	
	// $contador = 0;
	// foreach ($_POST["genero"] as $genero) {
	// 	if ($contador  > 0) {
	// 		$filtros .= "OR ";
	// 	}
	// 	$filtros .= "id"$genero;
	// 	$contador ++;
	// }


	$contador = 0;
	foreach ($_POST["autor"] as $autor) {
		if ($contador== 0) {
			$filtros .= " (";
		}
		elseif ($contador  > 0) {
			$filtros .= " OR ";
		}
		$filtros .= "autor = " . $autor;
		$contador ++;
	}

	if ($contador > 0) {
		$filtros .= ") ";
	}
	else if ($contador == 0) {
		$filtros = (' 1=1 ');
	}
	$contador = 0;
	foreach ($_POST["editorial"] as $editorial) {
		if ($contador== 0) {
			$filtros .= "AND (";
		}
		elseif ($contador  > 0) {
			$filtros .= " OR ";
		}
		$filtros .= "editorial = " . $editorial;
		$contador ++;
	}
	if ($contador > 0) {
		$filtros .= ")";
	}

	$consulta = "SELECT * FROM libros WHERE" . $filtros . ";";
	//Consulta de base
	echo "<br>" . $consulta . "<br>";
	$r = mysqli_query($c, $consulta);

	echo "<table border='1'><tbody>";
	while($row=mysqli_fetch_array($r)) {

		echo "<tr>";
		echo "<td>";
		echo "<img height='250' src='" . $row["imagen_referencia"] . "'>";
		echo "<br>Titulo: " . $row["titulo"];
		echo "<br>id: " . $row["id_libro"];
		echo "<br>year: " . $row["year"];
		echo "<br>editorial: " . $row["editorial"];
		echo "<br>autor: " . $row["autor"];
		echo '<br>';
		echo "</td>";
		echo "</tr>";
	}
	echo "</tbody></table>";
	echo "<br>"
	echo'<form action="./mas_información.php" method= "POST">
	<input type="submit" value="mas información" name="mas información">
	</form>';

	mysqli_close($c);
}

// if (!isset($_SESSION["nombre"])) {
//     header("location: ./login.php");
	
// }

?>

</body>
</html>