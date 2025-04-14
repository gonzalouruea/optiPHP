<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container my-5">
    <!-- Título -->
    <div class="text-center py-2">
        <h2>¡Realiza una resreva y a DISFRUTAR!</h2>
    </div>
    <br>

    <!-- Formulario centrado en el contenedor -->
    <div class="container mt-5">
    <form method="POST" action="procesar_reserva.php">
        <div class="mb-3">
            <label for="tipo_reserva" class="form-label">Tipo de reserva</label>
            <select id="tipo_reserva" name="tipo_reserva" class="form-select" onchange="mostrarCampos(this.value)">
                <option value="aeropuerto-hotel">Aeropuerto a Hotel</option>
                <option value="hotel-aeropuerto">Hotel a Aeropuerto</option>
                <option value="ida-vuelta">Ida y vuelta</option>
            </select>
        </div>

        <div id="aeropuerto-hotel" style="display:none;">
            <h5 class="mt-4">Datos para el trayecto: Aeropuerto a Hotel</h5>
            <div class="mb-3">
                <label for="dia_llegada" class="form-label">Día de llegada</label>
                <input type="date" name="dia_llegada" id="dia_llegada" class="form-control">
            </div>
            <div class="mb-3">
                <label for="hora_llegada" class="form-label">Hora de llegada</label>
                <input type="time" name="hora_llegada" id="hora_llegada" class="form-control">
            </div>
            <div class="mb-3">
                <label for="numero_vuelo_llegada" class="form-label">Número de vuelo</label>
                <input type="text" name="numero_vuelo_llegada" id="numero_vuelo_llegada" class="form-control">
            </div>
            <div class="mb-3">
                <label for="aeropuerto_origen" class="form-label">Aeropuerto de origen</label>
                <input type="text" name="aeropuerto_origen" id="aeropuerto_origen" class="form-control">
            </div>
        </div>

        <div id="hotel-aeropuerto" style="display:none;">
            <h5 class="mt-4">Datos para el trayecto: Hotel a Aeropuerto</h5>
            <div class="mb-3">
                <label for="dia_vuelo" class="form-label">Día del vuelo</label>
                <input type="date" name="dia_vuelo" id="dia_vuelo" class="form-control">
            </div>
            <div class="mb-3">
                <label for="hora_vuelo" class="form-label">Hora del vuelo</label>
                <input type="time" name="hora_vuelo" id="hora_vuelo" class="form-control">
            </div>
            <div class="mb-3">
                <label for="numero_vuelo_salida" class="form-label">Número de vuelo</label>
                <input type="text" name="numero_vuelo_salida" id="numero_vuelo_salida" class="form-control">
            </div>
            <div class="mb-3">
                <label for="hora_recogida" class="form-label">Hora de recogida</label>
                <input type="time" name="hora_recogida" id="hora_recogida" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <h5 class="mt-4">Información general</h5>
            <label for="hotel" class="form-label">Hotel de destino o recogida</label>
            <input type="text" name="hotel" id="hotel" class="form-control">
        </div>
        <div class="mb-3">
            <label for="numero_viajeros" class="form-label">Número de viajeros</label>
            <input type="number" name="numero_viajeros" id="numero_viajeros" class="form-control" min="1">
        </div>
        <div class="mb-3">
            <label for="datos_personales" class="form-label">Datos personales</label>
            <input type="text" name="nombre" id="datos_personales" placeholder="Nombre completo" class="form-control">
            <input type="email" name="email" id="email" placeholder="Correo electrónico" class="form-control mt-2">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Reservar</button>
    </form>
</div>

<!-- Archivos JavaScript de Bootstrap (incluye Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    function mostrarCampos(tipo) {
        document.getElementById('aeropuerto-hotel').style.display = (tipo === 'aeropuerto-hotel' || tipo === 'ida-vuelta') ? 'block' : 'none';
        document.getElementById('hotel-aeropuerto').style.display = (tipo === 'hotel-aeropuerto' || tipo === 'ida-vuelta') ? 'block' : 'none';
    }
</script>

</body>
</html>
