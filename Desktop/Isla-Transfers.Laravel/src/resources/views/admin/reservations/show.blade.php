@extends('layouts.app')

@section('title', 'Visualizar Reserva')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Visualizar Reserva</h1>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <p class="block text-gray-700 text-sm font-bold mb-2">
                    <strong>Localizador:</strong> {{ $reservation->localizador }}
                </p>
            </div>

            <div class="mb-4">
                <p class="block text-gray-700 text-sm font-bold mb-2">
                    <strong>Tipo de Reserva:</strong> {{ $reservation->tipoReserva->Descripción }}
                </p>
            </div>
            <div class="mb-4">
                <p class="block text-gray-700 text-sm font-bold mb-2">
                    <strong>Email Cliente:</strong> {{ $reservation->email_cliente }}
                </p>
            </div>

            <div class="mb-4">
                <p class="block text-gray-700 text-sm font-bold mb-2">
                    <strong>Fecha de Reserva:</strong> {{ $reservation->fecha_reserva }}
                </p>
            </div>

            <div class="mb-4">
                <p class="block text-gray-700 text-sm font-bold mb-2">
                    <strong>Fecha de Modificación:</strong> {{ $reservation->fecha_modificacion }}
                </p>
            </div>
            @if ($reservation->fecha_entrada)
                <div class="mb-4">
                    <p class="block text-gray-700 text-sm font-bold mb-2">
                        <strong>Fecha de Entrada:</strong> {{ $reservation->fecha_entrada }}
                    </p>
                </div>
            @endif
            @if ($reservation->hora_entrada)
                <div class="mb-4">
                    <p class="block text-gray-700 text-sm font-bold mb-2">
                        <strong>Hora de Entrada:</strong> {{ $reservation->hora_entrada }}
                    </p>
                </div>
            @endif
            @if ($reservation->numero_vuelo_entrada)
                <div class="mb-4">
                    <p class="block text-gray-700 text-sm font-bold mb-2">
                        <strong>Número de Vuelo Entrada:</strong> {{ $reservation->numero_vuelo_entrada }}
                    </p>
                </div>
            @endif
            @if ($reservation->origen_vuelo_entrada)
                <div class="mb-4">
                    <p class="block text-gray-700 text-sm font-bold mb-2">
                        <strong>Origen de Vuelo Entrada:</strong> {{ $reservation->origen_vuelo_entrada }}
                    </p>
                </div>
            @endif
            @if ($reservation->hora_vuelo_salida)
                <div class="mb-4">
                    <p class="block text-gray-700 text-sm font-bold mb-2">
                        <strong>Hora de Vuelo Salida:</strong> {{ $reservation->hora_vuelo_salida }}
                    </p>
                </div>
            @endif
            @if ($reservation->fecha_vuelo_salida)
                <div class="mb-4">
                    <p class="block text-gray-700 text-sm font-bold mb-2">
                        <strong>Fecha de Vuelo Salida:</strong> {{ $reservation->fecha_vuelo_salida }}
                    </p>
                </div>
            @endif
            <div class="mb-4">
                <p class="block text-gray-700 text-sm font-bold mb-2">
                    <strong>Número de Viajeros:</strong> {{ $reservation->num_viajeros }}
                </p>
            </div>
            <div class="mb-4">
                <p class="block text-gray-700 text-sm font-bold mb-2">
                    <strong>Hotel:</strong> {{ $reservation->hotel->Usuario }}
                </p>
            </div>
            <div class="mb-4">
                <p class="block text-gray-700 text-sm font-bold mb-2">
                    <strong>Vehiculo:</strong> {{ $reservation->vehiculo->Descripción }}
                </p>
            </div>
            @if ($reservation->hora_recogida)
                <div class="mb-4">
                    <p class="block text-gray-700 text-sm font-bold mb-2">
                        <strong>Hora de Recogida:</strong> {{ $reservation->hora_recogida }}
                    </p>
                </div>
            @endif
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.reservations.edit', $reservation) }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Editar
                </a>
                <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Borrar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection