<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create()
    {
        $tables = Table::all();
        return view('reservations.create', compact('tables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'num_people' => 'required|integer|min:1',
            'reservation_time' => 'required|date|after:now',
        ]);

        $table = Table::findOrFail($request->table_id);

        $conflict = Reservation::where('table_id', $table->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('reservation_time', [
                    Carbon::parse($request->reservation_time)->subHours(2),
                    Carbon::parse($request->reservation_time)->addHours(2)
                ]);
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['error' => 'Ya hay una reserva en ese horario.']);
        }

        Reservation::create([
            'table_id' => $request->table_id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'num_people' => $request->num_people,
            'reservation_time' => $request->reservation_time,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reserva realizada con éxito!');
    }
}
