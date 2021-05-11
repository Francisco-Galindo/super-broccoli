<?php
if(isset($_POST["favoritos"]));{
    $c = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($c, "biblioteca");

    $consulta = "SELECT * FROM libro t1
	INNER JOIN favoritos t2 ON t1.id_libro = t2.id_libro 
    INNER JOIN usuario t3 ON t3.id_usuario = t2.id_usuario;";
	//Consulta de base
	echo "<br>" . $consulta . "<br>";
	$r = mysqli_query($c, $consulta);
    
    echo "<table border='1'><tbody>";
	while($row=mysqli_fetch_array($r)) {
		$id_libro = $row["id_libro"];

		echo "<tr>";
		echo "<td>";
		echo "<img height='250' src='" . $row["imagen_referencia"] . "'>";
		echo "<br><strong>Titulo: </strong>" . $row["titulo"];
		echo "<br><strong>ID: </strong>" . $row["id_libro"];

        echo'<form action="./mas_informacion.php" method= "POST">
		<input type="hidden" name="id_libro" value="' . $id_libro . '">
		<input type="submit" value="Mas información" name="mas información">
		</form>';
        echo'<form>
		<input type="submit" value="Eliminar de favoritos" name="eliminar">
		</form>';
        if (isset($_POST["eliminar"])) {
        $consulta1="DELETE FROM favoritos WHERE id_libro=$id_libro;";
        }
    } 
    
}
?>