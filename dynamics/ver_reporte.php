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
    encabezados($_SESSION["tipo_usuario"]);
    $c = connectdb();
    $consulta="SELECT id_reporte, titulo, razon FROM reporte t1
    INNER JOIN libro t2 ON t1.id_libro= t2.id_libro;";
    $r = mysqli_query($c, $consulta);
    echo "<table border='1'>";
    while($row=mysqli_fetch_array($r)) {
        echo "<tr>";
        echo "<td>";
        echo "<br><strong>Titulo: </strong>" . $row["titulo"]."";
        echo "<br><strong>Razón: </strong>" . $row["razon"]."<br>";
        echo "<br>";
        echo "</td>";
    }
    echo "</tr></table>";
    mysqli_close($c);
?>