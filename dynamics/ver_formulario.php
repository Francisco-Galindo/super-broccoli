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
	<title>Formulario</title>
</head>
<body>
<?php
//Función de encabezados
    encabezados($_SESSION["tipo_usuario"]);
    $c = connectdb();
    //Agarrar la información de los formularios
    $consulta="SELECT * FROM formulario;";
    $r = mysqli_query($c, $consulta);
    $row=mysqli_fetch_array($r);
    //Imprimir las solicitudes de libro realizadas por todos los lectores
    while($row=mysqli_fetch_array($r)) {
            echo "<tr>";
            echo "<td>";
            echo "<br>Id usuario: " . $row["id_usuario"];
            echo "<br>Obra:" . $row["obra"];
            echo "<br>Autor:" . $row["autor"];
            echo "<br>Año de publicación:" . $row["publicacion"];
            echo "<br>Editorial:" . $row["editorial"];
            echo "<br>Edición:" . $row["edicion"];
            echo "<br>razon:" . $row["razon"];
            echo"<br><br>";
        }
    mysqli_close($c);
?>