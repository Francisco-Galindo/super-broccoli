<?php
	require_once("./util.php");
	require_once("./config.php");
	
	session_start();
	redireccionarSiSesionInvalida(isset($_SESSION["nombre"]));
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Información del perfil</title>
</head>
<body>
	<table>
		<?php
			//Función de encabezado
			encabezados($_SESSION["tipo_usuario"]);
			//Conexión con base de datos
			$c = connectdb();
			//Obtener datos de el usuario
			$id = $_SESSION["id_usuario"];
			$consulta = "SELECT tipo, num_cuenta_rfc, correo, nombre, primer_apellido, segundo_apellido 
			FROM usuario t1
			INNER JOIN tipo_usuario t2 ON t1.id_tipo_usuario = t2.id_tipo 
			WHERE num_cuenta_rfc='$id';";

			//consulta de usuarios
			$r = mysqli_query($c, $consulta);
			$row = mysqli_fetch_array($r);
			//Imprimir los adtos del usuario
			echo '<table>
			<thead>
				<tr>
					<th colspan="2">Tipo de usuario: '. $row["tipo"] .'</th>
				</tr>
			<thead>
			<tbody>
				<tr>
					<td><strong>Número de cuenta o RFC: </strong></td>
					<td>'. $row["num_cuenta_rfc"] .'</td>
				</tr>
				<tr>
					<td><strong>Correo electrónico: </strong></td>
					<td>'. $row["correo"].'</td>
				</tr>
				<tr>
					<td><strong>Nombre de usuario: </strong></td>
					<td>'.$row["nombre"].'</td>
				</tr>
				<tr>
					<td><strong>Apellidos</strong></td>
					<td>'. $row["primer_apellido"] .' '. $row["segundo_apellido"] .'</td>
				</tr>
			</tbody>
			</table>';
			mysqli_close($c);
			//Botones para regresar al inicio o eliminar la cuenta
		?>
	</table>
	<br><br>
	
	<a href="index.php"><button>Regresar</button></a></th>
	<a href="confirm.php"><button>Eliminar cuenta</button></a></th>
		
</body>
</html>

   
