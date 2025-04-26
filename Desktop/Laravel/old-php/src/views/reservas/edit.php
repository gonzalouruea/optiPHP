<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container my-4">
  <h2>Nueva Reserva</h2>

  <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form action="index.php?controller=Reserva&action=store" method="POST">
    <?php if (!empty($_SESSION['admin']) && !empty($usuarios)): ?>
          <!-- Seleccionar usuario -->
          <div class="mb-3">
            <label class="form-label">Usuario</label>
            <select class="form-select" name="id_viajero">
              <option value="">Seleccionar usuario...</option>
              <?php foreach ($usuarios as $u): ?>
                    <option value="<?= $u['id_viajero'] ?>" <?= isset($fReserva['id_viajero']) && $fReserva['id_viajero'] == $u['id_viajero'] ? 'selected' : '' ?>>
                      <?= htmlspecialchars($u['email']) ?>
                    </option>
              <?php endforeach; ?>
            </select>
          </div>
    <?php endif; ?>

    <!-- Tipo Trayecto -->
    <div class="mb-3">
      <label class="form-label">Tipo de Trayecto</label>
      <select class="form-select" name="tipo_trayecto" id="tipoTrayecto" required>
        <option value="">Elige tipo...</option>
        <option value="1" <?= isset($fReserva['id_tipo_reserva']) && $fReserva['id_tipo_reserva'] == 1 ? 'selected' : '' ?>>Aeropuerto → Hotel</option>
        <option value="2" <?= isset($fReserva['id_tipo_reserva']) && $fReserva['id_tipo_reserva'] == 2 ? 'selected' : '' ?>>Hotel → Aeropuerto</option>
        <option value="3" <?= isset($fReserva['id_tipo_reserva']) && $fReserva['id_tipo_reserva'] == 3 ? 'selected' : '' ?>>Ida y Vuelta</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Número de Pasajeros</label>
      <input type="number" name="num_viajeros" class="form-control" required min="1" value="<?= htmlspecialchars($fReserva['num_viajeros'] ?? '') ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Vehículo</label>
      <select name="id_vehiculo" class="form-select" required>
        <?php foreach ($vehiculos as $veh): ?>
              <option value="<?= $veh['id_vehiculo'] ?>" <?= isset($fReserva['id_vehiculo']) && $fReserva['id_vehiculo'] == $veh['id_vehiculo'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($veh['Descripción']) ?>
              </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Hotel (destino/recogida)</label>
      <select name="id_hotel" class="form-select" required>
        <?php foreach ($hoteles as $h): ?>
              <option value="<?= $h['id_hotel'] ?>" <?= isset($fReserva['id_hotel']) && $fReserva['id_hotel'] == $h['id_hotel'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($h['descripcion'] ?? "Hotel #{$h['id_hotel']}") ?>
              </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Llegada -->
    <div id="camposLlegada" style="display:none;">
      <h5>Datos de Llegada</h5>
      <div class="row g-2 mb-3">
        <div class="col-md-6">
          <label>Fecha Llegada</label>
          <input type="date" name="fecha_entrada" class="form-control" value="<?= htmlspecialchars($fReserva['fecha_entrada'] ?? '') ?>">
        </div>
        <div class="col-md-6">
          <label>Hora Llegada</label>
          <input type="time" name="hora_entrada" class="form-control" value="<?= htmlspecialchars($fReserva['hora_entrada'] ?? '') ?>">
        </div>
        <div class="col-md-6">
          <label>Número Vuelo (Llegada)</label>
          <input type="text" name="numero_vuelo_entrada" class="form-control" value="<?= htmlspecialchars($fReserva['numero_vuelo_entrada'] ?? '') ?>">
        </div>
        <div class="col-md-6">
          <label>Aeropuerto de Origen</label>
          <input type="text" name="origen_vuelo_entrada" class="form-control" value="<?= htmlspecialchars($fReserva['origen_vuelo_entrada'] ?? '') ?>">
        </div>
      </div>
    </div>

    <!-- Salida -->
    <div id="camposSalida" style="display:none;">
      <h5>Datos de Salida</h5>
      <div class="row g-2 mb-3">
        <div class="col-md-6">
          <label>Fecha Vuelo Salida</label>
          <input type="date" name="fecha_vuelo_salida" class="form-control" value="<?= htmlspecialchars($fReserva['fecha_vuelo_salida'] ?? '') ?>">
        </div>
        <div class="col-md-6">
          <label>Hora Vuelo Salida</label>
          <input type="time" name="hora_vuelo_salida" class="form-control" value="<?= htmlspecialchars($fReserva['hora_vuelo_salida'] ?? '') ?>">
        </div>
        <div class="col-md-6">
          <label>Número Vuelo (Salida)</label>
          <input type="text" name="numero_vuelo_salida" class="form-control" value="<?= htmlspecialchars($fReserva['numero_vuelo_salida'] ?? '') ?>">
        </div>
        <div class="col-md-6">
          <label>Hora de Recogida</label>
          <input type="time" name="hora_recogida" class="form-control" value="<?= htmlspecialchars($fReserva['hora_recogida'] ?? '') ?>">
        </div>
      </div>
    </div>

    <button class="btn btn-primary">Confirmar Reserva</button>
    <form action="index.php?controller=Reserva&action=delete" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro de cancelar?')">
      <input type="hidden" name="id_reserva" value="<?= $reserva['id_reserva'] ?>">
      <button class="btn btn-danger">Cancelar</button>
    </form>
    
  </form>
</div>

<script>
  const tipoSelect = document.getElementById('tipoTrayecto');
  const camposLlegada = document.getElementById('camposLlegada');
  const camposSalida = document.getElementById('camposSalida');

  tipoSelect.addEventListener('change', () => {
    const tipo = tipoSelect.value;
    // Si 1 o 3 => mostrar Llegada
    camposLlegada.style.display = (tipo === '1' || tipo === '3') ? 'block' : 'none';
    // Si 2 o 3 => mostrar Salida
    camposSalida.style.display = (tipo === '2' || tipo === '3') ? 'block' : 'none';
  });

  // Trigger change event on page load to set initial visibility
  tipoSelect.dispatchEvent(new Event('change'));
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>
