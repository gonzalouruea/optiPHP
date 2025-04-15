<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container my-4">
  <h2>Gestionar Tipos de Reserva</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php elseif (!empty($_GET['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
  <?php endif; ?>

  <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#nuevoTipoModal">
    Nuevo Tipo
  </button>

  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Descripción</th>
          <th># Reservas</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tipos as $t): ?>
          <tr>
            <td><?= $t['id_tipo_reserva'] ?></td>
            <td><?= htmlspecialchars($t['Descripción']) ?></td>
            <td><?= htmlspecialchars($t['num_reservas']) ?></td>
            <td>
              <button class="btn btn-sm btn-primary" onclick="editarTipo(<?= htmlspecialchars(json_encode($t)) ?>)">
                Editar
              </button>
              <?php if ($t['num_reservas'] == 0): ?>
                <form action="index.php?controller=Admin&action=gestionarTipos" method="POST" class="d-inline"
                  onsubmit="return confirm('¿Seguro de eliminar?')">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id_tipo_reserva" value="<?= $t['id_tipo_reserva'] ?>">
                  <button class="btn btn-sm btn-danger">Borrar</button>
                </form>
              <?php else: ?>
                <button class="btn btn-sm btn-secondary" disabled>No se puede borrar (en uso)</button>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Nuevo Tipo -->
<div class="modal fade" id="nuevoTipoModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo Tipo de Reserva</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="index.php?controller=Admin&action=gestionarTipos" method="POST">
          <input type="hidden" name="action" value="create">
          <div class="mb-3">
            <label>Descripción</label>
            <input type="text" name="descripcion" class="form-control" required>
          </div>
          <button class="btn btn-primary">Crear</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar Tipo -->
<div class="modal fade" id="editarTipoModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Tipo de Reserva</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="index.php?controller=Admin&action=gestionarTipos" method="POST">
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id_tipo_reserva" id="edit_id_tipo">
          <div class="mb-3">
            <label>Descripción</label>
            <input type="text" name="descripcion" id="edit_descripcion" class="form-control" required>
          </div>
          <button class="btn btn-primary">Guardar Cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function editarTipo(tipo) {
    document.getElementById('edit_id_tipo').value = tipo.id_tipo_reserva;
    document.getElementById('edit_descripcion').value = tipo.Descripción;
    new bootstrap.Modal(document.getElementById('editarTipoModal')).show();
  }
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>
