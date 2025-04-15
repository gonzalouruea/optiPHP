<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container my-4">
  <h2>Panel de Administración</h2>
  <div class="row g-3 mt-3">
    <div class="col-md-4">
      <div class="card bg-light">
        <div class="card-body">
          <h5>Reservas Totales</h5>
          <p class="display-6"><?= $stats['reservas_totales'] ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-light">
        <div class="card-body">
          <h5>Reservas Hoy</h5>
          <p class="display-6"><?= $stats['reservas_hoy'] ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-light">
        <div class="card-body">
          <h5>Usuarios Normales</h5>
          <p class="display-6"><?= $stats['usuarios'] ?></p>
        </div>
      </div>
    </div>
  </div>

  <hr>
  <h4>Gestión Rápida</h4>
  <div class="row g-3">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body text-center">
          <h5 class="card-title">Reservas</h5>
          <p class="card-text">Administra todas las reservas del sistema</p>
          <a href="index.php?controller=Reserva&action=index" class="btn btn-primary">Ver Reservas</a>
          <a href="index.php?controller=Reserva&action=calendario" class="btn btn-outline-primary">Calendario</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body text-center">
          <h5 class="card-title">Vehículos</h5>
          <p class="card-text">Gestiona la flota</p>
          <a href="index.php?controller=Admin&action=gestionarVehiculos" class="btn btn-success">Gestionar</a>
          <p class="mt-2"><?= $stats['vehiculos'] ?> vehículos en total</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body text-center">
          <h5 class="card-title">Hoteles</h5>
          <p class="card-text">Gestiona los hoteles</p>
          <a href="index.php?controller=Admin&action=gestionarHoteles" class="btn btn-info text-white">Gestionar</a>
          <p class="mt-2"><?= $stats['hoteles'] ?> hoteles registrados</p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
