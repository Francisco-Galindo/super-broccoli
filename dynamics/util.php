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
?>