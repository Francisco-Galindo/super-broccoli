<?php
$c = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($c, "biblioteca");

$consulta = "SELECT fecha, titulo, autor, nombre
FROM historial_descargas t1
INNER JOIN libros t2 ON t1.id_libro = t2.id_libro
INNER JOIN usuario t3 ON t1.id_usuario = t3.num_cuenta_rfc
ORDER BY fecha DESC;";

$r = mysqli_query($c, $consulta);

while($row=mysqli_fetch_array($r))
{
    echo "<br>";
	echo $row["fecha"];
    echo "<br>";
	echo $row["nombre"];
    echo "<br>";
	echo $row["titulo"];
    echo "<br>";
	echo $row["autor"];
    echo "<br>";
}


?>