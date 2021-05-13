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
	<title>Log in</title>
</head>
<body>
<?php
	//Función de encabezado
	encabezados($_SESSION["tipo_usuario"]);

	//Seleccionar los valores dentro de la tabla de usuarios
    $c = connectdb();
    $consulta = "SELECT * FROM usuario";
    $r = mysqli_query($c, $consulta);
		
	//Imprimir los usuarios existentes
    echo "<table border='1'><tbody>";
	while($row=mysqli_fetch_array($r)) {
        echo "<tr>";
		echo "<td>";
		echo "<br>Usuario " . $row["nombre"].' '.$row["primer_apellido"].' '.$row["segundo_apellido"]. "";
		echo "<br><strong>id_usuario </strong>" . $row["num_cuenta_rfc"];
        echo '<form action="./confirm.php" method="POST">
				<input type="hidden" name="cuenta_a_eliminar" value="'.$row["num_cuenta_rfc"].'">
				<input type="submit" name="admin_borra" value="Eliminar usuario">
			</form></td></tr>';
	}
	echo "</tbody></table>";
	//Formulario para crear nuevos usuarios
	echo"<th><a href=\"NuevoUsuario.php\"><button>Agregar nuevo usuario</button></a></th>";
	
	

?>