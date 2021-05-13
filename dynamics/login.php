<?php
require_once("./util.php");
require_once("./config.php");
session_start();

//si ya hay sesion iniciada redirigir
if(isset($_SESSION["id_usuario"])){
    header("location: ./index.php");
}
elseif (isset($_POST["email"])) {
	$contra = $_POST["contra"];
	$email = $_POST["email"];
}
//Declarar los valores ingresados en el inicio de sesión
//redirigir a la página de inicio de sesión
else {
	header("location: ../templates/login.html");
}
//conexión con base de datos
$c = connectdb();
//comprueba que el email y la contraseña correspondan
$consulta = "SELECT num_cuenta_rfc, nombre, id_tipo_usuario, fecha_nacimiento FROM usuario WHERE correo='$email' AND contraseña='$contra';";


$r = mysqli_query($c, $consulta);
//Datos ingresados erroneamente
$contadorCoincidencias = 0;
while($row=mysqli_fetch_array($r))
{
	$nombre = $row["nombre"];
	$id_usuario = $row["num_cuenta_rfc"];
	$tipo = $row["id_tipo_usuario"];
	$fecha = $row["fecha_nacimiento"];
	$contadorCoincidencias ++;
}

$consulta = "SELECT tipo FROM tipo_usuario WHERE id_tipo='$tipo';";
$r = mysqli_query($c, $consulta);
$row=mysqli_fetch_array($r);
$tipo = isset($row["tipo"]) ? $row["tipo"] : 1;

mysqli_close($c);

//Datos correctos redirigir a la pagina de inicio
if($contadorCoincidencias === 1) {
	session_start();
	$_SESSION["nombre"] = $nombre;
	$_SESSION["id_usuario"] = $id_usuario;
	$_SESSION["tipo_usuario"] = $tipo;
	$_SESSION["fecha_nacimiento"] = $fecha;

	header("location: ./index.php");
} 
//redirigir a la pagina de inicio de sesión
else {	
	header("location: ../templates/login.html");
}
?>