<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
        <a class="navbar-brand" href="#">Isla-Transfers</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Clientes
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Particulares</a></li>
                    <li><a class="dropdown-item" href="#">Agencia de viajes</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Administrador</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
            </ul>
        
        </div>
  </div>
</nav>

<div class="container my-5">
    <!-- Título -->
    <div class="text-center py-2">
        <h2>¡Crea una cuenta para ser uno mas de nosotros!</h2>
    </div>
    <br>

    <!-- Formulario centrado en el contenedor -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form class="row g-3 needs-validation" action="procesarAltaUsuario.php" method="POST" novalidate>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="validationCustom01" name="nombre" placeholder="Introduce tu nombre" required>
                    <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="validationCustom02" name="apellido1" placeholder="Primer apellido" required>
                    <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="validationCustom02" name="apellido2" placeholder="Segundo apellido" required>
                    <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-6">
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" class="form-control" id="validationCustomUsername" name="email" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">Please choose a username.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="validationCustom05" name="direccion" placeholder="Direccion" required>
                    <div class="invalid-feedback">Please provide a valid zip.</div>
                </div>
                <div class="col-md-6">
                    <input type="password" class="form-control" id="validationCustom05" name="password" placeholder="Password" required>
                    <div class="invalid-feedback">Please provide a valid zip.</div>
                </div>
                
                <div class="col-md-6">
                    <input type="text" class="form-control" id="validationCustom03" name="codPostal" placeholder="Codigo Postal" required>
                    <div class="invalid-feedback">Please provide a valid city.</div>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="validationCustom03" name="ciudad" placeholder="Ciudad" required>
                    <div class="invalid-feedback">Please provide a valid city.</div>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="validationCustom03" name="pais" placeholder="Pais" required>
                    <div class="invalid-feedback">Please provide a valid city.</div>
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
