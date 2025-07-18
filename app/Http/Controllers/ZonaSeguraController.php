<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Seguro;

class ZonaSeguraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (!Session::has('usuario')) {
            return redirect('/')->with('info', 'Debe iniciar sesión para continuar.');
        }

        $seguro = Seguro::all();

        return view('seguro.nuevo', compact('seguro'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (!Session::has('usuario')) {
            return redirect('/')->with('info', 'Debe iniciar sesión para continuar.');
        }

        return view('seguro.nuevo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if (!Session::has('usuario')) {
            return redirect('/')->with('info', 'Debe iniciar sesión para continuar.');
        }
        
        $datos = [
            'nombre' => $request->nombre,
            'radio' => $request->radio,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'seguridad' => $request->seguridad
        ];

        Seguro::create($datos);
        return redirect('/listado2')->with('success', 'Zona segura agregada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        if (!Session::has('usuario')) {
            return redirect('/')->with('info', 'Debe iniciar sesión para continuar.');
        }

        $seguro = Seguro::findOrFail($id);
        return view('seguro.modificar', compact('seguro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        if (!Session::has('usuario')) {
            return redirect('/')->with('info', 'Debe iniciar sesión para continuar.');
        }

        $seguro = Seguro::findOrFail($id);
        
        $seguro->update([
            'nombre' => $request->nombre,
            'radio' => $request->radio,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'seguridad' => $request->seguridad
        ]);

        return redirect('/listado2')->with('success', 'Zona segura editada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        if (!Session::has('usuario')) {
            return redirect('/')->with('info', 'Debe iniciar sesión para continuar.');
        }

        $seguro = Seguro::findOrFail($id);
        $seguro->delete();

        return redirect('/listado2')->with('success', 'Zona segura eliminada correctamente.');
    }
    
    public function listado()
    {
        if (!Session::has('usuario')) {
            return redirect('/')->with('info', 'Debe iniciar sesión para continuar.');
        }

        $seguro = Seguro::all();

        return view('seguro.listado', compact('seguro'));
    }

    public function mapa()
    {
        if (!Session::has('usuario')) {
            return redirect('/')->with('info', 'Debe iniciar sesión para continuar.');
        }

        $seguro = Seguro::all();

        return view('seguro.mapa', compact('seguro'))->with('success', 'Datos geograficos cargados correctamente');
    }
}
