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

 if (isset($_POST["reportar"])) {
     echo'
    <fieldset>
    <legend>Reporte de libro (inserta su id)</legend>
    <form action="reporte.php" method="POST">
        <legend>
					Libro <input type="text" name="libro" required>
        </legend>
        <br><br>
        <legend>Razón: 
					<select name="razon">
						<option value="mayor">Contiene material para personas mayores de edad</option>
						<option value="odio">Contiene discurso de odio</option>
						<option value="desinfo">Difunde desinformación</option>
						<option value="integridad">Incita acciones que atentan contra la integridad</option>
					</select>
        </legend>

        <br><br>
        <input type="submit" name="enviar">
    </form>
    </fieldset>';
    if (isset($_POST["enviar"])){
    $libro=isset($_POST["libro"]);
    $razon=isset($_POST["razon"]);
    
   
    
    $c = conectdb($id_usuario, $password);

    $consulta = "SELECT id_libro FROM libro WHERE id_libro='$libro';";
    $r = mysqli_query($c, $consulta);
    while($row=mysqli_fetch_array($r)){
	echo "id del libro no corresponde con ningun libro en existencia, 
    por favor asegurese de ingresar el id correcto";
    echo'
    <form action="./reporte.php" method="POST">
			<input type="submit" value="Reportar" name="reportar">
    </form>';
	$contadorCoincidencias ++;
    }

    if ($contadorCoincidencias===1) {
			$consulta1 = "INSERT INTO reporte (id_libro, razon) VALUES ('$libro', '$razon');";
    $r = mysqli_query($c, $consulta1);
    header("location: index.php");
    mysqli_close($c);
    }
    }
 }
 else{
    header("location: index.php");
 }
?>