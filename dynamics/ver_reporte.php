<?php
    require "./config.php"
    conectdb($id_usuario, $password);
    $consulta="SELECT titulo, razon FROM reporte t1
    INNER JOIN libro t2 ON t1.id_libro= t2.id_libro;";
        $r = mysqli_query($c, $consulta);
        $row=mysqli_fetch_array($r);
    while($row=mysqli_fetch_array($r)) {
            echo "<tr>";
            echo "<td>";
            echo "<br>titulo:" . $row["titulo"]."'>";
            echo "<br>razon:" . $row["razon"];
        }
        mysqli_close($c);
?>