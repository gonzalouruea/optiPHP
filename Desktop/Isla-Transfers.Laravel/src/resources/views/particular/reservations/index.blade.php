@extends('layouts.app')

@section('title', 'Mis Reservas')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Mis Reservas</h1>

        <a href="{{ route('particular.reservations.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
            Crear Nueva Reserva
        </a>

        </div>
@endsection