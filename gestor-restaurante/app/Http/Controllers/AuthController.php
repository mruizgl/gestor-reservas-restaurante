<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Muestra la vista de login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesa el formulario de login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif (auth()->user()->isEmpleado()) {
                return redirect()->route('empleado.dashboard');
            }

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no son válidas.',
        ]);
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
