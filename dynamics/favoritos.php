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
	<title>Favoritos</title>
</head>
<body>
<?php

if(isset($_POST["favoritos"]));{
    $c = conectdb($_SESSION["id_usuario"], $_SESSION["password"]);

    $consulta = "SELECT * FROM libro t1
	INNER JOIN favoritos t2 ON t1.id_libro = t2.id_libro 
    INNER JOIN usuario t3 ON t3.id_usuario = t2.id_usuario;";
	//Consulta de base
	echo "<br>" . $consulta . "<br>";
	$r = mysqli_query($c, $consulta);
    
    echo "<table border='1'><tbody>";
	while($row=mysqli_fetch_array($r)) {
		$id_libro = $row["id_libro"];

		echo "<tr>";
		echo "<td>";
		echo "<img height='250' src='" . $row["imagen_referencia"] . "'>";
		echo "<br><strong>Titulo: </strong>" . $row["titulo"];
		echo "<br><strong>ID: </strong>" . $row["id_libro"];

        echo'<form action="./mas_informacion.php" method= "POST">
		<input type="hidden" name="id_libro" value="' . $id_libro . '">
		<input type="submit" value="Mas información" name="mas información">
		</form>';
        echo'<form>
		<input type="submit" value="Eliminar de favoritos" name="eliminar">
		</form>';
        if (isset($_POST["eliminar"])) {
        $consulta="DELETE FROM favoritos WHERE id_libro=$id_libro;";
        }
    } 
    mysqli_close($c);
}
?>