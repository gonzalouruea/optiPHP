<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
  <h2>Modificar Datos Personales</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php elseif (!empty($exito)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($exito) ?></div>
  <?php endif; ?>

  <form action="index.php?controller=Auth&action=cambiarDatos" method="POST" class="mt-3">
    <div class="mb-3">
      <label class="form-label">Nuevo Nombre (opcional)</label>
      <input type="text" name="nombre" class="form-control" placeholder="Tu nombre actual u otro">
    </div>
    <div class="mb-3">
      <label class="form-label">Nuevo Email (opcional)</label>
      <input type="email" name="email" class="form-control" placeholder="Si quieres cambiarlo">
    </div>
    <div class="mb-3">
      <label class="form-label">Nueva Contraseña (opcional)</label>
      <input type="password" name="password" class="form-control" placeholder="Dejar vacío para no cambiar">
    </div>
    <button class="btn btn-primary">Guardar Cambios</button>
  </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
