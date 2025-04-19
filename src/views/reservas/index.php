<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container my-4">
  <?php if (!empty($_GET['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
  <?php elseif (!empty($_GET['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
  <?php endif; ?>

  <h2><?= (!empty($_SESSION['admin'])) ? 'Todas las Reservas' : 'Mis Reservas' ?></h2>
  <a href="index.php?controller=Reserva&action=create" class="btn btn-primary mb-3">
    Nueva Reserva
  </a>

  <?php if (empty($reservas)): ?>
    <div class="alert alert-info">No hay reservas para mostrar</div>
  <?php else: ?>
    <div class="row row-cols-1 row-cols-md-2 g-4">
      <?php foreach ($reservas as $reserva): ?>
        <div class="col">
          <div class="card h-100">
            <div class="card-header">
              <strong>Localizador: </strong><?= htmlspecialchars($reserva['localizador'] ?? '-') ?>
              <?php if ($reserva['creado_por_admin']): ?>
                <span class="badge bg-warning text-dark ms-2">Creado por Admin</span>
              <?php endif; ?>
            </div>
            <div class="card-body">
              <?php if (!empty($_SESSION['admin'])): ?>
                <p><strong>Usuario:</strong> <?= htmlspecialchars($reserva['email_cliente']) ?></p>
              <?php endif; ?>
              <p><strong>Tipo:</strong> <?= htmlspecialchars($reserva['tipo_reserva_nombre'] ?? 'Desconocido') ?></p>
              <p><strong>Hotel:</strong> <?= htmlspecialchars($reserva['hotel_nombre'] ?? 'N/A') ?></p>
              <p><strong>Vehículo:</strong> <?= htmlspecialchars($reserva['vehiculo_nombre'] ?? 'N/A') ?></p>
              <p><strong>Pasajeros:</strong> <?= htmlspecialchars($reserva['num_viajeros']) ?></p>
              <?php if (!empty($reserva['fecha_entrada'])): ?>
                <p><strong>Llegada:</strong> <?= htmlspecialchars($reserva['fecha_entrada']) ?> a las
                  <?= htmlspecialchars($reserva['hora_entrada']) ?>
                </p>
              <?php endif; ?>
              <?php if (!empty($reserva['fecha_vuelo_salida'])): ?>
                <p><strong>Salida:</strong> <?= htmlspecialchars($reserva['fecha_vuelo_salida']) ?> a las
                  <?= htmlspecialchars($reserva['hora_vuelo_salida']) ?>
                </p>
              <?php endif; ?>
            </div>
            <div class="card-footer">
              <small class="text-muted">Reservado: <?= htmlspecialchars($reserva['fecha_reserva']) ?></small>
              <div class="mt-2">
                <a class="btn btn-sm btn-outline-success"
                  href="index.php?controller=Reserva&action=detalle&id=<?= $reserva['id_reserva'] ?>">Ver</a>
                <?php
                // Si es admin o faltan más de 48h
                $canEdit = false;
                if (!empty($_SESSION['admin'])) {
                  $canEdit = true;
                } else {
                  // Comprobar si la reserva está a más de 48h
                  $fReserva = null;
                  if (!empty($reserva['fecha_entrada'])) {
                    $fReserva = strtotime($reserva['fecha_entrada'] . ' ' . $reserva['hora_entrada']);
                  } elseif (!empty($reserva['fecha_vuelo_salida'])) {
                    $fReserva = strtotime($reserva['fecha_vuelo_salida'] . ' ' . $reserva['hora_vuelo_salida']);
                  }
                  if ($fReserva && ($fReserva - time() > 48 * 3600)) {
                    $canEdit = true;
                  }
                }
                if ($canEdit): ?>
                  <a class="btn btn-sm btn-outline-primary"
                    href="index.php?controller=Reserva&action=edit&id=<?= $reserva['id_reserva'] ?>">Editar</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
