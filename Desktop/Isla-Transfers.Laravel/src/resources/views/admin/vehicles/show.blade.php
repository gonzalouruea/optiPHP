@extends('layouts.app')

@section('title', 'Visualizar Vehículo')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Visualizar Vehículo</h1>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="descripcion">
                    Descripción:
                </label>
                <p class="text-gray-700">{{ $vehicle->Descripción }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email_conductor">
                    Email Conductor:
                </label>
                <p class="text-gray-700">{{ $vehicle->email_conductor }}</p>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Contraseña:
                </label>
                <p class="text-gray-700">{{ $vehicle->password }}</p>
            </div>
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Editar
                </a>
                <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Borrar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection