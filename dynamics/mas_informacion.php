<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<?php

if (isset($_POST["id_libro"])){

    $c = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($c, "biblioteca");
    
    $id_libro = $_POST["id_libro"];

    $consulta = "SELECT *
    FROM libros t1
    INNER JOIN autor t2 ON t1.autor = t2.id_autor
    INNER JOIN editorial t3 ON t1.editorial = t3.id_editorial
    WHERE id_libro=$id_libro
    ;";

	$r = mysqli_query($c, $consulta);
    $row=mysqli_fetch_array($r);
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

    <a title="Descargar Archivo" href="' . $row["libro"] . '" download="' . $row["titulo"] . '" style="color: blue; font-size:18px;"><button>Descargar</button></a>

    <form action="./mas_informacion.php" method="POST">
        <input type="submit" value="Agreagar a favoritos" name="favoritos">
    </form>';
    if (isset($_POST["favoritos"])) {
        $consulta1 = "INSERT INTO favoritos (id_libro, id_usuario) VALUES ('$id_libro', '$_SESSION["id"]' )";
    }

    


    mysqli_close($c);
}

?>




</body>
</html>