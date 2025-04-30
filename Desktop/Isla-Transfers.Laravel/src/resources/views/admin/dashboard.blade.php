@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Panel de Administración</h1>

        <div class="space-y-4">
             <a href="{{ route('admin.reservations.calendar') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Calendario
            </a>
           <a href="{{ route('admin.reservations.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Gestión de Reservas
            </a>
           
        </div>
    </div>
@endsection