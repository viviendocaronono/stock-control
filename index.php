<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Control</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <center>
        <section>
            <h4>Sistema de gestión de stock</h4>
            <hr>
            <ul>
                <?php if (isset($_SESSION['usuario'])): ?>
                    <li><a href="stock.php">Stock</a></li>
                    <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
                <?php else: ?>
                    <li><a href="iniciar_sesion.php">Iniciar Sesión</a></li>
                    <li><a href="registrar_sesion.php">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </section>
    </center>
</body>
</html>
