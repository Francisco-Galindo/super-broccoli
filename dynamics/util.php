<?php
require "./config.php";

function encabezados($tipo) {

    echo"<table>
    <thead>
        <tr><th>Navegador</th></tr>    
    </thead>";
    echo"<tbody>";
    echo"<tr><td>";
    

    switch ($tipo)
    {
        case 'Lector': 
            echo "<a href=\"./index.php\"><button>Inicio</button></a>";
            echo "<a href=\"./favoritos.php\"><button>Favoritos</button></a>";
            echo "<a href=\"../templates/Solicitud.html\"><button>Solicitud de libro</button></a>";
            echo "<a href=\"./perfil.php\"><button>Ver Perfil</button></a>";
            echo "<a href=\"cerrar.php\"><button>Cerrar sesión</button></a>";
            break;

        case 'Bibliotecario':
            echo "<a href=\"./index.php\"><button>Inicio</button></a>";
            echo "<a href=\"./favoritos.php\"><button>Favoritos</button></a>";
            echo "<a href=\"./descargas.php\"><button>Historial descargas</button></a>";
            echo "<a href=\"./formulario_libro.php\"><button>Subir libro</button></a>";
            echo "<a href=\"./ver_formulario.php\"><button>Solicitudes de libros</button></a>";
            echo "<a href=\"./ver_reporte.php\"><button>Ver reportes</button></a>";
            echo "<a href=\"./perfil.php\"><button>Ver Perfil</button></a>";
            echo "<a href=\"cerrar.php\"><button>Cerrar sesión</button></a>";
            break;
                                                                              
        case 'Administrador':
            echo "<a href=\"./index.php\"><button>Inicio</button></a>";
            echo "<a href=\"./favoritos.php\"><button>Favoritos</button></a>";
            echo "<a href=\"./descargas.php\"><button>Historial descargas</button></a>";
            echo "<a href=\"./formulario_libro.php\"><button>Subir libro</button></a>";
            echo "<a href=\"./ver_formulario.php\"><button>Solicitudes de libros</button></a>";
            echo "<a href=\"./ver_reporte.php\"><button>Ver reportes</button></a>";
            echo "<a href=\"./Usuarios.php\"><button>Usuarios</button></a>";
            echo "<a href=\"./perfil.php\"><button>Ver Perfil</button></a>";
            echo "<a href=\"cerrar.php\"><button>Cerrar sesión</button></a>";
            break;                                                                          
    }
    echo"</td></tr>";
    echo"</tbody>";
    echo"</table>";
}

function usuarioEliminar($id_usuario) {
    //Conexión con base de datos
    connectdb();

    // Eliminando los registros de las tablas que dependan del usuario
    $consulta = "DELETE FROM formulario WHERE id_usuario='$id_usuario'";
    $r = mysqli_query($c, $consulta);
    $consulta = "DELETE FROM favorito WHERE id_usuario='$id_usuario'";
    $r = mysqli_query($c, $consulta);
    $consulta = "DELETE FROM historial_descargas WHERE id_usuario='$id_usuario'";
    $r = mysqli_query($c, $consulta);

    // Eliminando el usuario
    $consulta = "DELETE FROM usuario WHERE num_cuenta_rfc='$id_usuario'";
    $r = mysqli_query($c, $consulta);
    mysqli_close($c);

    return ($r);
}

function redireccionarSiSesionInvalida($tipo_usuario = "Lector", $tipo_requerido = "Lector") {
    session_start();
    if (!isset($_SESSION["nombre"])) {
        header("location: ./login.php");
    }

    $c = connectdb();
    $consulta = "SELECT id_tipo FROM tipo_usuario WHERE tipo='$tipo_usuario'";
    $r = mysqli_query($c, $consulta);
    $row = mysqli_fetch_array($r);
    $id_tipo_usuario = $row["id_tipo"];

    $consulta = "SELECT id_tipo FROM tipo_usuario WHERE tipo='$tipo_usuario'";
    $r = mysqli_query($c, $consulta);
    $row = mysqli_fetch_array($r);
    $id_tipo_requerido = $row["id_tipo"];

    mysqli_close($c);
    
    if ($id_tipo_usuario < $id_tipo_requerido) {
        header("location: ./index.php");
    }
}

?>