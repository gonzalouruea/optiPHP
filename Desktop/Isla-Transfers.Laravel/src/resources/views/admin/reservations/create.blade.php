@extends('layouts.app')

@section('title', 'Crear Reserva')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Crear Reserva</h1>

        <form action="{{ route('admin.reservations.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="tipo_reserva" class="block mb-2">Tipo de Reserva</label>
                <select name="id_tipo_reserva" id="tipo_reserva" class="w-full border border-gray-300 px-3 py-2 rounded" onchange="toggleFields()">
                    <option value="1">Aeropuerto->Hotel</option>
                    <option value="2">Hotel->Aeropuerto</option>
                    <option value="3">Ida y Vuelta</option>
                </select>
            </div>

            <div id="aeropuerto_hotel_fields" class="mb-4">
                <div class="mb-2">
                    <label for="fecha_entrada" class="block mb-2">Día de Llegada</label>
                    <input type="date" name="fecha_entrada" id="fecha_entrada" class="w-full border border-gray-300 px-3 py-2 rounded">
                </div>
                <div class="mb-2">
                    <label for="hora_entrada" class="block mb-2">Hora de Llegada</label>
                    <input type="time" name="hora_entrada" id="hora_entrada" class="w-full border border-gray-300 px-3 py-2 rounded">
                </div>
                <div class="mb-2">
                    <label for="numero_vuelo_entrada" class="block mb-2">Número de Vuelo</label>
                    <input type="text" name="numero_vuelo_entrada" id="numero_vuelo_entrada" class="w-full border border-gray-300 px-3 py-2 rounded">
                </div>
                <div class="mb-2">
                    <label for="origen_vuelo_entrada" class="block mb-2">Aeropuerto de Origen</label>
                    <input type="text" name="origen_vuelo_entrada" id="origen_vuelo_entrada" class="w-full border border-gray-300 px-3 py-2 rounded">
                </div>
            </div>

            <div id="hotel_aeropuerto_fields" class="mb-4" style="display: none;">
                 <div class="mb-2">
                    <label for="fecha_vuelo_salida" class="block mb-2">Día del Vuelo</label>
                    <input type="date" name="fecha_vuelo_salida" id="fecha_vuelo_salida" class="w-full border border-gray-300 px-3 py-2 rounded">
                </div>
                <div class="mb-2">
                    <label for="hora_vuelo_salida" class="block mb-2">Hora del Vuelo</label>
                    <input type="time" name="hora_vuelo_salida" id="hora_vuelo_salida" class="w-full border border-gray-300 px-3 py-2 rounded">
                </div>
                 <div class="mb-2">
                    <label for="numero_vuelo_salida" class="block mb-2">Número de Vuelo</label>
                    <input type="text" name="numero_vuelo_salida" id="numero_vuelo_salida" class="w-full border border-gray-300 px-3 py-2 rounded">
                </div>
                <div class="mb-2">
                    <label for="hora_recogida" class="block mb-2">Hora de Recogida</label>
                    <input type="time" name="hora_recogida" id="hora_recogida" class="w-full border border-gray-300 px-3 py-2 rounded">
                </div>
            </div>
             <div class="mb-4">
                <label for="id_hotel" class="block mb-2">Hotel de Recogida/Destino</label>
                <input type="text" name="id_hotel" id="id_hotel" class="w-full border border-gray-300 px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label for="num_viajeros" class="block mb-2">Número de Viajeros</label>
                <input type="number" name="num_viajeros" id="num_viajeros" class="w-full border border-gray-300 px-3 py-2 rounded">
            </div>

             <div class="mb-4">
                <label for="email_cliente" class="block mb-2">Email del Cliente</label>
                <input type="email" name="email_cliente" id="email_cliente" class="w-full border border-gray-300 px-3 py-2 rounded">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Reserva</button>
        </form>
    </div>

    <script>
        function toggleFields() {
            var tipoReserva = document.getElementById('tipo_reserva').value;
            var aeropuertoHotelFields = document.getElementById('aeropuerto_hotel_fields');
            var hotelAeropuertoFields = document.getElementById('hotel_aeropuerto_fields');

            aeropuertoHotelFields.style.display = 'none';
            hotelAeropuertoFields.style.display = 'none';

            if (tipoReserva == 1) {
                aeropuertoHotelFields.style.display = 'block';
            } else if (tipoReserva == 2) {
                hotelAeropuertoFields.style.display = 'block';
            } else if (tipoReserva == 3) {
                aeropuertoHotelFields.style.display = 'block';
                hotelAeropuertoFields.style.display = 'block';
            }
        }
        toggleFields();
    </script>
@endsection