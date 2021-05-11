<?php
    define("DBUSER", "root");
    define("DBHOST", "localhost");
    define("PASSWORD", "");
    define("DB", "biblioteca");

    function conectdb($id_usuario, $password)
    {
        $c=mysqli_connect(DBHOST, $id_usuario, $password, DB);
        if(!$c)
        {
            /*mysqli_connect_error();
            mysqli_connect_errno();*/
            echo"No se pudo acceder a la base de datos";
        }
        
        return $c;
    }
?>