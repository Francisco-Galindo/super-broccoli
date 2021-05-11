<?php
require "./config.php"
require "./util.php";


session_start();
if (!isset($_SESSION["nombre"])) {
    header("location: login.php");
}

if (isset($_POST[$usuarios])) {
    $c = conectdb($id_usuario, $password);
    $consulta = "SELECT * FROM usuarios;";
    $r = mysqli_query($c, $consulta);

    echo "<table border='1'><tbody>";
	while($row=mysqli_fetch_array($r)) {
        echo "<tr>";
		echo "<td>";
		echo "<br>Usuario" . $row["nombre"] .$row[" primer_apellido"].$row[" segundo_apellido"]. "'>";
		echo "<br><strong>id_usuario </strong>" . $row["num_cuenta_rfc"];
        usuarioEliminar($row["num_cuenta_rfc"]);
		
    }
}


?>