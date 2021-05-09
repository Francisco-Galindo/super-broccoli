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
<?php
    session_start();

    // if (!isset($_SESSION["nombre"])) {
    //     header("location: ./login.php");
        
    // }

    
    echo "Hola";
?>

<table>
	<tbody>
		<tr>
			<td width="350"><img width="300" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.60LB7Mok7rF7KOdwagc-QQHaFj%26pid%3DApi&f=1">
				<br>
				<br>
				Autor:
				<br>
				Título:
				<br>
				<button type="button" class="btn btn-primary">Más información</button>
			</td>
			<td width="350"><img width="300" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.60LB7Mok7rF7KOdwagc-QQHaFj%26pid%3DApi&f=1">
				<br>
				<br>
				Autor:
				<br>
				Título:
				<br>
				<button type="button" class="btn btn-primary">Más información</button>
			</td>
				<td width="350"><img width="300" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.60LB7Mok7rF7KOdwagc-QQHaFj%26pid%3DApi&f=1">
					<br>
					<br>
					Autor:
					<br>
					Título:
					<br>
					<button type="button" class="btn btn-primary">Más información</button>
			</td>
		</tr>
			
	</tbody>
</table>

<form action="cerrar.php" method="POST">
    <input type="submit" value="Cerrar sesión">
</form>

</body>
</html>