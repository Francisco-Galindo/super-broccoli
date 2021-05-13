<?php
session_start();
session_unset();
session_destroy();
require_once("./util.php");
require_once("./config.php");
?>
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
//Declarar valores de crear cuenta
if (isset($_POST["num_cuenta"])) {
	$id = strtoupper($_POST["num_cuenta"]);
	$nombre = strtoupper($_POST["nombre"]);
	$prim_ape = strtoupper($_POST["primer_apellido"]);
	$seg_ape = strtoupper($_POST["segundo_apellido"]);
	$contra = $_POST["contra"];
	$fecha = $_POST["fecha"];
	$email = $_POST["email"];
	$dominio = explode("@", $email)[1];
	$tipo = $_POST["tipo"];
}
//Redirigir a la pagina de registro


//Abrir conexión con base de datos
$c = connectdb();

$consulta = "SELECT id_tipo FROM tipo_usuario WHERE tipo='$tipo';";
$r = mysqli_query($c, $consulta);
$row=mysqli_fetch_array($r);
$id_tipo_usuario = isset($row["id_tipo"]) ? $row["id_tipo"] : 1;

if (! ($dominio == "enp.unam.mx" || $dominio == "comunidad.unam.mx")) {
	$error = "El dominio de correo electrónico no es válido. Utilizar alguno con el dominio 'enp.unam.mx' o 'comunidad.unam.mx'.";
}

$consulta = "SELECT num_cuenta_rfc FROM usuario  
WHERE num_cuenta_rfc='$id' 
OR (nombre='$nombre' AND primer_apellido='$prim_ape' AND segundo_apellido='$seg_ape') 
OR correo='$email'";
$r = mysqli_query($c, $consulta);

if (mysqli_num_rows($r) == 0 && !(isset($error) && $error != "")) {
	//Ingresar los valores del formulario en la tabla usuarios
	$consulta = "INSERT INTO usuario (num_cuenta_rfc, nombre, primer_apellido, segundo_apellido, contraseña, correo,  id_tipo_usuario, fecha_nacimiento) VALUES ('$id', '$nombre', '$prim_ape', '$seg_ape', '$contra', '$email', $id_tipo_usuario, '$fecha')";
	$r = mysqli_query($c, $consulta);
}
else {
	$error = "Ya existe una cuenta relacionada con esta persona.";
}

//Redirigir a la página de inicio
if (! (isset($error) && $error != "" )) {
	session_start();

	//Guardado de los datos del usuario en variables de sesión.
	$_SESSION["id_usuario"] = $id;
	$_SESSION["nombre"] = $nombre;
	$_SESSION["tipo_usuario"] = $tipo;

	header("location: ./index.php");
} 
//Redirigir a la pagina de registro
else {
	echo "ERROR: " . $error;
	echo '<br><a href="../templates/register.html"><button>Volver a intentar</button></a>';
}
?>


