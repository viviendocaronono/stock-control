<?php
$con = new mysqli('localhost', 'root', '', 'bd-sql-stock');
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}
?>
