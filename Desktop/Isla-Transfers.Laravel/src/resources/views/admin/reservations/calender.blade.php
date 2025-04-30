@extends('layouts.app')

@section('title', 'Calendario de Reservas')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-center my-8">Calendario de Reservas</h1>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div id='calendar'>
                <!-- Aquí se mostrará el calendario -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

        });
    </script>
@endsection