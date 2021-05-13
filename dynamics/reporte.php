<?php
require_once("./util.php");
require_once("./config.php");

redireccionarSiSesionInvalida();
?>
    <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="../Super brocoli.png"/>
	<title>Reportar un libro</title>
</head>
<body>
<?php
    encabezados($_SESSION["tipo_usuario"]);
    $id_libro=$_POST["id_libro"];
 if (isset($_POST["reporte"])) {

    echo'
    <fieldset>
    <legend>Reporte de libro</legend>
    <form action="reporte.php" method="POST">
        <br><br>
        <label>Razón: 
					<select name="razon">
						<option value="Contiene material para personas mayores de edad">Contiene material para personas mayores de edad</option>
						<option value="Contiene discurso de odio">Contiene discurso de odio</option>
						<option value="Difunde desinformación">Difunde desinformación</option>
						<option value="Incita acciones que atentan contra la integridad">Incita acciones que atentan contra la integridad</option>
					</select>
        </label>

        <br><br>
        <input type="hidden" name="id_libro" value="' . $id_libro . '">
        <input type="submit" name="enviar">
    </form>
    </fieldset>';
 }
 elseif (isset($_POST["enviar"])){
    $razon=$_POST["razon"];
    
    $c = connectdb();

    $consulta = "INSERT INTO reporte (id_libro, razon) VALUES ($id_libro, '$razon') ;";
    
    $r=mysqli_query($c, $consulta);

    if(!$r)
    {
        echo "No ha sido posible reportar el libro";
        echo $razon;

    }
    else{
        echo "El libro ha sido reportado";
        echo "<br>";
    }
    echo "<a href=\"./index.php\"><button>Volver</button></a>";
}
 else{
    header("location: index.php");
 }
?>