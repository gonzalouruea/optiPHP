<?php
ob_start(); // Inicia el buffer de salida
session_start();
require 'conexion.php'; // aquí se define $db como instancia de PDO

// Recibir datos del formulario
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validación básica
if (empty($email) || empty($password)) {
    die("Email y contraseña son obligatorios.");
}

// Buscar el usuario en la base de datos con PDO
$sql = "SELECT email, password, admin FROM transfer_viajeros WHERE email = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$email]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Depuración: Verificar si los datos se recuperaron correctamente
if ($usuario) {
    // Limpiar el hash de la contraseña (eliminar saltos de línea y espacios extras)
    $usuario['password'] = trim($usuario['password']);

    // Verificar la contraseña
    if (password_verify($password, $usuario['password'])) {
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['admin'] = $usuario['admin']; // Guardamos si es admin en la sesión

        // Redirigir según el rol
        if ($usuario['admin'] == 1) {
            header("Location: index.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Usuario no encontrado.";
}
?>
