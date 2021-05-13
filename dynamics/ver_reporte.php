<?php
	require_once("./util.php");
	require_once("./config.php");
	session_start();
	redireccionarSiSesionInvalida(isset($_SESSION["nombre"]), $_SESSION["tipo_usuario"], 'Bibliotecario');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" type="image/png" href="../Super brocoli.png"/>
<title>Súper brócoli</title>
</head>
<body>
<?php
	//Funcion de encabezados
	encabezados($_SESSION["tipo_usuario"]);
	echo "<h1>Reportes: </h1>";
	$c = connectdb();

	if (isset($_POST["id_reporte"])) {

		$id_reporte = $_POST["id_reporte"];
		$id_libro = $_POST["id_libro"];
		echo "<br>" . $_POST["accion"];
		echo $id_libro;

		switch ($_POST["accion"]) {
			case "borrar":
				$consulta = "DELETE FROM historial_descargas WHERE id_libro='$id_libro';";
				$r = mysqli_query($c, $consulta);

				$consulta = "DELETE FROM libro_has_genero WHERE id_libro='$id_libro';";
				$r = mysqli_query($c, $consulta);

				$consulta = "DELETE FROM favorito WHERE id_libro='$id_libro';";
				$r = mysqli_query($c, $consulta);

				$consulta = "DELETE FROM reporte WHERE id_libro='$id_libro';";
				$r = mysqli_query($c, $consulta);

				$consulta = "DELETE FROM libro WHERE id_libro='$id_libro';";
				$r = mysqli_query($c, $consulta);
				break;
			case "restringir":
				$consulta = "UPDATE libro SET restriccion_edad=1 WHERE id_libro='$id_libro';";
				$r = mysqli_query($c, $consulta);
				break;
		}
		$consulta = "DELETE FROM reporte WHERE id_reporte=$id_reporte;";
		$r = mysqli_query($c, $consulta);
		
	}

	//Seleccionar los datos de el libro reportado y el reporte
	$consulta = "SELECT id_reporte, t2.id_libro, t2.titulo, razon FROM reporte t1
	INNER JOIN libro t2 ON t1.id_libro= t2.id_libro;";
	$r = mysqli_query($c, $consulta);
	echo "<table border='1'>";

	//Imprimir el titulo del libro y la razón del reporte
	while($row=mysqli_fetch_array($r)) {
		echo "<tr>";
		echo "<td>";
		echo "<br><strong>ID_reporte: </strong>" . $row["id_reporte"];
		echo "<br><strong>Titulo: </strong>" . $row["titulo"];
		echo "<br><strong>Razón: </strong>" . $row["razon"]."<br>";
		echo "<br>";

		echo '<form action="./mas_informacion.php" method="POST">
						<input type="hidden"  name="id_libro" value="'.$row["id_libro"] . '">
						<input type="submit" name="mas_informacion" value="Más información del libro">
					</form>

					<br>
					<form action="./ver_reporte.php" method="POST">
						<input type="hidden"  name="id_libro" value="'. $row["id_libro"] . '">
						<input type="hidden"  name="id_reporte" value="'. $row["id_reporte"] . '">
						<label> Acción a realizar:
							<select name="accion" id="">
								<option value="rechazar">Rechazar reporte</option>
								<option value="borrar">Borrar libro</option>
								<option value="restringir">Imponer restricción de edad</option>
							</select>
						</label>
						<input type="submit" name="accion_reporte" value="Realizar cambios">
					</form>';
		echo "</td></tr>";
	}
	echo "</table>";
	mysqli_close($c);
?>

