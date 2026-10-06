<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function index(): View
    {
        return view('Login');
    }

    /**
     * Procesa el inicio de sesión.
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('welcome');
        }

        return back()->withErrors([
            'credentials'=> 'Los datos ingresados son incorrectos.'
        ]);
    }

    /**
     * Procesa el registro de un nuevo usuario.
     */
    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ],[
            'name'=> 'El nombre es excede el numero de caracteres permitidos (255)',
            'email'=> 'Ya existe una cuenta con este correo',
            'password'=> 'Debe tener al menos 8 caracteres',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        auth()->login($user);
        return redirect('login');
    }
}
