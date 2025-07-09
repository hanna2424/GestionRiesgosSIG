<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Encuentro;

class PuntoEncuentroController extends Controller
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

        $encuentro = Encuentro::all();

        return view('encuentro.nuevo', compact('encuentro'));

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

        return view('encuentro.nuevo');
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
            'capacidad' => $request->capacidad,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'responsable' => $request->responsable
        ];

        Encuentro::create($datos);
        return redirect('/listado1')->with('success', 'Zona agregada correctamente.');
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

        $encuentro = Encuentro::findOrFail($id);
        return view('encuentro.modificar', compact('encuentro'));
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

        $datos = Encuentro::findOrFail($id);

        $datos->update([
            'nombre' => $request->nombre,
            'capacidad' => $request->capacidad,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'responsable' => $request->responsable
        ]);

        return redirect('/listado1')->with('success', 'Punto de encuentro editado exitosamente.');
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

        $encuentro = Encuentro::findOrFail($id);
        $encuentro->delete();

        return redirect('/listado1')->with('success', 'Punto de Encuentro eliminado correctamente.');
    }

    public function listado()
    {
        if (!Session::has('usuario')) {
            return redirect('/')->with('info', 'Debe iniciar sesión para continuar.');
        }

        $encuentro = Encuentro::all();

        return view('encuentro.listado', compact('encuentro'));
    }

    public function mapa()
    {
        if (!Session::has('usuario')) {
            return redirect('/')->with('info', 'Debe iniciar sesión para continuar.');
        }

        $encuentro = Encuentro::all();

        return view('encuentro.mapa', compact('encuentro'))->with('success', 'Datos geograficos cargados correctamente');
    }
}
