<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container my-4">
  <h2>Calendario de Reservas</h2>

  <!-- Esto es muy libre, depende de cómo quieras mostrarlo.
       Te dejo un ejemplo usando FullCalendar, igual que tenías: -->
  <div id="calendar"></div>
</div>

<!-- FullCalendar JS + CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: [
        <?php foreach ($reservas as $r): ?>
              <?php
              // Creamos un evento para la llegada
              if (!empty($r['fecha_entrada'])): ?>
                    {
              title: "Llegada - <?= addslashes($r['localizador']) ?>",
              start: "<?= $r['fecha_entrada'] . (!empty($r['hora_entrada']) ? 'T' . $r['hora_entrada'] : '') ?>"
            },
          <?php endif; ?>

              <?php if (!empty($r['fecha_vuelo_salida'])): ?>
                    {
              title: "Salida - <?= addslashes($r['localizador']) ?>",
              start: "<?= $r['fecha_vuelo_salida'] . (!empty($r['hora_vuelo_salida']) ? 'T' . $r['hora_vuelo_salida'] : '') ?>"
            },
          <?php endif; ?>
      <?php endforeach; ?>
      ],
    });
    calendar.render();
  });
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>
