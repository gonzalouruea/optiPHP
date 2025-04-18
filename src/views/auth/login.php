<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
  <h2>Iniciar Sesión</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form action="index.php?controller=Auth&action=login" method="POST" class="mt-3">
    <div class="mb-3">
      <label for="email" class="form-label">Correo electrónico</label>
      <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Contraseña</label>
      <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <button class="btn btn-primary w-100">Acceder</button>
  </form>

  <p class="mt-3">
    ¿No tienes cuenta? <a href="index.php?controller=Auth&action=showRegister">Regístrate</a>
  </p>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
