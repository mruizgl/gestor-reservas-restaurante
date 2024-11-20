<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Space;

use Illuminate\Http\Request;
/**
 * Controlador para el añadir mesas
 * @author Melissa Ruiz y Noelia
 */
class AddTablesController extends Controller
{
 
    /**
     * Funcion que devuelve la lista y recoge los espacios y el espacio seleccionado 
     */
    public function create(Request $request)
    {
        $spaces = Space::all();
    
        if ($spaces->isEmpty()) {
            return redirect()->route('admin.dashboard')->with('error', 'No hay espacios disponibles. Por favor, crea uno primero.');
        }
    
     
        $selectedSpaceId = $request->get('space_id', $spaces->first()->id);
        $selectedSpace = Space::findOrFail($selectedSpaceId);
    
        return view('admin.tables.create', compact('spaces', 'selectedSpace'));
    }

    /**
     * Funcion que agrega las mesas a la tabla
     */
    public function store(Request $request)
    {
        $request->validate([
            'space_id' => 'required|exists:spaces,id',
            'tables' => 'required|array',
            'tables.*' => 'string',
            'capacity' => 'required|array',
            'capacity.*' => 'integer|min:1',
        ]);
    
        $space = Space::findOrFail($request->space_id);
    
        foreach ($request->tables as $position) {
            [$row, $col] = explode('-', $position);
    
            Table::updateOrCreate(
                [
                    'space_id' => $space->id,
                    'row' => $row,
                    'column' => $col,
                ],
                [
                    'capacity' => $request->capacity[$position],
                    'ubicacion' => $space->name,
                ]
            );
        }
    
        return redirect()->route('admin.dashboard')->with('success', 'Mesas añadidas correctamente.');
    }

}
