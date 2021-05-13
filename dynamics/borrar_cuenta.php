<?php
	require_once("./util.php");
	require_once("./config.php");
	
	redireccionarSiSesionInvalida();

	if(isset($_POST["passwrd"]) || (!isset($_POST["passwrd"])  && $_SESSION["tipo_usuario"]) == "Administrador"){

		session_start();

		//ACCEDER A LA BASE DE DATOS Y ELIMINAR LOS REGISTROS

		//Conexión con base de datos
		$c = mysqli_connect("localhost", "root", "", "biblioteca");
		//Insertar valores para nuevos usuarios
		$id_usuario = $_SESSION["id_usuario"];

		$contra = $_POST["passwrd"];
		$consulta = "SELECT nombre FROM usuario WHERE num_cuenta_rfc='$id_usuario' AND contraseña='$contra';";

		//consulta de usuarios
		$r = mysqli_query($c, $consulta);
		$contadorCoincidencias = 0;
		while($row=mysqli_fetch_array($r)) {
			$contadorCoincidencias ++;
		}
		mysqli_close($c);
		//si coincide la contraseña con el usuario, eliminar cuenta
		if ($contadorCoincidencias === 1) {
			usuarioEliminar($id_usuario);

			session_unset();
			session_destroy();
			header("location: ./login.php");

		}
		//En caso de ser incorrecta 
		else {
			echo '<a href="./confirm.php"><button>Contraseña incorrecta, volver a intentar</button></a>';
		}

	}

?>