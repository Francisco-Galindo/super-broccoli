<?php
require "./config.php";
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
    $c = conectdb($_SESSION["id_usuario"], $_SESSION["password"]);
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