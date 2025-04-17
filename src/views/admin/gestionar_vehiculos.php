<?php include __DIR__ . '/../layout/header.php'; ?>


<div class="container my-4">
  <h2>Gestionar Vehículos</h2>

  <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php elseif (!empty($_GET['success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
  <?php endif; ?>

  <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#nuevoVehiculoModal">
    Nuevo Vehículo
  </button>

  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Descripción del Vehiculo</th>
          <th>Email del Conductor</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($vehiculos as $v): ?>
                  <tr>
                    <td><?= $v['id_vehiculo'] ?></td>
                    <td><?= htmlspecialchars($v['Descripción']) ?></td>
                    <td><?= htmlspecialchars($v['email_conductor']) ?></td>
                    <td>
                      <button class="btn btn-sm btn-primary"
                        onclick="editarVehiculo(<?= htmlspecialchars(json_encode($v)) ?>)">Editar</button>
                      <form action="index.php?controller=Admin&action=gestionarVehiculos" method="POST" class="d-inline"
                        onsubmit="return confirm('¿Seguro de eliminar?')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id_vehiculo" value="<?= $v['id_vehiculo'] ?>">
                        <button class="btn btn-sm btn-danger">Borrar</button>
                      </form>
                    </td>
                  </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Nuevo Vehículo -->
<div class="modal fade" id="nuevoVehiculoModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo Vehículo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="index.php?controller=Admin&action=gestionarVehiculos" method="POST">
          <input type="hidden" name="action" value="create">
          <div class="mb-3">
            <label>Descripción del Vehiculo</label>
            <input type="text" name="descripcion" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Email del Conductor</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button class="btn btn-primary">Crear</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar Vehículo -->
<div class="modal fade" id="editarVehiculoModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Vehículo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="index.php?controller=Admin&action=gestionarVehiculos" method="POST">
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id_vehiculo" id="edit_id_vehiculo">
          <div class="mb-3">
            <label>Descripción</label>
            <input type="text" name="descripcion" id="edit_descripcion" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Email del Conductor</label>
            <input type="email" name="email" id="edit_email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Nueva Contraseña (opcional)</label>
            <input type="password" name="password" id="edit_password" class="form-control">
          </div>
          <button class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function editarVehiculo(vehiculo) {
    document.getElementById('edit_id_vehiculo').value = vehiculo.id_vehiculo;
    document.getElementById('edit_descripcion').value = vehiculo.Descripción;
    document.getElementById('edit_email').value = vehiculo.email_conductor;
    document.getElementById('edit_password').value = '';
    new bootstrap.Modal(document.getElementById('editarVehiculoModal')).show();
  }
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>
