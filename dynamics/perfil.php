<?php
    session_start();
    if (!isset($_SESSION["nombre"])) {
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del perfil</title>
</head>
<body>
    <table>
        <?php
        require "./config.php"

        //Conexión con base de datos
        $c = conectdb($id_usuario, $password);

        $id = $_SESSION["id_usuario"];
        $consulta = "SELECT * FROM usuario t1
        INNER JOIN tipo_usuario t2 ON t1.id_tipo_usuario = t2.id_tipo 
        WHERE num_cuenta_rfc='$id';";

        //consulta de usuarios
        $r = mysqli_query($c, $consulta);
        $row = mysqli_fetch_array($r);

        echo '
        <thead>
            <tr>
                <th colspan="2">Tipo de usuario: '. $row["tipo"] .'</th>
            </tr>
        <thead>
        <tbody>
            <tr>
               <td>Número de cuenta o RFC: </td>
               <td>'. $row["num_cuenta_rfc"] .'</td>
            </tr>
            <tr>
                <td>Correo electrónico: </td>
                <td>'. $row["correo"].'</td>
            </tr>
            <tr>
                <td>StronNombre de usuario: </td>
                <td>'.$row["nombre"].'</td>
            </tr>
            <tr>
                <td>Apellidos</td>
                <td>'. $row["primer_apellido"] .' '. $row["segundo_apellido"] .'</td>
            </tr>
        </tbody>
        ';
        mysqli_close($c);
        ?>
    </table>
    <br><br>
    <form action="./confirm.php" method="POST">
        <input type="submit" value="Eliminar cuenta">
    </form>
</body>
</html>
<?php
   
