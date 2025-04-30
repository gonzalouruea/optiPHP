<?php

namespace App\Http\Controllers;

use App\Models\TransferHotel;
use App\Models\TransferZona;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Muestra una lista de todos los hoteles.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $hoteles = TransferHotel::with('zona')->get();
        return view('admin.hotels.index', compact('hoteles'));
    }

    /**
     * Muestra el formulario para crear un nuevo hotel.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $zonas = TransferZona::all();
        return view('admin.hotels.create', compact('zonas'));
    }

    /**
     * Almacena un nuevo hotel en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_zona' => 'required|exists:transfer_zona,id_zona',
            'Comision' => 'required|numeric',
            'Usuario' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        TransferHotel::create([
            'id_zona' => $request->id_zona,
            'Comision' => $request->Comision,
            'Usuario' => $request->Usuario,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel creado correctamente');
    }

    /**
     * Muestra la información de un hotel específico.
     *
     * @param  \App\Models\TransferHotel  $hotel
     * @return \Illuminate\View\View
     */
    public function show(TransferHotel $hotel)
    {
        $hotel->load('zona');
        return view('admin.hotels.show', compact('hotel'));
    }

    /**
     * Muestra el formulario para editar un hotel existente.
     *
     * @param  \App\Models\TransferHotel  $hotel
     * @return \Illuminate\View\View
     */
    public function edit(TransferHotel $hotel)
    {
        $zonas = TransferZona::all();
        return view('admin.hotels.edit', compact('hotel', 'zonas'));
    }

    /**
     * Actualiza un hotel específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransferHotel  $hotel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, TransferHotel $hotel)
    {
        $request->validate([
            'id_zona' => 'required|exists:transfer_zona,id_zona',
            'Comision' => 'required|numeric',
            'Usuario' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        $hotel->id_zona = $request->id_zona;
        $hotel->Comision = $request->Comision;
        $hotel->Usuario = $request->Usuario;
        
        if ($request->filled('password')) {
            $hotel->password = bcrypt($request->password);
        }
        
        $hotel->save();

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel actualizado correctamente');
    }

    /**
     * Elimina un hotel específico de la base de datos.
     *
     * @param  \App\Models\TransferHotel  $hotel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TransferHotel $hotel)
    {
        $hotel->delete();

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel eliminado correctamente');
    }
}
