<?php
$c = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($c, "biblioteca");

$consulta = "SELECT 
l.id_libro, 
l.libro, 
h.fecha, 
FROM
libros l
LEFT JOIN historial_descargas h USING(id_libro)
WHERE id_libro IS NOT NULL";

$consulta2 = "SELECT 
u.id_usuario, 
u.nombre
u.primer apellido
u.segundo apellido, 
FROM
usuario
LEFT JOIN historial_descargas h USING(id_usuario)
WHERE id_usuario IS NOT NULL";

echo'
<table>
    <tr>
        <td>$consulta2</td>
        <td>$consulta</td>
    </tr>
</table>';

$r = mysqli_query($c, $consulta);


?>