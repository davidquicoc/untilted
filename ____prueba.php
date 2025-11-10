<?php
require_once 'config.php';
$nombre = "David";
$apellidos = "Quico";
$dni = "12345678A";
$email = "david.quico@educa.madrid.org";
$contraseña = password_hash("contraseña", PASSWORD_DEFAULT);
$conn->query("INSERT INTO usuarios (dni, nombre, apellidos, correo, contraseña) VALUES ('$dni', '$nombre', '$apellidos', '$email', '$contraseña')");
echo "SISISIS";
exit();
?>