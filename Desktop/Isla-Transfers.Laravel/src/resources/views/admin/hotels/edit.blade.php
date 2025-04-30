@extends('layouts.app')

@section('title', 'Editar Hotel')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Editar Hotel</h1>

        <form action="{{ route('admin.hotels.update', $hotel) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="id_zona" class="block text-gray-700 text-sm font-bold mb-2">Zona</label>
                <select name="id_zona" id="id_zona" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($zonas as $zona)
                        <option value="{{ $zona->id_zona }}" {{ $hotel->id_zona == $zona->id_zona ? 'selected' : '' }}>{{ $zona->descripcion }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="Comision" class="block text-gray-700 text-sm font-bold mb-2">Comisión</label>
                <input type="number" name="Comision" id="Comision" value="{{ $hotel->Comision }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="Usuario" class="block text-gray-700 text-sm font-bold mb-2">Usuario</label>
                <input type="text" name="Usuario" id="Usuario" value="{{ $hotel->Usuario }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña</label>
                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Guardar
                </button>

                <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Borrar
                    </button>
                </form>
            </div>
        </form>
    </div>
@endsection