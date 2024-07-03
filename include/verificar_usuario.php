<?php
include "conexion.php";

$nombre = $_POST['nombre'];
$clave = $_POST['clave'];

$SQL = "SELECT * FROM usuario WHERE nombre = '$nombre'";
$res = $con->query($SQL);

if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    if (password_verify($clave, $row['clave'])) {
        session_start();
        $_SESSION['usuario'] = $nombre;
        $_SESSION['rol'] = $row['rol'];
        header('Location: ../index.php');
        exit();
    } else {
        header('Location: ../iniciar_sesion.php?error=incorrect_password');
        exit();
    }
} else {
    header('Location: ../iniciar_sesion.php?error=user_not_found');
    exit();
}
?>
