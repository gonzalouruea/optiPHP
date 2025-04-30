@extends('layouts.app')

@section('title', 'Editar Vehículo')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Editar Vehículo</h1>

        <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST" class="max-w-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700">Descripción</label>
                <input type="text" name="Descripción" id="descripcion" class="w-full border border-gray-300 px-4 py-2 rounded" value="{{ old('Descripción', $vehicle->Descripción) }}" required>
                @error('Descripción')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email_conductor" class="block text-gray-700">Email Conductor</label>
                <input type="email" name="email_conductor" id="email_conductor" class="w-full border border-gray-300 px-4 py-2 rounded" value="{{ old('email_conductor', $vehicle->email_conductor) }}" required>
                @error('email_conductor')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="w-full border border-gray-300 px-4 py-2 rounded" >
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Actualizar Vehículo
                </button>
                <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Borrar Vehículo
                    </button>
                </form>
            </div>
        </form>
    </div>
@endsection