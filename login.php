<?php
session_start();
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


<div class="container my-5">
    <!-- Título -->
    <div class="text-center py-2">
        <h2>¡Te estábamos esperando!</h2>
    </div>
    
    <!-- Formulario centrado en el contenedor -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="formulario" action="procesarLogin.php" method="POST" style="width: 100%;">
                <div class="row mb-4">
                    <div class="col-md-12">
                        <p id="p-formulario">Introduce tus datos</p>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12">
                        <input type="submit" name="enviar" id="enviar" class="btn btn-primary w-100">
                    </div>
                </div>
                <div class="text-center">
                    <p>Si no tienes cuenta, crea una <a href="altaUsuario.php">aquí</a>.</p>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Archivos JavaScript de Bootstrap (incluye Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>


