<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
  <h2>Modificar Datos Personales</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php elseif (!empty($exito)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($exito) ?></div>
  <?php endif; ?>
  
    <?= isset($user->id_viajero) ? '<h4>Usuario: ' . htmlspecialchars($user->id_viajero) . '</h4>' : ''; ?>
  <form autocomplete="off"  action="index.php?controller=Auth&action=cambiarDatos" method="POST" class="mt-3">
  <input type="hidden" name="id_viajero" class="form-control" value="<?php echo isset($user["id_viajero"]) ? htmlspecialchars($user["id_viajero"]) : ''; ?>">
  <div>
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" required value="<?php echo isset($user["nombre"]) ? htmlspecialchars($user["nombre"]) : ''; ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Apellido 1</label>
        <input type="text" name="apellido1" class="form-control" required value="<?php echo isset($user["apellido1"]) ? htmlspecialchars($user["apellido1"]) : ''; ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Apellido 2</label>
        <input type="text" name="apellido2" class="form-control" required value="<?php echo isset($user["apellido2"]) ? htmlspecialchars($user["apellido2"]) : ''; ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required value="<?php echo isset($user["email"]) ? htmlspecialchars($user["email"]) : ''; ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Nueva Contraseña (opcional)</label>
        <input autocomplete="off"  type="password" name="password" class="form-control" placeholder="Dejar vacío para no cambiar">
      </div>
    <button class="btn btn-primary" type="submit">Guardar Cambios</button>
  </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
