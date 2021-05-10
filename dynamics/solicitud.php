<?php
//Declarar lo ingresado en el formulario
$obra = $_POST["Obra"];
$autor = $_POST["Autor"];
$año = $_POST["año"];
$editorial = $_POST["editorial"];
$edición = $_POST["Edición"];
$razon = $_POST["razon"];
//Conectar con la base de datos
$c = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($c, "biblioteca");
//Insertar valores en base de datos
$consulta = "INSERT INTO formulario (obra, autor, publicacion, editorial, edicion, razon) VALUES ('$obra','$autor', '$año', '$editorial', '$edición', '$razon');";
//resultado de la busqueda
$r = mysqli_query($c, $consulta);
//cerrar conexion con base de datos
mysqli_close($c);

var_dump($r);
echo "<br>";
?>