<?php
include "conexion.php";

$nombre = $_POST['nombre'];
$clave = $_POST['clave'];

// Verificar la longitud de la contraseña
if (strlen($clave) > 12) {
    echo "La clave no debe exceder los 12 caracteres.";
    exit();
}

$clave_hashed = password_hash($clave, PASSWORD_DEFAULT);

$SQL = "INSERT INTO usuario (nombre, clave) VALUES ('$nombre', '$clave_hashed')";
if ($con->query($SQL) === TRUE) {
    echo "Usuario registrado exitosamente";
} else {
    echo "Error: " . $SQL . "<br>" . $con->error;
}

$con->close();
?>
