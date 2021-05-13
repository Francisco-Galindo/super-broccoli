<?php
    require "./util.php";
    session_start();
    redireccionarSiSesionInvalida(isset($_SESSION["nombre"]));
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
    <h1>¿Estas seguro que quieres eliminar la cuenta?</h1>
    <br><br>
    <form action="./borrar_cuenta.php" method="POST">
        <label>Para confirmar, por favor introduce tu contraseña:
            <br><br>
            <input type="password" name="passwrd" required>
            <br><br>
            <?php
                if(isset($_POST["admin_borra"])){
                    
                    $otro_usuario = $_POST["cuenta_a_eliminar"];
                    echo '<input type="hidden" name="cuenta_a_eliminar" value="'.$otro_usuario.'">';
                }
            ?>
            <input type="submit" name="boton" value="Confirmar">
        </label>
    </form>
    <br>
    <a href="./perfil.php"><button>Regresar</button></a>
</body>
</html>