<?php
$id = $_POST["num_cuenta"];
$nombre = $_POST["nombre"];
$prim_ape = $_POST["primer_apellido"];
$seg_ape = $_POST["segundo_apellido"];
$contra = $_POST["contra"];
$email = $_POST["email"];
$tipo = $_POST["tipo"];

$c = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($c, "biblioteca");

$consulta = "INSERT INTO usuario (num_cuenta_rfc, nombre, primer_apellido, segundo_apellido, contraseña, correo) VALUES ('$id', '$nombre', '$prim_ape', '$seg_ape', '$contra', '$email')";


$r = mysqli_query($c, $consulta);

var_dump($r);
echo "<br>";

$consulta = "CREATE USER '$nombre'@'localhost' IDENTIFIED BY '$contra'";
$r = mysqli_query($c, $consulta);
var_dump($r);
echo "<br>";

$id_tipo = "id_" . $tipo;
$consulta = "INSERT INTO $tipo VALUES ('$id_tipo', '$id')";
$r = mysqli_query($c, $consulta);
var_dump($r);
echo "<br>";

$consulta = "GRANT ALL PRIVILEGES ON biblioteca.* TO  '$nombre'@'localhost'";
$r = mysqli_query($c, $consulta);
var_dump($r);
echo "<br>";

mysqli_close($c);
?>