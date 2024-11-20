<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Space;

/**
 * Controlador para gestionar las mesas en los espacios.
 */
class TableController extends Controller
{
    /**
     * Muestra el formulario para añadir mesas a un espacio.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $spaces = Space::all();
        if ($spaces->isEmpty()) {
            return redirect()->back()->withErrors('No hay espacios disponibles para gestionar reservas.');
        }
        $tables = Table::all()->map(function ($table) {
            $table->image = asset('images/' . $table->capacity . '.png');
            return $table;
        });

        return view('reservations.create', compact('tables'));
    }

    /**
     * Almacena nuevas mesas asociadas a un espacio.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $spaces = Space::all();
        if ($spaces->isEmpty()) {
            return redirect()->back()->withErrors('No hay espacios disponibles para gestionar reservas.');
        }
        $request->validate([
            'space_id' => 'required|exists:spaces,id',
            'tables' => 'required|array',
            'tables.*' => 'string',
            'capacities' => 'required|array',
            'capacities.*' => 'integer|min:1',
        ]);

        $space = Space::findOrFail($request->space_id);
        if ($spaces->isEmpty()) {
            return redirect()->back()->withErrors('No hay espacios disponibles para gestionar mesas.');
        }

        foreach ($request->tables as $position) {
            [$row, $col] = explode('-', $position);

            Table::updateOrCreate(
                [
                    'space_id' => $space->id,
                    'row' => $row,
                    'column' => $col,
                ],
                [
                    'capacity' => $request->capacities[$position],
                ]
            );
        }

        return redirect()->route('admin.dashboard')->with('success', 'Mesas añadidas correctamente.');
    }
}
