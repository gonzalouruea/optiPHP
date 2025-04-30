@extends('layouts.app')

@section('title', 'Visualizar Hotel')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Visualizar Hotel</h1>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="id_zona">
                    Zona:
                </label>
                <p class="text-gray-700">{{ $hotel->zona->descripcion }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="comision">
                    Comisión:
                </label>
                <p class="text-gray-700">{{ $hotel->Comision }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="usuario">
                    Usuario:
                </label>
                <p class="text-gray-700">{{ $hotel->Usuario }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Contraseña:
                </label>
                <p class="text-gray-700">********</p>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('admin.hotels.edit', $hotel) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Editar
                </a>
                <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST">
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