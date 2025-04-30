@extends('layouts.app')

@section('title', 'Editar Reserva')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Editar Reserva</h1>

        <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST" class="mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="tipo_reserva" class="block text-gray-700 font-bold mb-2">Tipo de Reserva</label>
                <select name="id_tipo_reserva" id="tipo_reserva" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach(\App\Models\TransferTipoReserva::all() as $tipoReserva)
                        <option value="{{ $tipoReserva->id_tipo_reserva }}" {{ old('id_tipo_reserva', $reservation->id_tipo_reserva) == $tipoReserva->id_tipo_reserva ? 'selected' : '' }}>
                            {{ $tipoReserva->Descripción }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="aeropuerto-hotel-fields" class="mb-4" style="display: none;">
                <label for="fecha_entrada" class="block text-gray-700 font-bold mb-2">Día de Llegada</label>
                <input type="date" name="fecha_entrada" id="fecha_entrada" value="{{ old('fecha_entrada', $reservation->fecha_entrada) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <label for="hora_entrada" class="block text-gray-700 font-bold mb-2">Hora de Llegada</label>
                <input type="time" name="hora_entrada" id="hora_entrada" value="{{ old('hora_entrada', $reservation->hora_entrada) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <label for="numero_vuelo_entrada" class="block text-gray-700 font-bold mb-2">Número de Vuelo</label>
                <input type="text" name="numero_vuelo_entrada" id="numero_vuelo_entrada" value="{{ old('numero_vuelo_entrada', $reservation->numero_vuelo_entrada) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <label for="origen_vuelo_entrada" class="block text-gray-700 font-bold mb-2">Aeropuerto de Origen</label>
                <input type="text" name="origen_vuelo_entrada" id="origen_vuelo_entrada" value="{{ old('origen_vuelo_entrada', $reservation->origen_vuelo_entrada) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div id="hotel-aeropuerto-fields" class="mb-4" style="display: none;">
                <label for="fecha_vuelo_salida" class="block text-gray-700 font-bold mb-2">Día del Vuelo</label>
                <input type="date" name="fecha_vuelo_salida" id="fecha_vuelo_salida" value="{{ old('fecha_vuelo_salida', $reservation->fecha_vuelo_salida) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <label for="hora_vuelo_salida" class="block text-gray-700 font-bold mb-2">Hora del Vuelo</label>
                <input type="time" name="hora_vuelo_salida" id="hora_vuelo_salida" value="{{ old('hora_vuelo_salida', $reservation->hora_vuelo_salida) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <label for="numero_vuelo_salida" class="block text-gray-700 font-bold mb-2">Número de Vuelo</label>
                <input type="text" name="numero_vuelo_salida" id="numero_vuelo_salida" value="" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <label for="hora_recogida" class="block text-gray-700 font-bold mb-2">Hora de Recogida</label>
                <input type="time" name="hora_recogida" id="hora_recogida" value="{{ old('hora_recogida', $reservation->hora_recogida) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="id_hotel" class="block text-gray-700 font-bold mb-2">Hotel de Recogida/Destino</label>
                <select name="id_hotel" id="id_hotel" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach(\App\Models\TransferHotel::all() as $hotel)
                        <option value="{{ $hotel->id_hotel }}" {{ old('id_hotel', $reservation->id_hotel) == $hotel->id_hotel ? 'selected' : '' }}>
                            {{ $hotel->Usuario }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="num_viajeros" class="block text-gray-700 font-bold mb-2">Número de Viajeros</label>
                <input type="number" name="num_viajeros" id="num_viajeros" value="{{ old('num_viajeros', $reservation->num_viajeros) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="email_cliente" class="block text-gray-700 font-bold mb-2">Email del Cliente</label>
                <input type="email" name="email_cliente" id="email_cliente" value="{{ old('email_cliente', $reservation->email_cliente) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Actualizar Reserva</button>
        </form>

        <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Borrar Reserva</button>
        </form>
    </div>
    <script>
        const tipoReservaSelect = document.getElementById('tipo_reserva');
        const aeropuertoHotelFields = document.getElementById('aeropuerto-hotel-fields');
        const hotelAeropuertoFields = document.getElementById('hotel-aeropuerto-fields');
        const numeroVueloSalida = document.getElementById('numero_vuelo_salida');
        numeroVueloSalida.value = document.getElementById('numero_vuelo_entrada').value;

        function showFields() {
            aeropuertoHotelFields.style.display = 'none';
            hotelAeropuertoFields.style.display = 'none';
            if (tipoReservaSelect.value == 1){
                aeropuertoHotelFields.style.display = 'block';
            }
            if (tipoReservaSelect.value == 2){
                hotelAeropuertoFields.style.display = 'block';
            }
            if(tipoReservaSelect.value == 3){
                aeropuertoHotelFields.style.display = 'block';
                hotelAeropuertoFields.style.display = 'block';
            }
        }

        tipoReservaSelect.addEventListener('change', showFields);
        showFields();
    </script>
@endsection