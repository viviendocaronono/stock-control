<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('location:iniciar_sesion.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <center>
        <section>
            <h1>Stock</h1>
            <ul>
            <?php
            include 'include/conexion.php';
            
            if (isset($_SESSION['usuario'])) {
                $nombre_usuario = $_SESSION['usuario'];
                
                // Consultar el rol del usuario
                $query = "SELECT rol FROM usuario WHERE nombre = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param("s", $nombre_usuario);
                $stmt->execute();
                $stmt->bind_result($rol);
                $stmt->fetch();
                $stmt->close();
            } else {
                header('Location: iniciar_sesion.php');
            }
            // Consultar todos los elementos de stock
            $query_stock = "SELECT id, nombre, cantidad, descripcion FROM stock";
            $result_stock = $con->query($query_stock);

            if ($result_stock->num_rows > 0) {
                echo "<table border='1'>
                    <tr><th>Nombre</th><th>ID</th><th>Cantidad</th><th>Descripción</th></tr>";
                
                while($row = $result_stock->fetch_assoc()) {
                    echo "<tr><td>" . $row["nombre"] . "</td><td>" . $row["id"] . "</td><td>" . $row["cantidad"] . "</td><td>" . $row["descripcion"] . "</td></tr>";
                    
                    // Mostrar opciones adicionales para administradores
                    if ($rol == "admin") {
                        echo "<tr><td colspan='4'>";
                        echo "<form action='include/editar_stock.php' method='post'>";
                        echo "<input type='hidden' name='id_elemento' value='" . $row["id"] . "'>";
                        echo "Añadir stock: <input type='number' name='cantidad_a_agregar'><br>";
                        echo "Tomar stock: <select name='cantidad_a_tomar'>";
                        for ($i = 1; $i <= $row["cantidad"]; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                        echo "</select><br>";
                        echo "Editar descripción: <input type='text' name='nueva_descripcion' value='" . $row["descripcion"] . "'><br>";
                        echo "Modificar nombre: <input type='text' name='nuevo_nombre' value='" . $row["nombre"] . "'><br>";
                        echo "<input type='submit' value='Actualizar'>";
                        echo "</form>";
                        echo "</td></tr>";

                    }
                }
                echo "</table>";
                
                // Formulario para agregar nuevos elementos al stock (solo visible para administradores)
                if ($rol == "admin") {
                    echo "<form action='include/agregar_stock.php' method='post'>";
                    echo "Nombre: <input type='text' name='nombre_nuevo'><br>";
                    echo "Cantidad: <input type='number' name='cantidad_nueva'><br>";
                    echo "Descripción: <input type='text' name='descripcion_nueva'><br>";
                    echo "<input type='submit' value='Agregar nuevo elemento'>";
                    echo "</form>";
                }
            } else {
                echo "No se encontraron elementos en el stock.";
            }
            ?>

            </ul>
        </section>
    </center>
</body>
</html>

