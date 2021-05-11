<?php
    session_start();
    if (!isset($_SESSION["nombre"])) {
        header("location: login.php");
    }

    if(isset($_POST["passwrd"])){

        //session_start();
        //session_unset();
        //session_destroy();

        //ACCEDER A LA BASE DE DATOS Y ELIMINAR LOS REGISTROS

        //Conexión con base de datos
        $c = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($c, "biblioteca");
        //Insertar valores para nuevos usuarios
        $id_usuario = $_SESSION["id_usuario"];

        $contra = $_POST["passwrd"];
        $consulta = "SELECT nombre FROM usuario WHERE num_cuenta_rfc='$id_usuario' AND contraseña='$contra';";

        //consulta de usuarios
        $r = mysqli_query($c, $consulta);
        $contadorCoincidencias = 0;
        while($row=mysqli_fetch_array($r)) {
            $contadorCoincidencias ++;
        }
        if ($contadorCoincidencias === 1) {
            echo "borrar";
        }
        else {
            echo '<a href="./confirm.php"><button>Contraseña incorrecta, volver a intentar</button></a>';
        }
        ///header("location: ./login.php");

    }

?>