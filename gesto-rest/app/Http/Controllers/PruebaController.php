<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function prueba() {
        return view('prueba');
    }
    public function pruebita() {
        return view('pruebita');
    }

    public function pruebaprueba() {
        return view('pruebaprueba');
    }
}
