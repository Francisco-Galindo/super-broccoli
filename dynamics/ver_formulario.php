<?php
    require "./config.php"
    conectdb($id_usuario, $password);
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
    $c = conectdb($id_usuario, $password);
    $consulta="SELECT * FROM formulario;";
        $r = mysqli_query($c, $consulta);
        $row=mysqli_fetch_array($r);
    while($row=mysqli_fetch_array($r)) {
            echo "<tr>";
            echo "<td>";
            echo "<br>Id usuario::" . $row["id_usuario"];
            echo "<br>Obra:" . $row["obra"];
            echo "<br>Autor:" . $row["autor"];
            echo "<br>Año de publicación:" . $row["year"];
            echo "<br>Editorial:" . $row["editorial"];
            echo "<br>Edición:" . $row["edicion"];
            echo "<br>razon:" . $row["razon"];
        }
        mysqli_close($c);
?>