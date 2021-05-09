<?php

if (isset($_POST["email"])) {
	$contra = $_POST["contra"];
	$email = $_POST["email"];
}
else {
	header("location: ../templates/login.html");
}

$c = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($c, "biblioteca");

$consulta = "SELECT nombre FROM usuario WHERE correo='$email' AND contraseña='$contra'";


$r = mysqli_query($c, $consulta);

$contadorCoincidencias = 0;
while($row=mysqli_fetch_array($r))
{
	$nombre = $row["nombre"];
	$contadorCoincidencias ++;
}
mysqli_close($c);

if($contadorCoincidencias === 1) {
	session_start();
	$_SESSION["nombre"] = $nombre;
	header("location: ./index.php");
} 
else {
	header("location: ../templates/login.html");
}
?>

