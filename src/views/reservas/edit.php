<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container my-4">
  <h2>Editar Reserva</h2>

  <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <?php if (!$reserva): ?>
      <div class="alert alert-warning">No se encontró la reserva</div>
  <?php else: ?>
      <form action="index.php?controller=Reserva&action=update&id=<?= $reserva['id_reserva'] ?>" method="POST">
        <div class="mb-3">
          <label class="form-label">Hotel</label>
          <select class="form-select" name="id_hotel" required>
            <?php foreach ($hoteles as $h): ?>
                <option value="<?= $h['id_hotel'] ?>" <?= ($h['id_hotel'] == $reserva['id_hotel']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($h['Usuario']) ?>
                </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Vehículo</label>
          <select class="form-select" name="id_vehiculo" required>
            <?php foreach ($vehiculos as $v): ?>
                <option value="<?= $v['id_vehiculo'] ?>" <?= ($v['id_vehiculo'] == $reserva['id_vehiculo']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($v['Descripción']) ?>
                </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Número de Viajeros</label>
          <input type="number" class="form-control" name="num_viajeros"
            value="<?= htmlspecialchars($reserva['num_viajeros']) ?>" required>
        </div>

        <?php
        // Si tipo_trayecto = 1 (llegada) o 3, mostramos fecha_entrada/hora_entrada
        // Pero aquí lo simplifico y te muestro campos siempre. Ajusta según tu necesidad
        ?>
        <h5>Datos de Llegada</h5>
        <div class="row g-2 mb-3">
          <div class="col-md-4">
            <label>Fecha Llegada</label>
            <input type="date" name="fecha_entrada" class="form-control"
              value="<?= htmlspecialchars($reserva['fecha_entrada']) ?>">
          </div>
          <div class="col-md-4">
            <label>Hora Llegada</label>
            <input type="time" name="hora_entrada" class="form-control"
              value="<?= htmlspecialchars($reserva['hora_entrada']) ?>">
          </div>
          <div class="col-md-4">
            <label>Número Vuelo (Llegada)</label>
            <input type="text" name="numero_vuelo_entrada" class="form-control"
              value="<?= htmlspecialchars($reserva['numero_vuelo_entrada']) ?>">
          </div>
        </div>

        <h5>Datos de Salida</h5>
        <div class="row g-2 mb-3">
          <div class="col-md-4">
            <label>Fecha Salida</label>
            <input type="date" name="fecha_vuelo_salida" class="form-control"
              value="<?= htmlspecialchars($reserva['fecha_vuelo_salida']) ?>">
          </div>
          <div class="col-md-4">
            <label>Hora Salida</label>
            <input type="time" name="hora_vuelo_salida" class="form-control"
              value="<?= htmlspecialchars($reserva['hora_vuelo_salida']) ?>">
          </div>
          <div class="col-md-4">
            <label>Hora Recogida</label>
            <input type="time" name="hora_recogida" class="form-control"
              value="<?= htmlspecialchars($reserva['hora_recogida']) ?>">
          </div>
        </div>

        <button class="btn btn-primary">Guardar Cambios</button>

        <?php if (!empty($_SESSION['admin'])): ?>
            <!-- Botón para eliminar (admin) -->
            <button type="submit" class="btn btn-danger" name="action" value="delete"
              formaction="index.php?controller=Reserva&action=delete&id=<?= $reserva['id_reserva'] ?>"
              onclick="return confirm('¿Seguro que deseas eliminar esta reserva?')">
              Eliminar
            </button>
        <?php endif; ?>
      </form>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
