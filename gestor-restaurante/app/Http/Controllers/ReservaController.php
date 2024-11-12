<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Controlador de las reservas de la app
 * @author Melissa y Noelia
 */

class ReservaController extends Controller
{
    public function index() {
        return view('reservas.index');
    }

    public function store(Request $request) {
        $request->validate([
            'mesa_id' => 'required|exists:mesas,id',
            'user_id' => 'required|exists:users,id',
            'nombre_cliente' => 'required|string',
            'telefono_cliente' => 'required|string',
            'num_personas' => 'required|integer',
            'fecha_hora' => 'required|date_format:Y-m-d H:i',
        ]);

        $fechaHoraReserva = Carbon::createFromFormat('Y-m-d H:i', $request->fecha_hora);

        $existeReserva = Reserva::where('mesa_id', $request->mesa_id)
            ->whereBetween('fecha_hora', [
                $fechaHoraReserva->copy()->subHours(2),
                $fechaHoraReserva->copy()->addHours(2),
            ])
            ->exists();

        if ($existeReserva) {
            return back()->withErrors(['fecha_hora' => 'Ya existe una reserva para esta mesa en el rango de tiempo especificado.']);
        }

        $reserva = new Reserva();
        $reserva->mesa_id = $request->mesa_id;
        $reserva->user_id = $request->user_id;
        $reserva->nombre_cliente = $request->nombre_cliente;
        $reserva->telefono_cliente = $request->telefono_cliente;
        $reserva->num_personas = $request->num_personas;
        $reserva->fecha_hora = $fechaHoraReserva;
        $reserva->save();

        return redirect()->route('reservas.index')->with('success', 'Reserva realizada con éxito.');

    }
}
