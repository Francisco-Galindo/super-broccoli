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
$c = mysqli_connect("localhost", "root", "", "biblioteca");
//comprueba que el email y la contraseña correspondan
$consulta = "SELECT num_cuenta_rfc, nombre FROM usuario WHERE correo='$email' AND contraseña='$contra';";


$r = mysqli_query($c, $consulta);
//Datos ingresados erroneamente
$contadorCoincidencias = 0;
while($row=mysqli_fetch_array($r))
{
	$nombre = $row["nombre"];
	$id_usuario = $row["num_cuenta_rfc"];
	$tipo = $row["id_tipo_usuario"];
	$contadorCoincidencias ++;
}


mysqli_close($c);
//Datos correctos redirigir a la pagina de inicio
if($contadorCoincidencias === 1) {
	session_start();
	$_SESSION["nombre"] = $nombre;
	$_SESSION["id_usuario"] = $id_usuario;
	$_SESSION["password"] = $contra;
	$_SESSION["tipo_usuario"] = $tipo;

	header("location: ./index.php");
} 
//redirigir a la pagina de inicio de sesión
else {
	header("location: ../templates/login.html");
}
//cerrar conexión con base de datos
mysqli_close($c);
?>

