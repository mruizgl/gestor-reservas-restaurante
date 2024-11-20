<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador del login de la aplicacion
 * @author Melissa Ruiz y Noelia
 */
class LoginController extends Controller
{
    /**
     * Funcion que devuelve la vista del loin
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Funcion que verifica el login y tu rol
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Funcion que cierra tu sesion y vuelves al inicio
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function index()
    {
        return view('admin.dashboard');
    }
}
