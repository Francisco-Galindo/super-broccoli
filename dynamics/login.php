<?php
require "./config.php"
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
$c = conectdb($id_usuario, $password);
//comprueba que el email y la contraseña correspondan
$consulta = "SELECT num_cuenta_rfc, nombre FROM usuario WHERE correo='$email' AND contraseña='$contra';";


$r = mysqli_query($c, $consulta);
//Datos ingresados erroneamente
$contadorCoincidencias = 0;
while($row=mysqli_fetch_array($r))
{
	$nombre = $row["nombre"];
	$id_usuario = $row["num_cuenta_rfc"];
	$contadorCoincidencias ++;
}


mysqli_close($c);
//Datos correctos redirigir a la pagina de inicio
if($contadorCoincidencias === 1) {
	session_start();
	$_SESSION["nombre"] = $nombre;
	$_SESSION["id_usuario"] = $id_usuario;
	$_SESSION["password"] = $contra;
	header("location: ./index.php");
} 
//redirigir a la pagina de inicio de sesión
else {
	header("location: ../templates/login.html");
}
//cerrar conexión con base de datos
mysqli_close($c);
?>

