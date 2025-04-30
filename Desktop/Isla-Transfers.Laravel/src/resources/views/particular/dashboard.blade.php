@extends('layouts.app')

@section('title', 'Panel de Usuario Particular')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-6">Panel de Usuario Particular</h1>
        
        <div class="flex justify-center space-x-4">
            <a href="{{ route('particular.reservations.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Ver Mis Reservas
            </a>
            <a href="{{ route('particular.reservations.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Crear Nueva Reserva
            </a>
        </div>
    </div>
@endsection