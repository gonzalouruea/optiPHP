<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container my-4">
  <h2>Calendario de Reservas</h2>


  <div id="calendario"></div>
</div>

<!-- Incluir FullCalendar CSS y JS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendario');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    // Definir la vista inicial según $_GET['vista']
    // dayGridMonth, timeGridWeek, timeGridDay
    initialView: '<?php
    $vistaFC = $_GET['vista'] ?? 'month';
    switch ($vistaFC) {
      case 'day':
        echo 'timeGridDay';
        break;
      case 'week':
        echo 'timeGridWeek';
        break;
      default:
        echo 'dayGridMonth';
        break;
    }
    ?>',

    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },

    // events: en FullCalendar es un array de objetos
    events: [
      <?php foreach ($reservas as $res): ?>
                {
                  // Asigna un ID para poder usar eventClick
                  id: '<?= $res['id_reserva'] ?>',

                  // Muestra algo en el título (ej: localizador)
                  title: '<?= addslashes($res['localizador'] ?? "Reserva #{$res['id_reserva']}") ?>',

                  // Determina la fecha/hora "start"
                  // p.ej. si es "llegada"
                  <?php if (!empty($res['fecha_entrada'])): ?>
                            start: '<?= $res['fecha_entrada'] . (!empty($res['hora_entrada']) ? 'T' . $res['hora_entrada'] : '') ?>',
                  <?php else: ?>
                            // fallback?
                  <?php endif; ?>

                  // Si quieres que "end" sea la fecha/hora de salida
                  <?php if (!empty($res['fecha_vuelo_salida'])): ?>
                            end: '<?= $res['fecha_vuelo_salida'] . (!empty($res['hora_vuelo_salida']) ? 'T' . $res['hora_vuelo_salida'] : '') ?>',
                  <?php endif; ?>

                  // color o backgroundColor, etc. si deseas
                },
      <?php endforeach; ?>
    ],

    eventClick: function(info) {
      // Redirigir al detalle, usando el "id" del event
      var reservaId = info.event.id;
      window.location.href = 'index.php?controller=Reserva&action=detalle&id=' + reservaId;
    },
  });

  calendar.render();
});
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>
