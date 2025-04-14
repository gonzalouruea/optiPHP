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
        <h2>¡Modifica tus datos si es necesario!</h2>
    </div>
    <br>

    <!-- Formulario centrado en el contenedor -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form class="row g-3 needs-validation" action="procesarCambiarDatos.php" method="POST" novalidate>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="validationCustom01" name="nombre" placeholder="Introduce tu nombre">
                    <div class="valid-feedback">Looks good!</div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" class="form-control" id="validationCustomUsername" name="email" aria-describedby="inputGroupPrepend">
                        <div class="invalid-feedback">Please choose a username.</div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <input type="password" class="form-control" id="validationCustom05" name="password" placeholder="Password">
                    <div class="invalid-feedback">Please provide a valid zip.</div>
                </div>
                
               
                <div class="col-md-12">
                    <div class="col-md-12">
                        <input type="submit" name="enviar" id="enviar"  class="btn btn-primary w-100">
                    </div>
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
