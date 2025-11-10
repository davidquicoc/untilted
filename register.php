<?php
session_start();

$error = $_SESSION['registro-error'] ?? '';
unset($_SESSION['registro-error']);

function mostrarError($error) {
    return !empty($error) ? "<p class='error-mensaje'>$error</p>" : '';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="css/form-login-register.css">
</head>
<body>

<div class="content">
    <div class="form-content">
        <form action="./confirm/register-confirm.php" method="POST">
            <h2>Registro</h2>
            <?= mostrarError($error); ?>

            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="apellidos" placeholder="Apellidos" required>
            <input type="text" name="dni" placeholder="DNI (8 números y 1 letra)" pattern="[0-9]{8}[A-Z]" title="Debe tener 8 números y una letra mayúscula" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="contraseña" placeholder="Contraseña" required>

            <button type="submit">Registrarse</button>
        </form>

        <p class="parrafo-form">¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </div>
</div>

</body>
</html>
