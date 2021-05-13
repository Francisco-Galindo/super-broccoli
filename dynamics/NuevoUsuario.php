<?php
    require_once("./util.php");
    require_once("./config.php");
    
	session_start();
    redireccionarSiSesionInvalida(isset($_SESSION["nombre"]), $_SESSION["tipo_usuario"], 'Administrador');
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
//Formulario para crear nuevo usuario
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
	//declaración de los valores ingresados en el formulario
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
//Al enviar el formulario
if(isset($_POST["enviaradmin"])){
$c = connectdb();
//Agregar el tipo de usuario que se creo
$consulta = "SELECT id_tipo FROM tipo_usuario WHERE tipo='$tipo';";
$r = mysqli_query($c, $consulta);
$row=mysqli_fetch_array($r);
$id_tipo_usuario = isset($row["id_tipo"]) ? $row["id_tipo"] : 1;
//Comprobación de correo institucional
if (! ($dominio == "enp.unam.mx" || $dominio == "comunidad.unam.mx")) {
	$error = "El dominio de correo electrónico no es válido. Utilizar alguno con el dominio 'enp.unam.mx' o 'comunidad.unam.mx'.";
}
//Comprobación de que el nuevo usuario no tenga una cuenta existente
	$consulta = "SELECT num_cuenta_rfc FROM usuario  
	WHERE num_cuenta_rfc='$id' 
	OR (nombre='$nombre' AND primer_apellido='$prim_ape' AND segundo_apellido='$seg_ape') 
	OR correo='$email'";
	$r = mysqli_query($c, $consulta);
//En caso de no encontrar usuario existente crear la cuenta
if (mysqli_num_rows($r) == 0 && !(isset($error) && $error != "")) {
	//Ingresar los valores del formulario en la tabla usuarios
	$consulta = "INSERT INTO usuario (num_cuenta_rfc, nombre, primer_apellido, segundo_apellido, contraseña, correo,  id_tipo_usuario, fecha_nacimiento) VALUES ('$id', '$nombre', '$prim_ape', '$seg_ape', '$contra', '$email', $id_tipo_usuario, '$fecha')";
	$r = mysqli_query($c, $consulta);
}
//En caso de ya existir el usuario
else {
	$error = "Ya existe una cuenta relacionada con esta persona.";
}
header("location: usuarios.php");
}
?>