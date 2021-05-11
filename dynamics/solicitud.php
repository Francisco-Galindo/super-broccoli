<?php
require "./config.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="../Super brocoli.png"/>
	<title>Log in</title>
</head>
<body>
<?php
//Declarar lo ingresado en el formulario
$obra = $_POST["Obra"];
$autor = $_POST["Autor"];
$año = $_POST["año"];
$editorial = $_POST["editorial"];
$edición = $_POST["Edición"];
$razon = $_POST["razon"];
//Conectar con la base de datos
$c = conectdb($id_usuario, $password);
//Insertar valores en base de datos
$consulta = "INSERT INTO formulario (obra, autor, publicacion, editorial, edicion, razon) VALUES ('$obra','$autor', '$año', '$editorial', '$edición', '$razon');";
//resultado de la busqueda
$r = mysqli_query($c, $consulta);
//cerrar conexion con base de datos
mysqli_close($c);

var_dump($r);
echo "<br>";
?>