<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;

class TableController extends Controller
{
    public function create()
    {
        $tables = Table::all();

        foreach ($tables as $table) {
            $table->image = asset('images/' . $table->capacity . '.png');
        }

        return view('reservations.create', compact('tables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'space_id' => 'required|exists:spaces,id',
            'tables' => 'required|array',
            'tables.*' => 'string',
            'capacities' => 'required|array',
            'capacities.*' => 'integer|min:1',
        ]);
    
        $space = Space::findOrFail($request->space_id);
    
        foreach ($request->tables as $key => $position) {
            [$row, $col] = explode('-', $position);
    
            Table::create([
                'space_id' => $request->space_id,
                'row' => $row,
                'column' => $col,
                'capacity' => $request->capacities[$position],
                'ubication' => $space->name,
            ]);
        }
    
        return redirect()->route('admin.dashboard')->with('success', 'Mesas añadidas correctamente.');
    }
}
