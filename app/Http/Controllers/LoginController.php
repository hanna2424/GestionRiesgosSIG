<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Session::has('usuario')) {
            Session::forget('usuario');
            return redirect('/')->with('info', 'Debe iniciar sesion para acceder');
        }

        else{
            return view('login.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $usuario = Usuario::where('username', $request->username)->first();

        if ($usuario && $request->password === $usuario->password) {
            Session::put('usuario', $usuario->username); // guardar sesión
            return redirect('/menu')->with('success', 'Bienvenido'. $usuario->username);
        }

        return redirect('/')->with('error', 'Credenciales incorrectas');
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }

    public function logout()
    {
        Session::flush();
        return redirect('/')->with('info', 'Sesion finalizada');
    }
}
