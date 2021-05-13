<?php
    require_once("./util.php");
    require_once("./config.php");
    
    redireccionarSiSesionInvalida();
?>
    <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="../Super brocoli.png"/>
	<title>Formulario</title>
</head>
<body>
<?php

echo"Llene el formulario para crear la cuenta de otro usuario";
	echo'
	<fieldset>
		<legend>Inicio de sesión</legend>
		<form action="./NuevoUsuario.php" method="POST">
			<legend>
				Nombre <input type="text" name="nombre" required>
			</legend>
			<br><br>
			<legend>
				Primer apellido <input type="text" name="primer_apellido" required>
			</legend>
			<br><br>
			<legend>
				Segundo apellido <input type="text" name="segundo_apellido" required>
			</legend>
			<br><br>
			<legend>5
				Número de cuenta o RFC: <input type="text" name="num_cuenta" maxlength="12" required>
			</legend>
			<br><br>
			<legend>
				Fecha de nacimiento: <input type="date" name="fecha" required>
			</legend>
			<br><br>
			<legend>
				Correo electrónico institucional: <input type="email" name="email" required>
			</legend>
			<br><br>
			<legend>
				Contraseña: <input type="password" name="contra" required>
			</legend>
			<br>
			<label>Tipo de usuario:
				<select name="tipo" >
					<option value="Lector">Lector</option>
					<option value="Bibliotecario">Bibliotecario</option>
					<option value="Administrador">Carlos Alf</option>
				  </select>
			</label>
			<br><br>
			<input type="submit" name="enviaradmin">
		</form>
		<br><br>
		<a href="./usuarios.php"><button>regresar</button></a>
	</fieldset>';
if(isset($_POST["enviaradmin"])){
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
header("location: usuarios.php");
}
?>