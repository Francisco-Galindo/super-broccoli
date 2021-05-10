<?php
    session_start();
    if (!isset($_SESSION["nombre"])) {
        header("location: login.php");
    }

    if(isset($_POST["passwrd"]) && $_POST["passwrd"] != "" && $_POST["passwrd"] == $_SESSION["contra"]){

        if($_POST["boton"]=="Confirmar"){

            session_start();
            session_unset();
            session_destroy();

            //ACCEDER A LA BASE DE DATOS Y ELIMINAR LOS REGISTROS
            //
            //
            //
            //
            header("location: ./login.php");
        }
        elseif($_POST["boton"]=="Regresar"){
        
            header("location: ./perfil.php");
        }

    }

    else{
        echo '<form action="./confirm.php" method="POST"><input type="hidden" name="incorrecta" value="contra incorrecta"></form>';
    }

?>
