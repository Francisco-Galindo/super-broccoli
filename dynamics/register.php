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

//Ingresar los valores del formulario en la tabla usuarios
$consulta = "INSERT INTO usuario (num_cuenta_rfc, nombre, primer_apellido, segundo_apellido, contraseña, correo) VALUES ('$id', '$nombre', '$prim_ape', '$seg_ape', '$contra', '$email')";
$r = mysqli_query($c, $consulta);
//Crear cuenta en la base de datos


if ($r) {
	$consulta = "CREATE USER '$nombre'@'localhost' IDENTIFIED BY '$contra'";
	$r = mysqli_query($c, $consulta);	
}


//Otorgar permisos
if ($tipo=="lector") {
	$consulta = "GRANT SELECT ON biblioteca.libros.autor.editorial.favorito TO  '$nombre'@'localhost'";
	$r = mysqli_query($c, $consulta);
}

if ($tipo=="bibliotecario") {
	$consulta = "GRANT SELECT, INSERT, UPDATE, CREATE ON biblioteca.libros.autor.editorial.reporte.
	formulario.genero.histrial_descargas.categoria TO  '$nombre'@'localhost'";
	$r = mysqli_query($c, $consulta);
}

if ($tipo=="administrador") {
	$consulta = "GRANT PRIVILEGES ON biblioteca.* TO  '$nombre'@'localhost'";
	$r = mysqli_query($c, $consulta);
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
//cerrar conexión con base de datos
mysqli_close($c);
?>