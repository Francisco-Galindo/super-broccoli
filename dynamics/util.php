<?php
function encabezados($tipo) {
    switch ($tipo)
    {
        case 'Lector':
            echo"<table>";
                echo"<thead>"; 
                    echo"<th><a href=\"./index.php\"><button>Inicio</button></a></th>";
                    echo"<th><a href=\"./favoritos.php\"><button>Favoritos</button></a><th>";
                    echo"<th><a href=\"../templates/Solicitud.html\"><button>Solicitud de libro</button></a></th>";
                    echo"<th><a href=\"./perfil.php\"><button>Ver Perfil</button></a></th>";
                    echo"<th><a href=\"cerrar.php\"><button>Cerrar sesión</button></a></th>";
                echo"</thead>";
            echo"</table>";
            break;

        case 'Bibliotecario':
            echo"<table>";
                echo"<thead>";
                    echo"<th><a href=\"./index.php\"><button>Inicio</button></a></th>";
                    echo"<th><a href=\"./favoritos.php\"><button>Favoritos</button></a></th>";
                    echo"<th><a href=\"./descargas.php\"><button>Historial descargas</button></a></th>";
                    echo"<th><a href=\"./nuevo_libro.php\"><button>Subir libro</button></a></th>";
                    echo"<th><a href=\"./ver_formulario.php\"><button>Solicitudes de libros</button></a></th>";
                    echo"<th><a href=\"./perfil.php\"><button>Ver Perfil</button></a></th>";
                    echo"<th><a href=\"cerrar.php\"><button>Cerrar sesión</button></a></th>";
                echo"</thead>";
            echo"</table>";
            break;

        case 'Administrador':
            echo"<table>";
                echo"<thead>";
                    echo"<th><a href=\"./index.php\"><button>Inicio</button></a></th>";
                    echo"<th><a href=\"./favoritos.php\"><button>Favoritos</button></a></th>";
                    echo"<th><a href=\"./descargas.php\"><button>Historial descargas</button></a></th>";
                    echo"<th><a href=\"./nuevo_libro.php\"><button>Subir libro</button></a></th>";
                    echo"<th><a href=\"./ver_formulario.php\"><button>Solicitudes de libros</button></a></th>";
                    echo"<th><a href=\"./Usuarios.php\"><button>Usuarios</button></a></th>";
                    echo"<th><a href=\"./perfil.php\"><button>Ver Perfil</button></a></th>";
                    echo"<th><a href=\"cerrar.php\"><button>Cerrar sesión</button></a></th>";
                echo"</thead>";
            echo"</table>";
            break;
    }
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
    mysqli_close($c);

    return ($r);
}

function redireccionarSiSesionInvalida() {
    session_start();
    if (!isset($_SESSION["nombre"])) {
        header("location: login.php");
    }
}

?>