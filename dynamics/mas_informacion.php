<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="../Super brocoli.png"/>
    <title>Más información</title>
</head>
<body>

<?php
require_once("./util.php");
require_once("./config.php");

session_start();
redireccionarSiSesionInvalida(isset($_SESSION["nombre"]));
encabezados($_SESSION["tipo_usuario"]);


if (isset($_POST["Agregar_a_favoritos"]) || isset($_POST["Quitar_de_favoritos"])) {

    $c = connectdb();
    $id_libro = $_POST["id_libro"];
    $id_usuario = $_POST["id_usuario"];

    if (isset($_POST["Agregar_a_favoritos"])) {
        $consulta = "SELECT * FROM favorito WHERE id_libro=$id_libro AND id_usuario='$id_usuario';";
        $r = mysqli_query($c, $consulta);
        if (!$r || mysqli_num_rows($r) == 0) {
            $consulta = "INSERT INTO favorito (id_libro, id_usuario) VALUES ('$id_libro', '$id_usuario');";
        }
    }
    else {
        $consulta = "DELETE FROM favorito WHERE id_libro='$id_libro' AND id_usuario='$id_usuario';";
    }
    
    $r = mysqli_query($c, $consulta);

    mysqli_close($c);
    echo 'Operación realizada con éxito <br>
    <form action="mas_informacion.php" method="POST">
        <input type="hidden" value="'. $id_libro .'" name="id_libro">
        <input type="submit" value="Regresar al libro">
    </form>';
}
elseif (isset($_POST["id_libro"])) {

    $c = connectdb();
    
    $id_libro = $_POST["id_libro"];

    $consulta = "SELECT *
    FROM libro t1
    INNER JOIN autor t2 ON t1.autor = t2.id_autor
    INNER JOIN editorial t3 ON t1.editorial = t3.id_editorial
    WHERE id_libro=$id_libro
    ;";

	$r = mysqli_query($c, $consulta);
    $row = mysqli_fetch_array($r);
    echo "<br>";

    echo "<img height='250' src='" . $row["imagen_referencia"] . "'>";
    echo "<br><strong>Titulo: </strong>" . $row["titulo"];
    echo "<br><strong>ID: </strong>" . $row["id_libro"];
    echo "<br><strong>Año de publicación: </strong>" . $row["year"];

    echo "<br><strong>Editorial: </strong>" . $row["editorial"];

    echo "<br><strong>Autor: </strong>" . $row["nombre"];

    echo "<br><strong>Descripción: </strong>" .$row["descripcion"];

    //Falta agregar liga hacia favorito y de descarga
    echo'<br><a href="' . $row["libro"] . '" target="_blank"><button>Abrir en otra pestaña</button></a> 

    <br>
    <form action="mas_informacion.php" method="POST">
        <input type="hidden" value="'. $id_libro .'" name="id_descarga">
        <input type="hidden" value="'. $row["libro"] .'" name="contenido">
        <input type="submit" value="Descargar libro" name="descarga">
    </form>';

    $id_usuario = $_SESSION["id_usuario"];
    $consulta = "SELECT * FROM favorito WHERE id_libro=$id_libro AND id_usuario='$id_usuario';";
    $r = mysqli_query($c, $consulta);

    $mensajeBoton = !$r || mysqli_num_rows($r) == 0 ? "Agregar a favoritos" : "Quitar de favoritos";
    echo '<form action="./mas_informacion.php" method="POST">
        <input type="hidden" value="' . $id_usuario . '" name="id_usuario">
        <input type="hidden" value="' . $id_libro . '" name="id_libro">
        <input type="submit" value="' . $mensajeBoton . '" name="' . $mensajeBoton . '">
    </form>';

    if ($_SESSION["tipo_usuario"] == "Bibliotecario" || $_SESSION["tipo_usuario"] == "Administrador")
    echo '<form action="formulario_libro.php" method="POST">
            <input type="hidden" name="id_libro" value="'. $id_libro .'">
            <input type="submit" value="Editar libro" name="prellenar">
        </form>';
    mysqli_close($c);
}

elseif (isset($_POST["id_descarga"])) {
    $id_usuario = $_SESSION["id_usuario"];
    $id_libro = $_POST["id_descarga"];

    $c = connectdb();
    $db = mysqli_select_db($c, "biblioteca");
    $consulta = "INSERT INTO historial_descargas (id_usuario, id_libro) VALUES ('$id_usuario', $id_libro);";
    $r = mysqli_query($c, $consulta);


    header("Content-type: application/pdf");
    header("Content-Disposition: attachment; filename=xd.pdf");
    readfile($_POST["contenido"]);
    
    header("location: ./index.php");
}
?>




</body>
</html>