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
                        Nombre <input type="text" name="nombre" required>
                    </legend>
                    <br><br>
                    <legend>
                        Apellidos <input type="text" name="apellidos" required>
                    </legend>
                    <br><br>
                    <legend>
                        Número de cuenta o RFC: <input type="number" name="grupo" min="400" max="700" required>
                    </legend>
                    <br><br>
                    <legend>
                        Fecha de nacimiento: <input type="date" name="fecha" required>
                    </legend>
                    <br><br>
                    <legend>
                        Correo electrónico institucional: <input type="email" name="email" required>
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

