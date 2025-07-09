<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\ZonaRiesgo;

class ZonaRiesgoController extends Controller
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

        $riesgo = ZonaRiesgo::all();

        return view('riesgo.nuevo', compact('riesgo'));
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

        return view('riesgo.nuevo');
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
            'descripcion' => $request->descripcion,
            'riesgo' => $request->riesgo,
            'latitud1' => $request->latitud1,
            'longitud1' => $request->longitud1,
            'latitud2' => $request->latitud2,
            'longitud2' => $request->longitud2,
            'latitud3' => $request->latitud3,
            'longitud3' => $request->longitud3,
            'latitud4' => $request->latitud4,
            'longitud4' => $request->longitud4
        ];

        ZonaRiesgo::create($datos);
        return redirect('/listado')->with('success', 'Zona agregada correctamente.');
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

        $riesgo = ZonaRiesgo::findOrFail($id);
        return view('riesgo.modificar', compact('riesgo'));
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

        $riesgo = ZonaRiesgo::findOrFail($id);

        $riesgo->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'riesgo' => $request->riesgo,
            'latitud1' => $request->latitud1,
            'longitud1' => $request->longitud1,
            'latitud2' => $request->latitud2,
            'longitud2' => $request->longitud2,
            'latitud3' => $request->latitud3,
            'longitud3' => $request->longitud3,
            'latitud4' => $request->latitud4,
            'longitud4' => $request->longitud4
        ]);

        return redirect('/listado')->with('success', 'Zona de riesgo actualizada correctamente');
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

        $riesgo = ZonaRiesgo::findOrFail($id);
        $riesgo->delete();

        return redirect('/listado')->with('success', 'Zona de riesgo eliminada correctamente.');
    }

    public function listado()
    {
        if (!Session::has('usuario')) {
            return redirect('/')->with('info', 'Debe iniciar sesión para continuar.');
        }

        $riesgo = ZonaRiesgo::all();

        return view('riesgo.listado', compact('riesgo'));
    }
}
