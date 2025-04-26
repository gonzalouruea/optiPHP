<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
  <h2>Registro de Usuario</h2>

  <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php elseif (!empty($exito)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($exito) ?></div>
  <?php endif; ?>

  <form action="index.php?controller=Auth&action=register" method="POST" class="mt-3">
    <div class="row mb-3">
      <div class="col-md-4">
        <div class="mb-3">
          <label for="rol" class="form-label">Tipo de Cuenta</label>
          <select name="rol" id="rol" class="form-select">
            <option value="usuario">Particular</option>
            <option value="corporativo">Empresa</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4">
        <label class="form-label">Nombre</label>
          <input type="text" name="nombre" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Apellido 1</label>
        <input type="text" name="apellido1" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Apellido 2</label>
        <input type="text" name="apellido2" class="form-control" required>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Dirección</label>
        <input type="text" name="direccion" class="form-control" required>
      </div>
  </div>
  <div class="row mb-3">
      <div class="col-md-4">
        <label class="form-label">Código Postal</label>
        <input type="text" name="codPostal" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Ciudad</label>
        <input type="text" name="ciudad" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">País</label>
        <input type="text" name="pais" class="form-control" required>
      </div>
  </div>
      <div class="col-md-6">
        <label class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control" required>
      </div>
    </div>
    <button class="btn btn-primary w-100 mt-3">Crear Cuenta</button>
  </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
