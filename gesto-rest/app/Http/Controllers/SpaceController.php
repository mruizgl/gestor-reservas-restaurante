<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Space;

/**
 * Controlador para gestionar la creación de espacios.
 */
class SpaceController extends Controller
{
    public function index()
    {
        $spaces = Space::all();
        return view('admin.spaces.index', compact('spaces'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        return view('admin.spaces.create');
    }

    // Almacenar un nuevo espacio
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rows' => 'required|integer|min:1',
            'columns' => 'required|integer|min:1',
            'description' => 'nullable|string|max:1000',
        ]);

        Space::create($request->all());

        return redirect()->route('spaces.index')->with('success', 'Espacio creado correctamente.');
    }

    // Mostrar el formulario de edición
    public function edit(Space $space)
    {
        return view('admin.spaces.edit', compact('space'));
    }

    // Actualizar un espacio existente
    public function update(Request $request, Space $space)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rows' => 'required|integer|min:1',
            'columns' => 'required|integer|min:1',
            'description' => 'nullable|string|max:1000',
        ]);

        $space->update($request->all());

        return redirect()->route('spaces.index')->with('success', 'Espacio actualizado correctamente.');
    }

    // Eliminar un espacio
    public function destroy(Space $space)
    {
        $space->delete();

        return redirect()->route('spaces.index')->with('success', 'Espacio eliminado correctamente.');
    }
}
