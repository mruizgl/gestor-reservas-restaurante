<?php

namespace App\Http\Controllers;

use App\Models\Table;

use Illuminate\Http\Request;

class AddTablesController extends Controller
{
    public function index() {
        return view('addTables.index');
    }
    public function addTables(Request $request) {
        $zona = $request->zona;
        $dia = $request->dia;
        $capacidad = $request->capacidad;
        return view('addTables.addTables')->with('zona', $zona)->with('dia', $dia)->with('capacidad', $capacidad);
    }

    public function preview(Request $request) {
        $zona = $request->zona;
        $dia = $request->dia;
        $capacidad = $request->capacidad;
        return view('addTables.preview')->with('zona', $zona)->with('dia', $dia)->with('capacidad', $capacidad);
    }

/*    public function back() {
        return redirect('addTables.index');
    }
*/
}
