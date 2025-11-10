<?php
session_start();
require_once 'config.php';

// Captura los datos del formulario
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$dni = strtoupper(trim($_POST['dni']));
$email = trim($_POST['email']);
$password = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

// Validación de DNI
function validarDNI($dni) {
    return preg_match('/^[0-9]{8}[A-Z]$/', $dni);
}

// Verifica si el correo ya está registrado
$checkEmail = $conn->query("SELECT correo FROM usuarios WHERE correo = '$email'");
if ($checkEmail->num_rows > 0) {
    $_SESSION['registro-error'] = 'Ese correo ya está registrado.';
    header("Location: ./../register.php");
    exit();
}

// Verifica si el DNI ya está registrado
$checkDNI = $conn->query("SELECT dni FROM usuarios WHERE dni = '$dni'");
if ($checkDNI->num_rows > 0) {
    $_SESSION['registro-error'] = 'Ese DNI ya está registrado.';
    header("Location: ./../register.php");
    exit();
}

// Verifica si el DNI es válido
if (!validarDNI($dni)) {
    $_SESSION['registro-error'] = 'DNI inválido.';
    header("Location: ./../register.php");
    exit();
}

// Inserta el nuevo usuario
$conn->query("INSERT INTO usuarios (dni, nombre, apellidos, correo, contraseña) VALUES ('$dni', '$nombre', '$apellidos', '$email', '$password')");

// Redirige al login para que el usuario inicie sesión manualmente
$_SESSION['registro-exito'] = 'Registro exitoso. Ahora puedes iniciar sesión.';
header("Location: ./../login.php");
exit();
?>
