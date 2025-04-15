<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container my-4">
  <?php if (!$reserva): ?>
    <div class="alert alert-warning">No se encontró la reserva</div>
  <?php else: ?>
    <div class="card">
      <div class="card-header">
        <h4>Detalle de Reserva</h4>
      </div>
      <div class="card-body">
        <dl class="row">
          <dt class="col-sm-3">Localizador:</dt>
          <dd class="col-sm-9"><?= htmlspecialchars($reserva['localizador'] ?? '-') ?></dd>

          <dt class="col-sm-3">Fecha/Hora Llegada:</dt>
          <dd class="col-sm-9">
            <?php if (!empty($reserva['fecha_entrada'])): ?>
              <?= htmlspecialchars($reserva['fecha_entrada']) ?> a las <?= htmlspecialchars($reserva['hora_entrada']) ?>
            <?php else: ?>
              -
            <?php endif; ?>
          </dd>

          <dt class="col-sm-3">Fecha/Hora Salida:</dt>
          <dd class="col-sm-9">
            <?php if (!empty($reserva['fecha_vuelo_salida'])): ?>
              <?= htmlspecialchars($reserva['fecha_vuelo_salida']) ?> a las
              <?= htmlspecialchars($reserva['hora_vuelo_salida']) ?>
            <?php else: ?>
              -
            <?php endif; ?>
          </dd>

          <dt class="col-sm-3">Hotel:</dt>
          <dd class="col-sm-9"><?= htmlspecialchars($reserva['hotel'] ?? 'N/A') ?></dd>

          <dt class="col-sm-3">Vehículo:</dt>
          <dd class="col-sm-9"><?= htmlspecialchars($reserva['vehiculo'] ?? 'N/A') ?></dd>

          <dt class="col-sm-3">Pasajeros:</dt>
          <dd class="col-sm-9"><?= htmlspecialchars($reserva['num_viajeros']) ?></dd>
        </dl>
        <a href="index.php?controller=Reserva&action=index" class="btn btn-primary">Volver</a>
      </div>
    </div>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
