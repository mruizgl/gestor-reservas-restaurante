<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Controlador para la gestión de usuarios.
 */
class UserController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo usuario.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.createUser');
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:3', 
                'confirmed',
                'regex:/[A-Za-z]/'
            ],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Usuario creado con éxito.');
    }
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    

 

    public function edit($id)
    {
        $employee = User::findOrFail($id);
        return view('admin.users.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $employee->id,
            'role' => 'required|string',
        ]);

        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password ? bcrypt($request->password) : $employee->password,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Empleado actualizado correctamente.');
    }

    public function destroy($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();

        return redirect()->route('admin.users.index')->with('success', 'Empleado eliminado correctamente.');
    }
}
