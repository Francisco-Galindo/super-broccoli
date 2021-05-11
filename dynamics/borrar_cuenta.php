<?php
	require "./config.php"
	require './util.php';
	session_start();
	if (!isset($_SESSION["nombre"])) {
		header("location: login.php");
	}

	if(isset($_POST["passwrd"])){

		session_start();

		//ACCEDER A LA BASE DE DATOS Y ELIMINAR LOS REGISTROS

		//Conexión con base de datos
		$c = conectdb($id_usuario, $password);
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

		if ($contadorCoincidencias === 1) {
			usuarioEliminar($id_usuario);

			session_unset();
			session_destroy();
			header("location: ./login.php");

		}
		else {
			echo '<a href="./confirm.php"><button>Contraseña incorrecta, volver a intentar</button></a>';
		}

	}

?>