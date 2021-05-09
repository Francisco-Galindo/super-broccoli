<?php
//Declarar los valores ingresados en el inicio de sesión
if (isset($_POST["email"])) {
	$contra = $_POST["contra"];
	$email = $_POST["email"];
}
//redirigir a la página de inicio de sesión
else {
	header("location: ../templates/login.html");
}
//conexión con base de datos
$c = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($c, "biblioteca");
//comprueba que el email y la contraseña correspondan
$consulta = "SELECT nombre FROM usuario WHERE correo='$email' AND contraseña='$contra'";


$r = mysqli_query($c, $consulta);
//Datos ingresados erroneamente
$contadorCoincidencias = 0;
while($row=mysqli_fetch_array($r))
{
	$nombre = $row["nombre"];
	$contadorCoincidencias ++;
}


mysqli_close($c);
//Datos correctos redirigir a la pagina de inicio
if($contadorCoincidencias === 1) {
	session_start();
	$_SESSION["nombre"] = $nombre;
	header("location: ./index.php");
} 
//redirigir a la pagina de inicio de sesión
else {
	header("location: ../templates/login.html");
}
?>

