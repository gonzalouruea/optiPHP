@extends('layouts.app')

@section('title', 'Crear Reserva')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Crear Reserva</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('particular.reservations.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label for="id_tipo_reserva" class="block text-gray-700 text-sm font-bold mb-2">Tipo de Reserva:</label>
                <select name="id_tipo_reserva" id="id_tipo_reserva" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="1">Aeropuerto->Hotel</option>
                    <option value="2">Hotel->Aeropuerto</option>
                    <option value="3">Ida y Vuelta</option>
                </select>
            </div>

            <div id="aeropuerto_hotel_fields" class="hidden">
                <div class="mb-4">
                    <label for="fecha_entrada" class="block text-gray-700 text-sm font-bold mb-2">Día de llegada:</label>
                    <input type="date" name="fecha_entrada" id="fecha_entrada" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="hora_entrada" class="block text-gray-700 text-sm font-bold mb-2">Hora de llegada:</label>
                    <input type="time" name="hora_entrada" id="hora_entrada" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="numero_vuelo_entrada" class="block text-gray-700 text-sm font-bold mb-2">Número de vuelo:</label>
                    <input type="text" name="numero_vuelo_entrada" id="numero_vuelo_entrada" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="origen_vuelo_entrada" class="block text-gray-700 text-sm font-bold mb-2">Aeropuerto de origen:</label>
                    <input type="text" name="origen_vuelo_entrada" id="origen_vuelo_entrada" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>

            <div id="hotel_aeropuerto_fields" class="hidden">
                <div class="mb-4">
                    <label for="fecha_vuelo_salida" class="block text-gray-700 text-sm font-bold mb-2">Día del vuelo:</label>
                    <input type="date" name="fecha_vuelo_salida" id="fecha_vuelo_salida" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="hora_vuelo_salida" class="block text-gray-700 text-sm font-bold mb-2">Hora del vuelo:</label>
                    <input type="time" name="hora_vuelo_salida" id="hora_vuelo_salida" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="numero_vuelo_salida" class="block text-gray-700 text-sm font-bold mb-2">Número de vuelo:</label>
                    <input type="text" name="numero_vuelo_salida" id="numero_vuelo_salida" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="hora_recogida" class="block text-gray-700 text-sm font-bold mb-2">Hora de recogida:</label>
                    <input type="time" name="hora_recogida" id="hora_recogida" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>

            <div class="mb-4">
                <label for="id_hotel" class="block text-gray-700 text-sm font-bold mb-2">Hotel de recogida/destino:</label>
                <input type="text" name="id_hotel" id="id_hotel" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="num_viajeros" class="block text-gray-700 text-sm font-bold mb-2">Número de viajeros:</label>
                <input type="number" name="num_viajeros" id="num_viajeros" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="email_cliente" class="block text-gray-700 text-sm font-bold mb-2">Email del cliente:</label>
                <input type="email" name="email_cliente" id="email_cliente" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Crear Reserva
                </button>
            </div>
        </form>
    </div>

    <script>
        const tipoReservaSelect = document.getElementById('id_tipo_reserva');
        const aeropuertoHotelFields = document.getElementById('aeropuerto_hotel_fields');
        const hotelAeropuertoFields = document.getElementById('hotel_aeropuerto_fields');

        tipoReservaSelect.addEventListener('change', () => {
            aeropuertoHotelFields.classList.add('hidden');
            hotelAeropuertoFields.classList.add('hidden');

            if (tipoReservaSelect.value === '1') {
                aeropuertoHotelFields.classList.remove('hidden');
            } else if (tipoReservaSelect.value === '2') {
                hotelAeropuertoFields.classList.remove('hidden');
            } else if (tipoReservaSelect.value === '3') {
                aeropuertoHotelFields.classList.remove('hidden');
                hotelAeropuertoFields.classList.remove('hidden');
            }
        });
    </script>
@endsection