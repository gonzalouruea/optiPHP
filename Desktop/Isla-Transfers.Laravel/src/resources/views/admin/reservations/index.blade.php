@extends('layouts.app')

@section('title', 'Listado de Reservas')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-6">Listado de Reservas</h1>
        <div class="mb-4 text-right">
            <a href="{{ route('admin.reservations.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Crear Nueva Reserva
            </a>
        </div>
        </div>
@endsection