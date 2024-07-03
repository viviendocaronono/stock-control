<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_elemento = $_POST['id_elemento'];
    $nuevo_nombre = $_POST['nuevo_nombre'];
    $nueva_descripcion = $_POST['nueva_descripcion'];
    
    // Validación básica
    if (empty($id_elemento) || (empty($nuevo_nombre) && empty($nueva_descripcion))) {
        echo "Por favor, complete al menos uno de los campos (nuevo nombre o nueva descripción).";
    } else {
        // Construir la consulta según los campos proporcionados
        $query_update = "UPDATE stock SET ";
        $update_params = array();
        
        if (!empty($nuevo_nombre)) {
            $query_update .= "nombre = ?";
            $update_params[] = $nuevo_nombre;
        }
        
        if (!empty($nueva_descripcion)) {
            if (!empty($update_params)) {
                $query_update .= ", ";
            }
            $query_update .= "descripcion = ?";
            $update_params[] = $nueva_descripcion;
        }
        
        $query_update .= " WHERE id = ?";
        $update_params[] = $id_elemento;
        
        // Preparar y ejecutar la consulta
        $stmt = $con->prepare($query_update);
        
        // Bind parameters
        $param_types = str_repeat("s", count($update_params));
        $stmt->bind_param($param_types, ...$update_params);
        
        if ($stmt->execute()) {
            echo "Elemento actualizado correctamente.";
        } else {
            echo "Error al actualizar el elemento: " . $stmt->error;
        }
        
        $stmt->close();
    }
}
?>
