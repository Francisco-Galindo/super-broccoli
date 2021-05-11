<?php
function encabezadol($hola){
    echo"<table>";
         echo"<thead>"; 
            echo"<th><form action= method=POST>";
                echo"<label>";
                    echo"<input type=submit nombre=\"favoritos\" value=\"favoritos\">";
                echo"</label>";
            echo"</form></th>";
            echo"<th><form action= method=\"POST\">";
                    echo"<input type=\"submit\" nombre=\"perfil\" value=\"perfil\">";
            echo"</form></th>";
        echo"</thead>";
    echo"</table>";
    return;
}
function encabezadob($hola){
    echo"<table>";
        echo"<thead>";
            echo"<th><form action= method=\"POST\">";
                echo"<label>";
                    echo"<input type=\"submit\" nombre=\"favoritos\" value=\"favoritos\">";
                echo"</label>";
            echo"</form></th>";
            echo"<th><form action= method=\"POST\">";
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
            echo"<th><form action= method=\"POST\">";
                echo"<label>";
                    echo"<input type=\"submit\" nombre=\"favoritos\" value=\"favoritos\">";
                echo"</label>";
            echo"</form></th>";
            echo"<th><form action= method=\"POST\">";
                echo"<input type=\"submit\" nombre=\"perfil\" value=\"perfil\">";
            echo"</form></th>";
            echo"<th><form action=\"./descargas.php\" method=\"POST\">";
                echo"<input type=\"submit\" nombre=\"historial\" value=\"Historial descargas\">";
            echo"</form></th>";
            echo"<th><form action=\"./nuevo_libro.php\" method=\"POST\">";
                echo"<input type=\"submit\" nombre=\"nlibro\" value=\"subir libro\">";
            echo"</form></th>";
            echo"<th><form action= method=\"POST\">";
                echo"<input type=\"submit\" nombre=\"usuarios\" value=\"usuarios\">";
            echo"</form></th>";
            
        echo"</thead>";
    echo"</table>";
return;
}
?>