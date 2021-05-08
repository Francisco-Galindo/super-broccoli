<?php
$contra = $_POST["contra"];

$email = $_POST["email"];

$c = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($c, "biblioteca");

$consulta = "SELECT nombre FROM usuario WHERE correo='$email' AND contraseña='$contra'";


$r = mysqli_query($c, $consulta);

while($row=mysqli_fetch_array($r))
{
	echo($row["nombre"]);
}

mysqli_close($c);
?>

