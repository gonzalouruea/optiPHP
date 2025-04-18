<?php
$clave = "admin"; // La contraseña en texto plano que quieres
$hash = password_hash($clave, PASSWORD_DEFAULT);
echo "Hash para 'admin': " . $hash . "\n";
?>
