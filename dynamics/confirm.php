<?php

    session_start();
    if (!isset($_SESSION["nombre"])) {
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="../Super brocoli.png"/>
    <title>Confirmación</title>
</head>
<body>
    <h1>¿Estas seguro que quieres elimar tu cuenta?</h1>
    <br><br>
    <?php
        if(isset($_POST["incorrecta"]) && $_POST["incorrecta"] == "contra incorrecta") {
            echo '<strong>Contraseña incorrecta.</strong><br>';
        }
    ?>
    <form action="./borrar_cuenta.php" method="POST">
        <label>Para confirmar, por favor introduce tu contraseña:
            <br><br>
            <input type="password" name="passwrd" required>
            <br>
            <input type="submit" name="boton" value="Confirmar">
        </label>
    </form>

    <a href="./perfil.php"><button>Regresar</button></a>
</body>
</html>