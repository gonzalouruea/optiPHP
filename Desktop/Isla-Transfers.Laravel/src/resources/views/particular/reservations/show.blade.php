@extends('layouts.app')

@section('title', 'Visualizar Reserva')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Visualizar Reserva</h1>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="localizador">
                    Localizador
                </label>
                <p class="text-gray-700">{{ $reservation->localizador }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="tipo_reserva">
                    Tipo de Reserva
                </label>
                <p class="text-gray-700">{{ $reservation->tipoReserva->Descripción }}</p>
            </div>

            @if($reservation->tipo_reserva == 1 || $reservation->tipo_reserva == 3)
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fecha_entrada">
                        Día de llegada
                    </label>
                    <p class="text-gray-700">{{ $reservation->fecha_entrada }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="hora_entrada">
                        Hora de llegada
                    </label>
                    <p class="text-gray-700">{{ $reservation->hora_entrada }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="numero_vuelo_entrada">
                        Número de vuelo de llegada
                    </label>
                    <p class="text-gray-700">{{ $reservation->numero_vuelo_entrada }}</p>
                </div>
                
                 <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="origen_vuelo_entrada">
                        Origen vuelo de llegada
                    </label>
                    <p class="text-gray-700">{{ $reservation->origen_vuelo_entrada }}</p>
                </div>
            @endif

            @if($reservation->tipo_reserva == 2 || $reservation->tipo_reserva == 3)
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fecha_vuelo_salida">
                        Día de salida
                    </label>
                    <p class="text-gray-700">{{ $reservation->fecha_vuelo_salida }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="hora_vuelo_salida">
                        Hora de vuelo de salida
                    </label>
                    <p class="text-gray-700">{{ $reservation->hora_vuelo_salida }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="hora_recogida">
                        Hora de recogida
                    </label>
                    <p class="text-gray-700">{{ $reservation->hora_recogida }}</p>
                </div>
            @endif
             <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="id_hotel">
                        Hotel
                    </label>
                    <p class="text-gray-700">{{ $reservation->hotel->Usuario }}</p>
             </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="num_viajeros">
                    Número de viajeros
                </label>
                <p class="text-gray-700">{{ $reservation->num_viajeros }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email_cliente">
                    Email del cliente
                </label>
                <p class="text-gray-700">{{ $reservation->email_cliente }}</p>
            </div>
            
             <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="id_vehiculo">
                        Vehiculo
                    </label>
                    <p class="text-gray-700">{{ $reservation->vehiculo->Descripción }}</p>
             </div>

            <div class="flex items-center justify-between">
                 
            </div>
        </div>
    </div>
@endsection