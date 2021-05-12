<?php
function encabezadol($hola){
    echo"<table>";
         echo"<thead>"; 
            echo"<th><form action=\"./favoritos.php\" method=POST>";
                echo"<label>";
                    echo"<input type=submit nombre=\"favoritos\" value=\"favoritos\">";
                echo"</label>";
            echo"</form></th>";
            echo"<th><form action=\"./perfil.php\" method=\"POST\">";
                    echo"<input type=\"submit\" nombre=\"perfil\" value=\"perfil\">";
            echo"</form></th>";
        echo"</thead>";
    echo"</table>";
    return;
}
function encabezadob($hola){
    echo"<table>";
        echo"<thead>";
            echo"<th><form action=\"./favoritos.php\" method=\"POST\">";
                echo"<label>";
                    echo"<input type=\"submit\" nombre=\"favoritos\" value=\"favoritos\">";
                echo"</label>";
            echo"</form></th>";
            echo"<th><form action=\"./perfil.php\" method=\"POST\">";
                    echo"<input type=\"submit\" nombre=\"perfil\" value=\"perfil\">";
            echo"</form></th>";
            echo"<th><form action=\"./descargas.php\" method=\"POST\">";
                    echo"<input type=\"submit\" nombre=\"historial\" value=\"Historial descargas\">";
            echo"</form><th>";
            echo"<th><form action=\"./nuevo_libro.php\" method=\"POST\">";
                    echo"<input type=\"submit\" nombre=\"nlibro\" value=\"subir libro\">";
            echo"</form></th>";
        echo"</thead>";
    echo"</table>";
return;
}
function encabezadoa($hola){ 
    echo"<table>";
        echo"<thead>";
            echo"<th><form action=\"./favoritos.php\" method=\"POST\">";
                echo"<label>";
                    echo"<input type=\"submit\" nombre=\"favoritos\" value=\"favoritos\">";
                echo"</label>";
            echo"</form></th>";
            echo"<th><form action=\"./perfil.php\" method=\"POST\">";
                echo"<input type=\"submit\" nombre=\"perfil\" value=\"perfil\">";
            echo"</form></th>";
            echo"<th><form action=\"./descargas.php\" method=\"POST\">";
                echo"<input type=\"submit\" nombre=\"historial\" value=\"Historial descargas\">";
            echo"</form></th>";
            echo"<th><form action=\"./nuevo_libro.php\" method=\"POST\">";
                echo"<input type=\"submit\" nombre=\"nlibro\" value=\"subir libro\">";
            echo"</form></th>";
            echo"<th><form action=\"./Usuarios.php\" method=\"POST\">";
                echo"<input type=\"submit\" nombre=\"usuarios\" value=\"usuarios\">";
            echo"</form></th>";
            
        echo"</thead>";
    echo"</table>";
return;
}

function usuarioEliminar($id_usuario) {
    //Conexión con base de datos
    $c = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($c, "biblioteca");
    $consulta = "DELETE FROM formulario WHERE id_usuario='$id_usuario';";
    $r = mysqli_query($c, $consulta);
    $consulta = "DELETE FROM favorito WHERE id_usuario='$id_usuario';";
    $r = mysqli_query($c, $consulta);
    $consulta = "DELETE FROM historial_descargas WHERE id_usuario='$id_usuario';";
    $r = mysqli_query($c, $consulta);
    $consulta = "DELETE FROM usuario WHERE num_cuenta_rfc='$id_usuario';";
    $r = mysqli_query($c, $consulta);
    $consulta = "DROP USER '$id_usuario'@'localhost';";
    $r = mysqli_query($c, $consulta);
    mysqli_close($c);

    return ($r);
}

function redireccionarSiSesionInvalida() {
    session_start();
    if (!isset($_SESSION["nombre"])) {
        header("location: login.php");
    }
}

function usuarioDarPermisos($c, $id, $tipo) {

    if ($tipo == "Lector") {

        $tablas = ["libro", "autor", "editorial", "categoria", "genero", "biblioteca.libro_has_genero", "usuario"];
        foreach ($tablas as $tabla) {
            $consulta = "GRANT SELECT ON biblioteca." . $tabla . " TO  '$id'@'localhost'";
            $r = mysqli_query($c, $consulta);
        }

        $consulta = "GRANT SELECT, INSERT, DELETE ON biblioteca.favorito TO  '$id'@'localhost'";
        $r = mysqli_query($c, $consulta);

        $tablas = ["historial_descargas", "reporte", "formulario"];
        foreach ($tablas as $tabla) {
            $consulta = "GRANT SELECT, INSERT ON biblioteca." . $tabla . " TO  '$id'@'localhost'";
            $r = mysqli_query($c, $consulta);
        }
    }

    elseif ($tipo == "Bibliotecario" || $tipo == "Administrador") {
        $tablas = ["autor", "editorial", "genero"];
        foreach ($tablas as $tabla) {
            $consulta = "GRANT SELECT, INSERT ON biblioteca." . $tabla . " TO  '$id'@'localhost'";
            $r = mysqli_query($c, $consulta);
        }

        $tablas = ["formulario", "historial_descargas", "reporte", "libro_has_genero"];
        foreach ($tablas as $tabla) {
            $consulta = "GRANT SELECT, INSERT, DELETE ON biblioteca." . $tabla . " TO  '$id'@'localhost'";
            $r = mysqli_query($c, $consulta);
        }

        $tablas = ["libro"];
        foreach ($tablas as $tabla) {
            $consulta = "GRANT SELECT, INSERT, UPDATE, DELETE ON biblioteca." . $tabla . " TO  '$id'@'localhost'";
            $r = mysqli_query($c, $consulta);
        }

        $tablas = ["usuario", "tipo_usuario", "categoria", "historial_descargas"];
        foreach ($tablas as $tabla) {
            $consulta = "GRANT SELECT ON biblioteca." . $tabla . " TO  '$id'@'localhost'";
            $r = mysqli_query($c, $consulta);
        }
    }

    if ($tipo == "Administrador") {
        $consulta = "GRANT SELECT, INSERT, DELETE ON biblioteca.usuario TO  '$id'@'localhost'";
        $r = mysqli_query($c, $consulta);
    }
}
?>