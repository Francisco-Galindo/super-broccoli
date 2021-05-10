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
        echo '
        <thead>
            <tr>
                <th colspan="2">Tipo de usuario: '.$_SESSION["tipo"].'</th>
            </tr>
        <thead>
        <tbody>
            <tr>
               <td>Número de cuenta o RFC: </td>
               <td>'.$_SESSION["id"].'</td>
            </tr>
            <tr>
                <td>Correo electrónico: </td>
                <td>'.$_SESSION["email"].'</td>
            </tr>
            <tr>
                <td>StronNombre de usuario: </td>
                <td>'.$_SESSION["nombre"].'</td>
            </tr>
            <tr>
                <td>Apellidos</td>
                <td>'.$_SESSION["prim_ape"].' '.$_SESSION["seg_ape"].'</td>
            </tr>
        </tbody>
        ';
        ?>
    </table>
    <br><br>
    <form action="./confirm.php" method="POST">
        <input type="submit" value="Eliminar cuenta">
    </form>
</body>
</html>
<?php
   
