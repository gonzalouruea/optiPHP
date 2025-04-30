<?php

namespace App\Http\Controllers;

use App\Models\TransferReservas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticularController extends Controller
{
    /**
     * Muestra el panel de control del usuario particular.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $reservas = TransferReservas::where('email_cliente', $user->email)
                                  ->orderBy('fecha_reserva', 'desc')
                                  ->get();
                                  
        return view('particular.dashboard', compact('reservas'));
    }
}
