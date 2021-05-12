<?php
require_once("./util.php");
require_once("./config.php");
redireccionarSiSesionInvalida();
?>

<?php

//Declarar lo ingresado en el formulario
$usuario=$_SESSION["id_usuario"];
$obra = $_POST["obra"];
$autor = $_POST["autor"];
$año = $_POST["año"];
$editorial = $_POST["editorial"];
$edición = $_POST["edicion"];
$razon = $_POST["razon"];
//Conectar con la base de datos
$c = connectdb();
//Insertar valores en base de datos
$consulta = "INSERT INTO formulario (id_usuario, obra, autor, publicacion, editorial, edicion, razon) VALUES ('$usuario','$obra','$autor', '$año', '$editorial', '$edición', '$razon');";
//resultado de la busqueda
$r = mysqli_query($c, $consulta);
//cerrar conexion con base de datos
mysqli_close($c);

var_dump($r);
echo "<br>";
header("location: ./index.php");
?>