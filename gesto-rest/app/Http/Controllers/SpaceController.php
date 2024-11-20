<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Space;

class SpaceController extends Controller
{
    public function create()
    {
        return view('admin.spaces.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rows' => 'required|integer|min:1',
            'columns' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        Space::create($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Espacio creado con éxito.');
    }

}
