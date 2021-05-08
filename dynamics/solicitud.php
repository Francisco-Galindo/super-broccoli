<?php
$obra = $_POST["Obra"];
$autor = $_POST["Autor"];
$año = $_POST["año"];
$editorial = $_POST["editorial"];
$edición = $_POST["Edición"];
$razon = $_POST["razon"];

$c = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($c, "biblioteca");

$consulta = "INSERT INTO formulario (obra, autor, publicacion, editorial, edicion, razon) VALUES ('$obra','$autor', '$año', '$editorial', '$edición', '$razon')";

$r = mysqli_query($c, $consulta);

var_dump($r);
echo "<br>";
?>