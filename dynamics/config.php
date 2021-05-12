<?php
    define("DBUSER", "root");
    define("DBHOST", "localhost");
    define("PASSWORD", "");
    define("DB", "biblioteca");

    function conectdb($id_usuario, $password)
    {
        $c=mysqli_connect(DBHOST, DBUSER, PASSWORD, 'mysql');
        $consulta="SELECT user FROM user WHERE user =".$id_usuario." AND password = ".$password."";
        $r = mysqli_query($c, $consulta);
        //$cont=mysqli_num_rows($r);
        
        if($r!=FALSE)
        {
            echo"Si existe el usuario, iniciando sesion.";
            mysqli_close($c);
            
            $c=mysqli_connect(DBHOST, $id_usuario, $password, DB);
            if(!$c)
            {
                /*mysqli_connect_error();
                mysqli_connect_errno();*/
                echo"No se pudo acceder a la base de datos";
            }
            //echo "Si existe la cuenta en la DB mysql";
            
        }
        elseif($r === FALSE)
        {
            echo "No existe la cuenta, se tiene que crear";
            $consulta2 = "CREATE USER '$id_usuario'@'localhost' IDENTIFIED BY '$password'";
	        $r = mysqli_query($c, $consulta2);
            mysqli_close($c);

            $c=mysqli_connect(DBHOST, $id_usuario, $password, DB);
            if(!$c)
            {
                /*mysqli_connect_error();
                mysqli_connect_errno();*/
                echo"No se pudo acceder a la base de datos";
            }
        }

        
        
        return $c;
    }
?>