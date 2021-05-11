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
$c = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($c, "biblioteca");

$consulta = "SELECT id_tipo FROM tipo_usuario WHERE tipo='$tipo';";
$r = mysqli_query($c, $consulta);
$row=mysqli_fetch_array($r);
$id_tipo_usuario = isset($row["id_tipo"]) ? $row["id_tipo"] : 1;

//Ingresar los valores del formulario en la tabla usuarios
$consulta = "INSERT INTO usuario (num_cuenta_rfc, nombre, primer_apellido, segundo_apellido, contraseña, correo,  id_tipo_usuario) VALUES ('$id', '$nombre', '$prim_ape', '$seg_ape', '$contra', '$email', $id_tipo_usuario)";
$r = mysqli_query($c, $consulta);
//Crear cuenta en la base de datos


if ($r) {
	$consulta = "CREATE USER '$id'@'localhost' IDENTIFIED BY '$contra'";
	$r = mysqli_query($c, $consulta);	

	//Otorgar permisos
	if ($tipo=="Lector") {

		$tablas = ["libro", "autor", "editorial", "categoria", "genero", "biblioteca.libro_has_genero"];
		foreach ($tablas as $tabla) {
			$consulta = "GRANT SELECT ON biblioteca." . $tabla . " TO  '$id'@'localhost'";
			$r = mysqli_query($c, $consulta);
		}

		$consulta = "GRANT SELECT, INSERT, DELETE ON biblioteca.favorito TO  '$id'@'localhost'";
		$r = mysqli_query($c, $consulta);

		$tablas = ["historial_descargas", "reporte", "formulario"];
		foreach ($tablas as $tabla) {
			$consulta = "GRANT SELECT, INSERT ON biblioteca." . $tabla . " TO  '$id'@'localhost'";
			$r = mysqli_query($c, $consulta);
		}
	}

	elseif ($tipo=="Bibliotecario") {
		$consulta = "GRANT SELECT, INSERT, UPDATE, DELETE ON biblioteca.* TO  '$id'@'localhost'";
		$r = mysqli_query($c, $consulta);

		$tablas = ["usuario", "tipo_usuario", "categoria"];
		foreach ($tablas as $tabla) {
			$consulta = "REVOKE INSERT, UPDATE, DELETE ON biblioteca." . $tabla . " TO  '$id'@'localhost'";
			$r = mysqli_query($c, $consulta);
		}
	}

	elseif ($tipo=="Administrador") {
		$consulta = "GRANT ALL PRIVILEGES ON biblioteca.* TO  '$id'@'localhost'";
		$r = mysqli_query($c, $consulta);
	}
}




//Cerrar conexión con base de datos
mysqli_close($c);
//Redirigir a la página de inicio
if ($r) {
	session_start();

	//Guardado de los datos del usuario en variables de sesión.
	$_SESSION["id"] = $id;
	$_SESSION["nombre"] = $nombre;
	$_SESSION["prim_ape"] = $prim_ape;
	$_SESSION["seg_ape"] = $seg_ape;
	$_SESSION["email"] = $email;
	$_SESSION["tipo"] = $tipo;
	$_SESSION["contra"] = $contra;

	header("location: ./index.php");
} 
//Redirigir a la pagina de registro
else {
	header("location: ../templates/register.html");
}
?>