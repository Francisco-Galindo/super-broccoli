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
	<title>Log in</title>
</head>
<body>
<?php


    $c = conectdb();
    $consulta = "SELECT * FROM usuarios;";
    $r = mysqli_query($c, $consulta);

    echo "<table border='1'><tbody>";
	while($row=mysqli_fetch_array($r)) {
        echo "<tr>";
		echo "<td>";
		echo "<br>Usuario" . $row["nombre"] .$row["primer_apellido"].$row["segundo_apellido"]. "'>";
		echo "<br><strong>id_usuario </strong>" . $row["num_cuenta_rfc"];
        usuarioEliminar($row["num_cuenta_rfc"]);
	}


?>