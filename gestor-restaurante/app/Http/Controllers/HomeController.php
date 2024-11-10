<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

/**
 * Controlador de la home de empleados y administradores de la app
 * @author Melissa y Noelia
 */

class HomeController extends Controller {

    public function indexHome() {
        return view('home.index');
    }

   public function home() {
        dd('Usuario creado correctamente.');
        return redirect()->route('home');
    }

}
