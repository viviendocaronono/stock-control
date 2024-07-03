<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Sesión</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <center>
        <section>
            <h1>Registrar Usuario</h1>
            <form id="registerForm" action="include/guardar.php" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                <span id="nombreError" style="color:red;"></span>
                <br>
                <label for="clave">Clave:</label>
                <input type="password" id="clave" name="clave" required>
                <span id="claveError" style="color:red;"></span>
                <br>
                <button type="submit" id="registerButton" disabled>Registrar</button>
            </form>
        </section>
    </center>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nombreInput = document.getElementById('nombre');
            const claveInput = document.getElementById('clave');
            const registerButton = document.getElementById('registerButton');
            const nombreError = document.getElementById('nombreError');
            const claveError = document.getElementById('claveError');

            nombreInput.addEventListener('input', validateForm);
            claveInput.addEventListener('input', validateForm);

            async function validateForm() {
                const nombre = nombreInput.value;
                const clave = claveInput.value;
                
                let valid = true;
                
                // Verificar si el nombre de usuario existe
                if (nombre.length > 0) {
                    const response = await fetch(`include/verificar_nombre_usuario.php?nombre=${nombre}`);
                    const data = await response.json();
                    if (data.exists) {
                        nombreError.textContent = 'El nombre de usuario ya existe';
                        valid = false;
                    } else {
                        nombreError.textContent = '';
                    }
                } else {
                    nombreError.textContent = '';
                    valid = false;
                }
                
                // Verificar la longitud de la clave
                if (clave.length > 12) {
                    claveError.textContent = 'La clave no debe exceder los 12 caracteres';
                    valid = false;
                } else if (clave.length === 0) {
                    claveError.textContent = '';
                    valid = false;
                } else {
                    claveError.textContent = '';
                }
                
                // Habilitar o deshabilitar el botón de registrar
                registerButton.disabled = !valid;
            }
        });
    </script>
</body>
</html>


