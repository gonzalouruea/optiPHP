<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Isla-Transfers</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


  <link rel="stylesheet" href="/css/styles.css">




</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Isla-Transfers</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">≡</span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <!-- HOME -->
          <li class="nav-item">
            <a class="nav-link" href="index.php">Inicio</a>
          </li>

          <?php if (empty($_SESSION['email'])): ?>
                <!-- NO logueado: Login / Register -->
                <li class="nav-item">
                  <a class="nav-link" href="index.php?controller=Auth&action=showLogin">Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.php?controller=Auth&action=showRegister">Registro</a>
                </li>

          <?php else: ?>
                <!-- Logueado: mostrar según rol -->
                <?php
                // Rol en la sesión, e.g. $_SESSION['rol'] = 'admin' / 'usuario' / 'corporativo'
                $rol = $_SESSION['rol'] ?? 'usuario';
                if ($rol === 'admin'):
                  ?>
                      <!-- Menú Admin -->
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Panel Admin</a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="index.php?controller=Admin&action=panel">Dashboard</a></li>
                          <li><hr></li>
                          <li><a class="dropdown-item" href="index.php?controller=Reserva&action=create">Nueva Reserva</a></li>
                          <li><a class="dropdown-item" href="index.php?controller=Reserva&action=index">Ver Reservas</a></li>
                          <li><a class="dropdown-item" href="index.php?controller=Reserva&action=calendario">Calendario</a></li>
                          <li><hr></li>
                          <li><a class="dropdown-item" href="index.php?controller=Admin&action=gestionarVehiculos">Vehículos</a></li>
                          <li><a class="dropdown-item" href="index.php?controller=Admin&action=gestionarHoteles">Hoteles</a></li>
                          <li><a class="dropdown-item" href="index.php?controller=Admin&action=gestionarZonas">Zonas</a></li>
                          <li><a class="dropdown-item" href="index.php?controller=Admin&action=gestionarTipos">Tipos de Reserva</a></li>
                        </ul>
                      </li>

                <?php elseif ($rol === 'corporativo'): ?>
                      <!-- Menú Corporativo (usa menús parecidos a usuario, u otro condicional) -->
                      <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Reserva&action=index">Mis Reservas (Corp)</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Reserva&action=create">Nueva Reserva (Corp)</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Auth&action=showCambiarDatos">Perfil</a>
                      </li>

                <?php else: ?>
                      <!-- rol === 'usuario' particular -->
                      <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Reserva&action=index">Mis Reservas</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Reserva&action=create">Nueva Reserva</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Auth&action=showCambiarDatos">Perfil</a>
                      </li>
                <?php endif; ?>
          <?php endif; ?>
        </ul>

        <!-- Si está logueado, mostramos el email y botón logout -->
        <?php if (!empty($_SESSION['email'])): ?>
              <span class="navbar-text me-3">
                Bienvenido, <?= htmlspecialchars($_SESSION['email']) ?>!
              </span>
              <a class="btn btn-outline-danger" href="index.php?controller=Auth&action=logout">Cerrar sesión</a>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
