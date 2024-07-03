<?php
session_start();
include "conexion.php";

$nombre = $_REQUEST['nombre'];
$clave = $_REQUEST['clave'];

$SQL = "SELECT * FROM usuario WHERE nombre = '$nombre'";
$res = $con->query($SQL);

if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    if (password_verify($clave, $row['clave'])) {
        $_SESSION['usuario'] = $nombre;
        header('location:../stock.php');
    } else {
        echo "Clave incorrecta";
    }
} else {
    echo "Usuario no encontrado";
}
?>








