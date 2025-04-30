@extends('layouts.app')

@section('title', 'Listado de Vehículos')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Listado de Vehículos</h1>

        <div class="mb-4">
            <a href="{{ route('admin.vehicles.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Crear Nuevo Vehículo
            </a>
        </div>

        <!-- Aquí irá el listado de vehículos -->
    </div>
@endsection