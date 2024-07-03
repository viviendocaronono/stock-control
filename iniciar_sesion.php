<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesión</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <center>
        <section>
            <h1>Iniciar Sesión</h1>
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'incorrect_password') {
                    echo "<p style='color:red;'>Clave incorrecta</p>";
                } elseif ($_GET['error'] == 'user_not_found') {
                    echo "<p style='color:red;'>Usuario no encontrado</p>";
                }
            }
            ?>
            <form action="include/verificar_usuario.php" method="POST">
                <label for="nombre">Nombre de usuario:</label>
                <input type="text" id="nombre" name="nombre" required>
                <br>
                <label for="clave">Clave:</label>
                <input type="password" id="clave" name="clave" required>
                <br>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </section>
    </center>
</body>
</html>
