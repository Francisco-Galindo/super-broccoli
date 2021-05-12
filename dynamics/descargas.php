<?php
    require "./config.php";
	require "./util.php";
	redireccionarSiSesionInvalida();
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="../Super brocoli.png"/>
	<title>historial descargas</title>
</head>
<body>
<?php
//Conexión con base de datos
$c = conectdb();

//Join tables para mostrar los datos de el historial de descargas
$consulta = "SELECT fecha, titulo, autor, nombre
FROM historial_descargas t1
INNER JOIN libro t2 ON t1.id_libro = t2.id_libro
INNER JOIN usuario t3 ON t1.id_usuario = t3.num_cuenta_rfc
ORDER BY fecha DESC;";

//Consulta de base
$r = mysqli_query($c, $consulta);

//Imprimir cuantas filas hayan que cumplan con lo solicitado en $consulta
while($row=mysqli_fetch_array($r))
{
    echo "<br>";
	echo $row["fecha"];
    echo "<br>";
	echo $row["nombre"];
    echo "<br>";
	echo $row["titulo"];
    echo "<br>";
}
//cerrar conexión con base de datos
mysqli_close($c);

?>