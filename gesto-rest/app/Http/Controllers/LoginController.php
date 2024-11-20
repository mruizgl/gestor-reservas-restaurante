<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador para la gestión del inicio de sesión.
 * @author Melissa Ruiz y Noelia
 */
class LoginController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Maneja el inicio de sesión y redirige según el rol del usuario.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
    
            // Redirigir a la vista de crear reservas si el rol es de usuario normal
            if ($role === 'user') {
                return redirect()->route('reservations.create');
            }
    
            return redirect()->route('home');
        }
    
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Cierra la sesión del usuario.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
