<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container my-4">
  <h2>Gestionar Zonas</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php elseif (!empty($_GET['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
  <?php endif; ?>

  <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#nuevaZonaModal">
    Nueva Zona
  </button>

  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Descripción</th>
          <th>Hoteles</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($zonas as $z): ?>
          <tr>
            <td><?= $z['id_zona'] ?></td>
            <td><?= htmlspecialchars($z['descripcion']) ?></td>
            <td><?= htmlspecialchars($z['num_hoteles']) ?></td>
            <td>
              <button class="btn btn-sm btn-primary"
                onclick="editarZona(<?= htmlspecialchars(json_encode($z)) ?>)">Editar</button>
              <form action="index.php?controller=Admin&action=gestionarZonas" method="POST" class="d-inline"
                onsubmit="return confirm('¿Seguro de eliminar?')">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id_zona" value="<?= $z['id_zona'] ?>">
                <button class="btn btn-sm btn-danger" <?= ($z['num_hoteles'] > 0) ? 'disabled' : '' ?>>
                  Borrar
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Nueva Zona -->
<div class="modal fade" id="nuevaZonaModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nueva Zona</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="index.php?controller=Admin&action=gestionarZonas" method="POST">
          <input type="hidden" name="action" value="create">
          <div class="mb-3">
            <label>Descripción</label>
            <input type="text" name="descripcion" class="form-control" required>
          </div>
          <button class="btn btn-primary">Crear Zona</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar Zona -->
<div class="modal fade" id="editarZonaModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Zona</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="index.php?controller=Admin&action=gestionarZonas" method="POST">
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id_zona" id="edit_id_zona">
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
  function editarZona(zona) {
    document.getElementById('edit_id_zona').value = zona.id_zona;
    document.getElementById('edit_descripcion').value = zona.descripcion;
    new bootstrap.Modal(document.getElementById('editarZonaModal')).show();
  }
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>
