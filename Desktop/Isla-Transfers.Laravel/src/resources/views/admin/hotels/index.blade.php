@extends('layouts.app')

@section('title', 'Listado de Hoteles')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Listado de Hoteles</h1>

        <a href="{{ route('admin.hotels.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
            Crear Nuevo Hotel
        </a>
    </div>
@endsection