<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container my-4">
  <h2>Nueva Reserva</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form action="index.php?controller=Reserva&action=store" method="POST">
    <?php if (!empty($_SESSION['admin']) && !empty($usuarios)): ?>
      <div class="mb-3">
        <label class="form-label">Usuario</label>
        <select class="form-select" name="id_viajero">
          <option value="">Seleccionar usuario...</option>
          <?php foreach ($usuarios as $u): ?>
            <option value="<?= $u['id_viajero'] ?>"><?= htmlspecialchars($u['email']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    <?php endif; ?>

    <div class="mb-3">
      <label class="form-label">Tipo de Trayecto</label>
      <select class="form-select" name="tipo_trayecto" required>
        <option value="">Elige tipo...</option>
        <option value="1">Aeropuerto → Hotel</option>
        <option value="2">Hotel → Aeropuerto</option>
        <option value="3">Ida y Vuelta</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Número de Pasajeros</label>
      <input type="number" name="num_viajeros" class="form-control" required min="1">
    </div>

    <div class="mb-3">
      <label class="form-label">Vehículo</label>
      <select name="id_vehiculo" class="form-select" required>
        <?php foreach ($vehiculos as $veh): ?>
          <option value="<?= $veh['id_vehiculo'] ?>"><?= htmlspecialchars($veh['Descripción']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Hotel</label>
      <select name="id_hotel" class="form-select" required>
        <?php foreach ($hoteles as $h): ?>
          <option value="<?= $h['id_hotel'] ?>"><?= htmlspecialchars($h['usuario'] ?? "Hotel #{$h['id_hotel']}") ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Campos dinámicos: llegada -->
    <h5>Datos de Llegada (si aplica)</h5>
    <div class="row g-2 mb-3">
      <div class="col-md-4">
        <label>Fecha Llegada</label>
        <input type="date" name="fecha_entrada" class="form-control">
      </div>
      <div class="col-md-4">
        <label>Hora Llegada</label>
        <input type="time" name="hora_entrada" class="form-control">
      </div>
      <div class="col-md-4">
        <label>Número Vuelo (Llegada)</label>
        <input type="text" name="numero_vuelo_entrada" class="form-control">
      </div>
    </div>

    <!-- Datos de salida -->
    <h5>Datos de Salida (si aplica)</h5>
    <div class="row g-2 mb-3">
      <div class="col-md-4">
        <label>Fecha Salida</label>
        <input type="date" name="fecha_vuelo_salida" class="form-control">
      </div>
      <div class="col-md-4">
        <label>Hora Salida</label>
        <input type="time" name="hora_vuelo_salida" class="form-control">
      </div>
      <div class="col-md-4">
        <label>Hora Recogida</label>
        <input type="time" name="hora_recogida" class="form-control">
      </div>
    </div>

    <button class="btn btn-primary">Confirmar Reserva</button>
  </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
