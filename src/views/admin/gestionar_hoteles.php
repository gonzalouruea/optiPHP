<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container my-4">
  <h2>Gestionar Hoteles</h2>

  <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php elseif (!empty($_GET['success'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
  <?php endif; ?>

  <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#nuevoHotelModal">
    Nuevo Hotel
  </button>

  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Zona</th>
          <th>Usuario</th>
          <th>Comisión</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($hoteles as $hotel): ?>
                    <tr>
                      <td><?= $hotel['id_hotel'] ?></td>
                      <td><?= htmlspecialchars($hotel['zona_nombre'] ?? 'Sin zona') ?></td>
                      <td><?= htmlspecialchars($hotel['Usuario']) ?></td>
                      <td><?= htmlspecialchars($hotel['Comision']) ?>%</td>
                      <td>
                        <button class="btn btn-sm btn-primary" onclick="editarHotel(<?= htmlspecialchars(json_encode($hotel)) ?>)">
                          Editar
                        </button>
                        <form action="index.php?controller=Admin&action=gestionarHoteles" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro de eliminar?')">
                          <input type="hidden" name="action" value="delete">
                          <input type="hidden" name="id_hotel" value="<?= $hotel['id_hotel'] ?>">
                          <button class="btn btn-sm btn-danger">Borrar</button>
                        </form>
                      </td>
                    </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Nuevo Hotel -->
<div class="modal fade" id="nuevoHotelModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo Hotel</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="index.php?controller=Admin&action=gestionarHoteles" method="POST">
          <input type="hidden" name="action" value="create">
          <div class="mb-3">
            <label>Zona</label>
            <select class="form-select" name="id_zona" required>
              <option value="">Selecciona zona</option>
              <?php foreach ($zonas as $z): ?>
                          <option value="<?= $z['id_zona'] ?>"><?= htmlspecialchars($z['descripcion']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label>Usuario (nombre del hotel)</label>
            <input type="text" name="usuario" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Contraseña (si aplica)</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Comisión (%)</label>
            <input type="number" name="comision" step="0.01" class="form-control" required>
          </div>
          <button class="btn btn-primary">Crear</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar Hotel -->
<div class="modal fade" id="editarHotelModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Hotel</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formEditar" action="index.php?controller=Admin&action=gestionarHoteles" method="POST">
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id_hotel" id="edit_id_hotel">

          <div class="mb-3">
            <label>Zona</label>
            <select class="form-select" name="id_zona" id="edit_id_zona" required>
              <option value="">Selecciona zona</option>
              <?php foreach ($zonas as $z): ?>
                          <option value="<?= $z['id_zona'] ?>"><?= htmlspecialchars($z['descripcion']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label>Usuario (nombre del hotel)</label>
            <input type="text" name="usuario" id="edit_usuario" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Nueva Contraseña (opcional)</label>
            <input type="password" name="password" id="edit_password" class="form-control">
          </div>
          <div class="mb-3">
            <label>Comisión (%)</label>
            <input type="number" name="comision" step="0.01" id="edit_comision" class="form-control" required>
          </div>
          <button class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function editarHotel(hotel) {
  document.getElementById('edit_id_hotel').value = hotel.id_hotel;
  document.getElementById('edit_id_zona').value = hotel.id_zona;
  document.getElementById('edit_usuario').value = hotel.usuario;
  document.getElementById('edit_comision').value = hotel.Comision;
  document.getElementById('edit_password').value = '';
  new bootstrap.Modal(document.getElementById('editarHotelModal')).show();
}
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>
