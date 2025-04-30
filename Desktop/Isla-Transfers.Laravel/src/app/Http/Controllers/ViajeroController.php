<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Viajero;

class ViajeroController extends Controller
{
    public function create()
    {
        return view('viajeros.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido1' => 'required|string|max:100',
            'apellido2' => 'required|string|max:100',
            'direccion' => 'required|string|max:100',
            'codigoPostal' => 'required|string|max:100',
            'ciudad' => 'required|string|max:100',
            'pais' => 'required|string|max:100',
            'email' => 'required|email|unique:transfer_viajero,email|max:100',
            'password' => 'required|string|min:8',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        Viajero::create($validatedData);

        return redirect()->route('home')->with('success', 'Registro exitoso');
    }
}
