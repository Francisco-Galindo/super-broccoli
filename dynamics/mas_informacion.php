<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<?php


$id_libro = $_POST["id_libro"];
$c = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($c, "biblioteca");

if (isset($_POST["pestaña"])) {
    $consulta = "SELECT libro FROM libros WHERE id_libro=$id_libro;" ;
    $r = mysqli_query($c, $consulta);
    $row=mysqli_fetch_array($r);
    echo '<a href="' . $row["libro"] . '" target="_blank">HOla</a>';
}

elseif (isset($_POST["id_libro"])){
    
    $id_libro = $_POST["id_libro"];

    $consulta = "SELECT imagen_referencia, titulo, id_libro, autor, year, t3.editorial, descripcion
    FROM libros t1
    INNER JOIN autor t2 ON t1.autor = t2.id_autor
    INNER JOIN editorial t3 ON t1.editorial = t3.id_editorial
    WHERE id_libro=$id_libro
    ;";

	$r = mysqli_query($c, $consulta);
    while($row=mysqli_fetch_array($r)) {
        echo "<br>";
        echo '<img height="200" src="' . $row["imagen_referencia"] . '">';
        echo "<br>";
        echo "<strong>" . $row["titulo"] . "</strong>";
        echo "<br>";
        echo $row["id_libro"];
        echo "<br>";
        echo $row["autor"];
        echo "<br>";
        echo $row["year"];
        echo "<br>";
        echo $row["editorial"];
        echo "<br>";
        echo $row["descripcion"];
        echo "<br>";
    }

    //Falta agregar liga hacia favorito y de descarga
    echo'<form action="./mas_informacion.php" method="POST">
    <input type="hidden" name="id_libro" value="' . $id_libro . '">
    <input type="submit" value="abrir en otra pestaña" name="pestaña">
    </form>

    <form action="">
        <input type="submit" value="Descargar" name="descargar">
    </form>

    <form action="">
        <input type="submit" value="Agreagar a favoritos" name="favoritos">
    </form>';

    mysqli_close($c);
}



?>
</body>
</html>