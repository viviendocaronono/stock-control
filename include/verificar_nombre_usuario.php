<?php
include "conexion.php";

$nombre = $_GET['nombre'];

$SQL = "SELECT * FROM usuario WHERE nombre = '$nombre'";
$res = $con->query($SQL);

if ($res->num_rows > 0) {
    echo json_encode(["exists" => true]);
} else {
    echo json_encode(["exists" => false]);
}

$con->close();
?>
