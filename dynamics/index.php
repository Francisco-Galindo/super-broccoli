<?php
    session_start();

    if (!isset($_SESSION["nombre"])) {
        echo "sesión iniciada";
        
    }
    
    echo "Hola";
?>

<form action="cerrar.php" method="POST">
    <input type="submit" value="Cerrar sesión">
</form>