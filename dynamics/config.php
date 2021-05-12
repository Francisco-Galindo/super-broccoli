<?php
    define("ROOTUSER", "root");
    define("DBUSER", "BibliotecaSuperBroccoli");
    define("DBHOST", "localhost");
    define("PASSWORD", "");
    define("DB", "biblioteca");

    function conectdb()
    {
        $c = mysqli_connect(DBHOST, DBUSER, PASSWORD, DB);
        if (!$c) {
            $usuario = DBUSER;
            $c = mysqli_connect(DBHOST, ROOTUSER, PASSWORD, DB);
            $consulta = "CREATE USER '$usuario'@'localhost' IDENTIFIED BY ''";
	        $r = mysqli_query($c, $consulta);

            $tablas = ["autor", "editorial", "genero"];
            foreach ($tablas as $tabla) {
                $consulta = "GRANT SELECT, INSERT ON biblioteca." . $tabla . " TO  '$usuario'@'localhost'";
                $r = mysqli_query($c, $consulta);
            }

            $tablas = ["formulario", "historial_descargas", "reporte", "libro_has_genero"];
            foreach ($tablas as $tabla) {
                $consulta = "GRANT SELECT, INSERT, DELETE ON biblioteca." . $tabla . " TO  '$usuario'@'localhost'";
                $r = mysqli_query($c, $consulta);
            }

            $tablas = ["libro"];
            foreach ($tablas as $tabla) {
                $consulta = "GRANT SELECT, INSERT, UPDATE, DELETE ON biblioteca." . $tabla . " TO  '$usuario'@'localhost'";
                $r = mysqli_query($c, $consulta);
            }

            $tablas = ["usuario", "tipo_usuario", "categoria", "historial_descargas"];
            foreach ($tablas as $tabla) {
                $consulta = "GRANT SELECT ON biblioteca." . $tabla . " TO  '$usuario'@'localhost'";
                $r = mysqli_query($c, $consulta);
            }

            $consulta = "GRANT SELECT, INSERT, DELETE ON biblioteca.usuario TO  '$usuario'@'localhost'";
            $r = mysqli_query($c, $consulta);
            $consulta = "GRANT SELECT, INSERT, DELETE ON biblioteca.favorito TO  '$usuario'@'localhost'";
            $r = mysqli_query($c, $consulta);
            mysqli_close($c);


            $c = mysqli_connect(DBHOST, DBUSER, PASSWORD, DB);
        }
        return $c;
    }
?>