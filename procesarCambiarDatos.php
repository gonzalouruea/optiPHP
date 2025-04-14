<?php
session_start();
$emailOriginal = $_SESSION['email']; // Email actual con el que inició sesión

require_once 'conexion.php';

// Datos del formulario
$nombre = $_POST['nombre'] ?? '';
$nuevoEmail = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Inicializamos las variables con los valores actuales de la sesión o con valores vacíos si no están definidos
$nombre = !empty($nombre) ? $nombre : ($_SESSION['nombre'] ?? '');
$nuevoEmail = !empty($nuevoEmail) ? $nuevoEmail : ($_SESSION['email'] ?? '');  // Si no hay nuevo email, mantenemos el actual

// Si el password no ha sido modificado, mantenemos el valor original
if (empty($password)) {
    // Si no se pasa una nueva contraseña, la dejamos como está
    $stmt = $db->prepare("SELECT password FROM transfer_viajeros WHERE email = :email");
    $stmt->execute([':email' => $emailOriginal]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $password = $result['password'];  // Mantener la contraseña original
} else {
    // Si se pasa una nueva contraseña, la ciframos
    $password = password_hash($password, PASSWORD_BCRYPT);
}

// Construimos la consulta SQL y los parámetros a ejecutar según los campos modificados
$sql = "UPDATE transfer_viajeros SET password = :password, email = :nuevoEmail WHERE email = :emailOriginal";

$params = [
    ':password' => $password,
    ':nuevoEmail' => $nuevoEmail,
    ':emailOriginal' => $emailOriginal
];

// Solo agregamos 'nombre' si es que se ha modificado
if (!empty($nombre)) {
    $sql = "UPDATE transfer_viajeros SET nombre = :nombre, password = :password, email = :nuevoEmail WHERE email = :emailOriginal";
    $params[':nombre'] = $nombre;
}

// Modificamos los datos del usuario
try {
    $stmt = $db->prepare($sql);
    $stmt->execute($params);

    $exito = "Los cambios han sido guardados con éxito";

    // Solo actualizamos la sesión si el email realmente ha cambiado
    if (!empty($nuevoEmail) && $nuevoEmail !== $emailOriginal) {
        $_SESSION['email'] = $nuevoEmail;
    }

} catch (PDOException $e) {
    $error = "Error al modificar los datos: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
<?php include 'nav.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <h2 id="exito" class="alert alert-success">
                <?php echo $exito ?? $error; ?>
            </h2>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
