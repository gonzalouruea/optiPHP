<?php

namespace App\Http\Controllers;

use App\Models\TransferHotel;
use App\Models\TransferReservas;
use App\Models\TransferVehiculo;
use App\Models\TransferZona;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    /**
     * Muestra una lista de todas las reservas.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->rol === 'admin') {
            $reservas = TransferReservas::with(['hotel', 'vehiculo', 'zona'])->orderBy('fecha_reserva', 'desc')->get();
            return view('admin.reservations.index', compact('reservas'));
        } else {
            $reservas = TransferReservas::where('email_cliente', $user->email)
                                      ->orderBy('fecha_reserva', 'desc')
                                      ->get();
            return view('particular.reservations.index', compact('reservas'));
        }
    }

    /**
     * Muestra el formulario para crear una nueva reserva.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $hoteles = TransferHotel::all();
        $vehiculos = TransferVehiculo::all();
        $zonas = TransferZona::all();
        
        $user = Auth::user();
        if ($user->rol === 'admin') {
            return view('admin.reservations.create', compact('hoteles', 'vehiculos', 'zonas'));
        } else {
            return view('particular.reservations.create', compact('hoteles', 'vehiculos', 'zonas'));
        }
    }

    /**
     * Almacena una nueva reserva en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->rol === 'admin';
        
        // Validaciones comunes
        $rules = [
            'id_hotel' => 'required|exists:transfer_hotel,id',
            'id_destino' => 'required|exists:transfer_zona,id_zona',
            'email_cliente' => 'required|email',
            'fecha_entrada' => 'required|date',
            'hora_entrada' => 'required',
            'numero_vuelo_entrada' => 'required|string',
            'origen_vuelo_entrada' => 'required|string',
            'fecha_vuelo_salida' => 'required|date',
            'hora_vuelo_salida' => 'required',
            'num_viajeros' => 'required|integer|min:1',
            'id_vehiculo' => 'required|exists:transfer_vehiculo,id',
            'hora_recogida' => 'required',
        ];
        
        // Validación adicional para usuarios normales: reserva con 48h de antelación
        if (!$isAdmin) {
            $fechaEntrada = Carbon::parse($request->fecha_entrada);
            $ahora = Carbon::now();
            
            if ($fechaEntrada->diffInHours($ahora) < 48) {
                return back()->withErrors([
                    'fecha_entrada' => 'Las reservas deben realizarse con al menos 48 horas de antelación.',
                ])->withInput();
            }
        }
        
        $request->validate($rules);
        
        // Crear la reserva
        $reserva = new TransferReservas([
            'localizador' => Str::random(8),
            'id_hotel' => $request->id_hotel,
            'id_tipo_reserva' => 1, // Valor por defecto
            'email_cliente' => $request->email_cliente,
            'fecha_reserva' => Carbon::now(),
            'fecha_modificacion' => Carbon::now(),
            'id_destino' => $request->id_destino,
            'fecha_entrada' => $request->fecha_entrada,
            'hora_entrada' => $request->hora_entrada,
            'numero_vuelo_entrada' => $request->numero_vuelo_entrada,
            'origen_vuelo_entrada' => $request->origen_vuelo_entrada,
            'fecha_vuelo_salida' => $request->fecha_vuelo_salida,
            'hora_vuelo_salida' => $request->hora_vuelo_salida,
            'num_viajeros' => $request->num_viajeros,
            'id_vehiculo' => $request->id_vehiculo,
            'hora_recogida' => $request->hora_recogida,
            'creado_por_admin' => $isAdmin,
        ]);
        
        $reserva->save();
        
        if ($isAdmin) {
            return redirect()->route('admin.reservations.index')
                ->with('success', 'Reserva creada correctamente');
        } else {
            return redirect()->route('particular.reservations.index')
                ->with('success', 'Reserva creada correctamente');
        }
    }

    /**
     * Muestra la información de una reserva específica.
     *
     * @param  \App\Models\TransferReservas  $reservation
     * @return \Illuminate\View\View
     */
    public function show(TransferReservas $reservation)
    {
        $user = Auth::user();
        
        // Verificar que el usuario tenga acceso a esta reserva
        if ($user->rol !== 'admin' && $reservation->email_cliente !== $user->email) {
            abort(403, 'No tienes permiso para ver esta reserva.');
        }
        
        if ($user->rol === 'admin') {
            return view('admin.reservations.show', compact('reservation'));
        } else {
            return view('particular.reservations.show', compact('reservation'));
        }
    }

    /**
     * Muestra el formulario para editar una reserva existente.
     *
     * @param  \App\Models\TransferReservas  $reservation
     * @return \Illuminate\View\View
     */
    public function edit(TransferReservas $reservation)
    {
        // Solo los administradores pueden editar reservas
        $user = Auth::user();
        if ($user->rol !== 'admin') {
            abort(403, 'No tienes permiso para editar reservas.');
        }
        
        $hoteles = TransferHotel::all();
        $vehiculos = TransferVehiculo::all();
        $zonas = TransferZona::all();
        
        return view('admin.reservations.edit', compact('reservation', 'hoteles', 'vehiculos', 'zonas'));
    }

    /**
     * Actualiza una reserva específica en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransferReservas  $reservation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, TransferReservas $reservation)
    {
        // Solo los administradores pueden actualizar reservas
        $user = Auth::user();
        if ($user->rol !== 'admin') {
            abort(403, 'No tienes permiso para actualizar reservas.');
        }
        
        $request->validate([
            'id_hotel' => 'required|exists:transfer_hotel,id',
            'id_destino' => 'required|exists:transfer_zona,id_zona',
            'email_cliente' => 'required|email',
            'fecha_entrada' => 'required|date',
            'hora_entrada' => 'required',
            'numero_vuelo_entrada' => 'required|string',
            'origen_vuelo_entrada' => 'required|string',
            'fecha_vuelo_salida' => 'required|date',
            'hora_vuelo_salida' => 'required',
            'num_viajeros' => 'required|integer|min:1',
            'id_vehiculo' => 'required|exists:transfer_vehiculo,id',
            'hora_recogida' => 'required',
        ]);
        
        $reservation->id_hotel = $request->id_hotel;
        $reservation->id_destino = $request->id_destino;
        $reservation->email_cliente = $request->email_cliente;
        $reservation->fecha_entrada = $request->fecha_entrada;
        $reservation->hora_entrada = $request->hora_entrada;
        $reservation->numero_vuelo_entrada = $request->numero_vuelo_entrada;
        $reservation->origen_vuelo_entrada = $request->origen_vuelo_entrada;
        $reservation->fecha_vuelo_salida = $request->fecha_vuelo_salida;
        $reservation->hora_vuelo_salida = $request->hora_vuelo_salida;
        $reservation->num_viajeros = $request->num_viajeros;
        $reservation->id_vehiculo = $request->id_vehiculo;
        $reservation->hora_recogida = $request->hora_recogida;
        $reservation->fecha_modificacion = Carbon::now();
        
        $reservation->save();
        
        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reserva actualizada correctamente');
    }

    /**
     * Elimina una reserva específica de la base de datos.
     *
     * @param  \App\Models\TransferReservas  $reservation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TransferReservas $reservation)
    {
        // Solo los administradores pueden eliminar reservas
        $user = Auth::user();
        if ($user->rol !== 'admin') {
            abort(403, 'No tienes permiso para eliminar reservas.');
        }
        
        $reservation->delete();
        
        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reserva eliminada correctamente');
    }
    
    /**
     * Muestra el calendario de reservas.
     *
     * @return \Illuminate\View\View
     */
    public function calendar()
    {
        // Solo los administradores pueden ver el calendario
        $user = Auth::user();
        if ($user->rol !== 'admin') {
            abort(403, 'No tienes permiso para ver el calendario de reservas.');
        }
        
        $reservas = TransferReservas::all();
        return view('admin.reservations.calendar', compact('reservas'));
    }
}
