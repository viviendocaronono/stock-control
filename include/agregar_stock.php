<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_nuevo = $_POST['nombre_nuevo'];
    $cantidad_nueva = $_POST['cantidad_nueva'];
    $descripcion_nueva = $_POST['descripcion_nueva'];
    
    // Validación básica
    if (empty($nombre_nuevo) || empty($cantidad_nueva) || empty($descripcion_nueva)) {
        echo "Por favor, complete todos los campos.";
    } else {
        // Insertar nuevo elemento en la tabla stock
        $query_insert = "INSERT INTO stock (nombre, cantidad, descripcion) VALUES (?, ?, ?)";
        $stmt = $con->prepare($query_insert);
        $stmt->bind_param("sis", $nombre_nuevo, $cantidad_nueva, $descripcion_nueva);
        
        if ($stmt->execute()) {
            echo "Nuevo elemento agregado al stock.";
        } else {
            echo "Error al agregar el nuevo elemento: " . $stmt->error;
        }
    }
}

?>
