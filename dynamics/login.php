<?php
    session_start();

    if (isset($_SESSION["nombre"])) {
        header("location: ./index.php");
    }
    else {
        echo '<fieldset>
                <legend>Inicio de sesión</legend>
                <form action="index.php" method="POST">
                    <legend>
                        Correo electrónico: <input type="email" name="email" required>
                    </legend>
                    <br><br>
                    <legend>
                        Contraseña: <input type="password" name="contra" required>
                    </legend>
                    <br><br>
                    <input type="submit" name="enviar">
                </form>
            </fieldset>';
    }
?>

