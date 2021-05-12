<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Resultados de búsqueda</title>
</head>
<body>

<a href="cerrar.php"><button>Cerrar sesión</button></a>

<?php
require_once("./util.php");
require_once("./config.php");

redireccionarSiSesionInvalida();
encabezados($_SESSION["tipo_usuario"]);
if (isset($_POST["busqueda"])) {
	//Conexión con base de datos
	$c = connectdb();
	$filtros = "";
	$filtrosGenero = "";
	
	$contador = 0;
	if (isset($_POST["genero"])) {
		foreach ($_POST["genero"] as $genero) {
			if ($contador == 0) {
				$filtrosGenero .= " (";
			}
			if ($contador  > 0) {
				$filtrosGenero .= " OR ";
			}
			$filtrosGenero .= "id_genero = " . $genero;
			$contador ++;
		}
	}	
	if ($contador > 0) {
		$filtrosGenero .= " ) ";
	}
	else if ($contador == 0) {
		$filtrosGenero = (' 1=1 ');
	}

	$contador = 0;
	if (isset($_POST["autor"])) {
		foreach ($_POST["autor"] as $autor) {
			if ($contador== 0) {
				$filtros .= " ( ";
			}
			elseif ($contador  > 0) {
				$filtros .= " OR ";
			}
			$filtros .= "t1.autor = " . $autor;
			$contador ++;
		}
	}
	if ($contador > 0) {
		$filtros .= ") ";
	}
	else if ($contador == 0) {
		$filtros = (' (1=1) ');
	}


	$contador = 0;
	if (isset($_POST["editorial"])) {
		foreach ($_POST["editorial"] as $editorial) {
			if ($contador== 0) {
				$filtros .= " AND (";
			}
			elseif ($contador  > 0) {
				$filtros .= " OR ";
			}
			$filtros .= "t1.editorial = " . $editorial;
			$contador ++;
		}
	}
	if ($contador > 0) {
		$filtros .= ") ";
	}

	if ((isset($_POST["anno_min"]) && $_POST["anno_min"] != "") && (isset($_POST["anno_max"]) && $_POST["anno_max"] != "")) {
		$filtros .= " AND (year BETWEEN " . $_POST["anno_min"] . " AND " . $_POST["anno_max"] . ") ";
	}
	elseif (isset($_POST["anno_min"]) && $_POST["anno_min"] != "") {
		$filtros .= "AND (year >= " . $_POST["anno_min"] . ") ";
	}
	elseif (isset($_POST["anno_max"]) && $_POST["anno_max"] != "") {
		$filtros .= "AND (year <= " . $_POST["anno_max"] . ") ";
	}

	$contador = 0;
	if (isset($_POST["categoria"])) {
		foreach ($_POST["categoria"] as $categoria) {
			if ($contador== 0) {
				$filtros .= " AND (";
			}
			elseif ($contador  > 0) {
				$filtros .= " OR ";
			}
			$filtros .= "categoria = " . $categoria;
			$contador ++;
		}
	}
	if ($contador > 0) {
		$filtros .= ") ";
	}

	$filtros .= " AND ( ";
	$filtros .= isset($_POST["palabra_clave"]) && $_POST["palabra_clave"] != "" ? "titulo LIKE '%" . $_POST["palabra_clave"] . "%')" : "1=1)" ;


	$consulta = "SELECT * FROM libro t1
	INNER JOIN autor t2 ON t1.autor = t2.id_autor 
	INNER JOIN editorial t3 ON t1.editorial = t3.id_editorial 
	WHERE (" . $filtros . ")" . 
	" AND id_libro 
	IN(SELECT id_libro FROM libro_has_genero WHERE " . $filtrosGenero . ") 
	ORDER BY titulo;";
	//Consulta de base
	echo "<br>" . $consulta . "<br>";
	$r = mysqli_query($c, $consulta);

	echo "<table border='1'><tbody>";

	if ($r !== false) {
		while($row=mysqli_fetch_array($r)) {
			$id_libro = $row["id_libro"];
	
			echo "<tr>";
			echo "<td>";
			echo "<img height='250' src='" . $row["imagen_referencia"] . "'>";
			echo "<br><strong>Titulo: </strong>" . $row["titulo"];
			echo "<br><strong>ID: </strong>" . $row["id_libro"];
			echo "<br><strong>Año de publicación: </strong>" . $row["year"];
	
			echo "<br><strong>Editorial: </strong>" . $row["editorial"];
	
			echo "<br><strong>Autor: </strong>" . $row["nombre"];
			echo '<br>';
	
	
			echo'<form action="./mas_informacion.php" method= "POST">
			<input type="hidden" name="id_libro" value="' . $id_libro . '">
			<input type="submit" value="Mas información" name="mas información">
			</form>';
			echo "</td>";
			
			echo "</tr>";
			
		}
	}
	else {
		echo "<h2>No hay libros que cumplan los parámetros pedidos</h2>";
		echo "<br> <a href='index.php'><button>Regresar</button></a>";
	}
	
	
	echo "</tbody></table>";
	echo "<br>";
	

	mysqli_close($c);
}
else {
	header("location: ./index.php");
}

// if (!isset($_SESSION["nombre"])) {
//     header("location: ./login.php");
	
// }

?>

</body>
</html>