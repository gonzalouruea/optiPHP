<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">"Isla-Transfers"</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <?php if (!isset($_SESSION['email'])): ?>
        <!-- Solo se muestra "Iniciar sesión" si el usuario no está logueado -->
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <?php endif; ?>
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
        <?php if (isset($_SESSION['email'])): ?>
        <!-- Si el usuario está logueado -->
        <li class="nav-item">
          <span class="nav-link">Bienvenido, <?php echo htmlspecialchars($_SESSION['email']); ?>!</span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Cerrar sesión</a>
        </li>
        <?php else: ?>
        <!-- Si el usuario NO está logueado -->
        <li class="nav-item">
          <a class="nav-link" href="altaUsuario.php">Registrarse</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
