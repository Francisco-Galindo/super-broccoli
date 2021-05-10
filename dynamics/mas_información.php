<?php

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</Mas información>
</head>
<body>
if (isset($_POST["mas información"])){
    $c = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($c, "biblioteca");

    $consulta = "SELECT imagen_referencia, titulo, id_libro, autor, year, editorial, descripcion
    FROM libros t1
    INNER JOIN autor t2 ON t1.autor = t2.id_autor
    INNER JOIN editorial t3 ON t1.editorial = t3.id_editorial
    ;";

	$r = mysqli_query($c, $consulta);
    
        echo "<br>";
	    echo $r["imagen_referencia"];
        echo "<br>";
	    echo "<strong>"$r["titulo"];"</strong>" 
        echo "<br>";
	    echo $r["id_libro"];
        echo "<br>";
	    echo $r["autor"];
        echo "<br>";
	    echo $r["year"];
        echo "<br>";
	    echo $r["editorial"];
        echo "<br>";
	    echo $r["descripcion"];
        echo "<br>";
        //Falta agregar liga hacia favorito y de descarga
        echo'<form action="./mas_informacion" method="POST">
        <input type="submit" value="abrir en otra pestaña" name="pestaña">
        </form>
        <form action="">
        <input type="submit" value="Descargar" name="descargar">
        </form>
        <form action="">
        <input type="submit" value="Agreagar a favoritos" name="favoritos">
        </form>';
    if (isset($_POST["pestaña"])) {
        $consulta1 = "SELECT libro FROM libros WHERE" $r;
        $r1 = mysqli_query($c, $consulta);
        <a href="$r1" target="_blank"></a>
    }

    mysqli_close($c);
}

</body>
</html>



?>