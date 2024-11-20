<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Space;

/**
 * Controlador para gestionar la creación de espacios.
 */
class SpaceController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo espacio.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.spaces.create'); 
    }

    /**
     * Almacena un nuevo espacio en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rows' => 'required|integer|min:1',
            'columns' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        Space::create([
            'name' => $request->name,
            'rows' => $request->rows,
            'columns' => $request->columns,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Espacio creado con éxito.');
    }
}
