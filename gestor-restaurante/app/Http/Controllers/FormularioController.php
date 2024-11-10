<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Controlador de la creación de empleados de la app
 * @author Melissa y Noelia
 */

class FormularioController extends Controller {

    public function CrearEmpleadoIndex() {
        return view('crearEmpleados.index');
    }

    public function formulario(Request $request) {

        $user = new User();
        $user -> name = $request->name;
        $user -> email = $request->email;
        $user -> password = $request->password;
        $user -> role = $request->role;
        $user -> save();

        return redirect()->route('home');

    }

}
