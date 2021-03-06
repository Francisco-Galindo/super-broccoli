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
	<link rel="shortcut icon" type="image/png" href="../Super brocoli.png"/>
	<title>Favoritos</title>
</head>
<body>
<?php
//función de encabezado
encabezados($_SESSION["tipo_usuario"]);
echo "<h2>Tus favoritos:</h2>";
//si se encuentran favoritos
if(isset($_POST["favoritos"]));{
    $c = connectdb();
	//Seleccionar los libros en favoritos unicamente de el usuario
	$id_usuario = $_SESSION["id_usuario"];
    $consulta = "SELECT * FROM libro t1
	INNER JOIN favorito t2 ON t1.id_libro = t2.id_libro 
    INNER JOIN usuario t3 ON t3.num_cuenta_rfc = t2.id_usuario
	WHERE t3.num_cuenta_rfc='$id_usuario'";
	//Consulta de base


	$r = mysqli_query($c, $consulta);
    //Tabla con favoritos
    echo "<table border='1'><tbody>";
	if ($r && mysqli_num_rows($r) > 0) {
		while($row=mysqli_fetch_array($r)) {
			$id_libro = $row["id_libro"];
	
			echo "<tr>";
			echo "<td>";
			echo "<img height='250' src='" . $row["imagen_referencia"] . "'>";
			echo "<br><strong>Titulo: </strong>" . $row["titulo"];
			echo "<br><strong>ID: </strong>" . $row["id_libro"];
			//Permite regresar a mas información
			echo'<form action="./mas_informacion.php" method= "POST">
			<input type="hidden" name="id_libro" value="' . $id_libro . '">
			<input type="submit" value="Mas información" name="mas información">
			</form>';
			//Elimina de favoritos
			echo'<form>
			<input type="submit" value="Eliminar de favoritos" name="eliminar">
			</form>';
			//En caso de seleccionarse eliminar dicho libro de favoritos
			if (isset($_POST["eliminar"])) {
			$consulta="DELETE FROM favoritos WHERE id_libro=$id_libro;";
			}
		} 
	}
	//Si no se ha agregado nada a favoritos
	else {
		echo "No tienes nada en favoritos :(";
	}
	echo "</tbody></table>";
    mysqli_close($c);
}
?>