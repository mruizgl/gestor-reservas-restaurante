<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'capacity' => 'required|in:2,4,6,8', 
        ]);

        $table = Table::create([
            'capacity' => $request->capacity,
            'image' => 'images/tables/' . $request->capacity . '.png', 
        ]);


        return redirect()->route('tables.index')->with('success', 'Mesa agregada exitosamente!');
    }
}
