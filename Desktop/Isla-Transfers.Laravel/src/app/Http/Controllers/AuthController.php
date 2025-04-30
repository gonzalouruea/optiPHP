<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de registro.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Registra un nuevo usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nombre' => ['required', 'string', 'max:100'],
            'apellido1' => ['required', 'string', 'max:100'],
            'apellido2' => ['required', 'string', 'max:100'],
            'direccion' => ['required', 'string', 'max:100'],
            'codigoPostal' => ['required', 'string', 'max:100'],
            'ciudad' => ['required', 'string', 'max:100'],
            'pais' => ['required', 'string', 'max:100'],
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => 'usuario'
        ]);

        // Crear el viajero asociado al usuario
        $viajero = $user->viajero()->create([
            'nombre' => $request->nombre,
            'apellido1' => $request->apellido1,
            'apellido2' => $request->apellido2,
            'direccion' => $request->direccion,
            'codigoPostal' => $request->codigoPostal,
            'ciudad' => $request->ciudad,
            'pais' => $request->pais
        ]);

        Auth::login($user);

        return redirect()->route('particular.dashboard');
    }

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
     * Inicia sesión con un usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            
            // Redireccionar según el rol del usuario
            if ($user->rol === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->rol === 'corporativo') {
                return redirect()->intended(route('corporativo.dashboard'));
            } else {
                return redirect()->intended(route('particular.dashboard'));
            }
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Cierra la sesión del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
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
