<?php

session_start();
		if (!isset($_SESSION["nombre"])) {
			header("location: login.php");
		}

 if (isset($_POST["enviar"])) {
    $libro=isset($_POST["libro"]);
    $razon=isset($_POST["razon"]);
    
    $c = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($c, "biblioteca");
    
    $consulta = "INSERT INTO reporte (id_libro, razon) VALUES ('$libro', '$razon');";
    $r = mysqli_query($c, $consulta);
    header("location: index.php");
    mysqli_close($c);
 }
 else{
    header("location: index.php");
 }
?>