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
        $dia = $request->dia;
        $capacity = $request->capacity;
        return view('addTables.preview')->with('dia', $dia)->with('capacity', $capacity);
    }

    public function preview() {
      //  $tables = Table::all();
        return redirect('addTables.preview');//, compact('tables'));
    }

    public function back() {
        return redirect('addTables.index');
    }

}
