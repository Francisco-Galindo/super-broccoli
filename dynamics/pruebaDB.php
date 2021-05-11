<?php
require "./config.php"
//Declarar valores de crear cuenta
$id = $_POST["num_cuenta"];
$nombre = $_POST["nombre"];
$prim_ape = $_POST["primer_apellido"];
$seg_ape = $_POST["segundo_apellido"];
$contra = $_POST["contra"];
$email = $_POST["email"];
//Conexión con base de datos
$c = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($c, "biblioteca");
//Insertar valores para nuevos usuarios
$consulta = "INSERT INTO usuario (num_cuenta_rfc, nombre, primer_apellido, segundo_apellido, contraseña, correo) VALUES ('$id', '$nombre', '$prim_ape', '$seg_ape', '$contra', '$email')";

//consulta de usuarios
$r = mysqli_query($c, $consulta);

var_dump($r);
echo "<br>";
//Creación de usuario con lo contestado en el formulario para crear cuenta
$consulta = "CREATE USER '$nombre'@'localhost' IDENTIFIED BY '$contra'";
$r = mysqli_query($c, $consulta);
var_dump($r);
//cerrar conexión con base de datos
mysqli_close($c);
?>