<?php
require "./config.php"
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
	$id = $_POST["num_cuenta"];
	$nombre = $_POST["nombre"];
	$prim_ape = $_POST["primer_apellido"];
	$seg_ape = $_POST["segundo_apellido"];
	$contra = $_POST["contra"];
	$email = $_POST["email"];
	$tipo = $_POST["tipo"];
}
//Redirigir a la pagina de registro
else {
	header("location: ../templates/register.html");
}

//Abrir conexión con base de datos
$c = conectdb($id_usuario, $password);

$consulta = "SELECT id_tipo FROM tipo_usuario WHERE tipo='$tipo';";
$r = mysqli_query($c, $consulta);
$row=mysqli_fetch_array($r);
$id_tipo_usuario = isset($row["id_tipo"]) ? $row["id_tipo"] : 1;

//Ingresar los valores del formulario en la tabla usuarios
$consulta1 = "INSERT INTO usuario (num_cuenta_rfc, nombre, primer_apellido, segundo_apellido, contraseña, correo,  id_tipo_usuario) VALUES ('$id', '$nombre', '$prim_ape', '$seg_ape', '$contra', '$email', $id_tipo_usuario)";
$r = mysqli_query($c, $consulta1);
//Crear cuenta en la base de datos


if ($r) {
	$consulta2 = "CREATE USER '$id'@'localhost' IDENTIFIED BY '$contra'";
	$r = mysqli_query($c, $consulta2);	

	//Otorgar permisos
	if ($tipo=="Lector") {

		$tablas = ["libro", "autor", "editorial", "categoria", "genero", "biblioteca.libro_has_genero"];
		foreach ($tablas as $tabla) {
			$consulta3 = "GRANT SELECT ON biblioteca." . $tabla . " TO  '$id'@'localhost'";
			$r = mysqli_query($c, $consulta3);
		}

		$consulta4 = "GRANT SELECT, INSERT, DELETE ON biblioteca.favorito TO  '$id'@'localhost'";
		$r = mysqli_query($c, $consulta4);

		$tablas = ["historial_descargas", "reporte", "formulario"];
		foreach ($tablas as $tabla) {
			$consulta5 = "GRANT SELECT, INSERT ON biblioteca." . $tabla . " TO  '$id'@'localhost'";
			$r = mysqli_query($c, $consulta5);
		}
	}

	elseif ($tipo=="Bibliotecario") {
		$consulta6 = "GRANT SELECT, INSERT, UPDATE, DELETE ON biblioteca.* TO  '$id'@'localhost'";
		$r = mysqli_query($c, $consulta6);

		$tablas = ["usuario", "tipo_usuario", "categoria"];
		foreach ($tablas as $tabla) {
			$consulta7 = "REVOKE INSERT, UPDATE, DELETE ON biblioteca." . $tabla . " TO  '$id'@'localhost'";
			$r = mysqli_query($c, $consulta7);
		}
	}

	elseif ($tipo=="Administrador") {
		$consulta8 = "GRANT ALL PRIVILEGES ON biblioteca.* TO  '$id'@'localhost'";
		$r = mysqli_query($c, $consulta8);
	}
}




//Cerrar conexión con base de datos
mysqli_close($c);
//Redirigir a la página de inicio
if ($r) {
	session_start();

	//Guardado de los datos del usuario en variables de sesión.
	$_SESSION["id_usuario"] = $id;
	$_SESSION["nombre"] = $nombre;
	$_SESSION["password"] = $contra;

	header("location: ./index.php");
} 
//Redirigir a la pagina de registro
else {
	header("location: ../templates/register.html");
}
?>