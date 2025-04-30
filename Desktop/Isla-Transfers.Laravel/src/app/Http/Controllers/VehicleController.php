<?php

namespace App\Http\Controllers;

use App\Models\TransferVehiculo;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Muestra una lista de todos los vehículos.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $vehiculos = TransferVehiculo::all();
        return view('admin.vehicles.index', compact('vehiculos'));
    }

    /**
     * Muestra el formulario para crear un nuevo vehículo.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.vehicles.create');
    }

    /**
     * Almacena un nuevo vehículo en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'capacidad' => 'required|integer|min:1',
        ]);

        TransferVehiculo::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'capacidad' => $request->capacidad,
        ]);

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehículo creado correctamente');
    }

    /**
     * Muestra la información de un vehículo específico.
     *
     * @param  \App\Models\TransferVehiculo  $vehicle
     * @return \Illuminate\View\View
     */
    public function show(TransferVehiculo $vehicle)
    {
        return view('admin.vehicles.show', compact('vehicle'));
    }

    /**
     * Muestra el formulario para editar un vehículo existente.
     *
     * @param  \App\Models\TransferVehiculo  $vehicle
     * @return \Illuminate\View\View
     */
    public function edit(TransferVehiculo $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    /**
     * Actualiza un vehículo específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransferVehiculo  $vehicle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, TransferVehiculo $vehicle)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'capacidad' => 'required|integer|min:1',
        ]);

        $vehicle->nombre = $request->nombre;
        $vehicle->descripcion = $request->descripcion;
        $vehicle->capacidad = $request->capacidad;
        $vehicle->save();

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehículo actualizado correctamente');
    }

    /**
     * Elimina un vehículo específico de la base de datos.
     *
     * @param  \App\Models\TransferVehiculo  $vehicle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TransferVehiculo $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehículo eliminado correctamente');
    }
}
