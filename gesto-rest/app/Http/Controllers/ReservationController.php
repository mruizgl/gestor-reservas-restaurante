<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Reservation;
use Carbon\Carbon;
use App\Models\Space;

/**
 * Controlador para la gestión de reservas.
 */
class ReservationController extends Controller
{
    /**
     * Muestra todas las reservas.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
    $today = Carbon::today();

    $todaysReservations = Reservation::whereDate('reservation_time', $today)
        ->orderBy('reservation_time')
        ->get();

    $allReservations = [];
    if ($search) {
        $allReservations = Reservation::where(function ($q) use ($search) {
            $q->where('customer_name', 'like', '%' . $search . '%')
              ->orWhere('customer_phone', 'like', '%' . $search . '%');
        })
        ->orderBy('reservation_time')
        ->get();
    }

    return view('admin.reservations.index', compact('todaysReservations', 'allReservations', 'search'));
    }

    /**
     * Muestra la vista de creación de reservas con las mesas disponibles del espacio seleccionado.
     */
    public function create(Request $request)
    {
        $spaces = Space::all();
        $selectedSpace = $request->get('space', $spaces->first()->name);
        $selectedTableId = $request->get('table_id');

        $selectedSpaceObject = Space::where('name', $selectedSpace)->firstOrFail();
        $tables = Table::where('space_id', $selectedSpaceObject->id)->get();

        $allSlots = collect(range(0, 23))->map(function ($hour) {
            return Carbon::today()->addHours($hour)->format('H:i');
        });

        $occupiedSlots = Reservation::where('table_id', $selectedTableId)
            ->whereDate('reservation_time', now()->toDateString())
            ->pluck('reservation_time')
            ->map(function ($time) {
                return Carbon::parse($time)->format('H:i');
            });

        // Obtener reservas del día actual
        $reservations = Reservation::whereDate('reservation_time', now()->toDateString())->get();

        return view('admin.reservations.create', compact(
            'spaces',
            'tables',
            'selectedSpace',
            'selectedSpaceObject',
            'selectedTableId',
            'allSlots',
            'occupiedSlots',
            'reservations' 
        ));
    }

    /**
     * Almacena una nueva reserva en la base de datos.
     */
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
            ->whereBetween('reservation_time', [
                Carbon::parse($request->reservation_time)->subHours(2),
                Carbon::parse($request->reservation_time)->addHours(2),
            ])
            ->exists();

        if ($conflict) {
            return back()->withErrors(['error' => 'Ya hay una reserva en ese horario.'])->withInput();
        }

        Reservation::create([
            'table_id' => $request->table_id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'num_people' => $request->num_people,
            'reservation_time' => $request->reservation_time,
        ]);
        

        return redirect()->route('reservations.create')
        ->with('success', 'Reserva realizada con éxito!');
    }



    /**
     * Delete del crud de reservas
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('admin.reservations.create')->with('success', 'Reserva cancelada con éxito.');
    }

    /**
     * Update del crud de reservas
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $tables = Table::all(); 

        return view('admin.reservations.edit', compact('reservation', 'tables'));
    }

    public function update(Request $request, $id)
{
    $reservation = Reservation::findOrFail($id);
    
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'customer_phone' => 'required|string|max:20',
        'num_people' => 'required|integer|min:1',
        'reservation_time' => 'required|date',
        'table_id' => 'required|exists:tables,id',
    ]);

    $reservation->update($request->all());

    return redirect()->route('reservations.index')->with('success', 'Reserva actualizada correctamente');
}

}
