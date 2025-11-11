<?php
session_start();

require_once 'config.php';

//  Comprobar conexión a BD "Trabajo_Servidor"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $result = $conn->query("SELECT * FROM usuarios WHERE correo = '$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (!empty($user['contraseña']) && password_verify($password, $user['contraseña'])) {
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['correo'] = $user['correo'];
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['login-error'] = "Contraseña incorrecta.";
        }
    } else {
        $_SESSION['login-error'] = "Correo no encontrado.";
    }
}
header("Location: login.php");
exit();
?>