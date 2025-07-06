@extends('layouts.app')

@section('titulo')
Sistema de Gestion de Vuelos Aereos FAE...
@endsection

@section('contenido')

<div class="d-flex justify-content-between align-text">
    <h1>Listado de vuelos</h1>
    <div class="d-flex gap-2">
        
    </div>
</div>

<table class="table table-hovered table-striped table-bordered w-100">
    <thead>
        <tr>
            <th>ID</th>
            <th>DNI</th>
            <th>NOMBRE</th>
            <th>LAT1</th>
            <th>LONG2</th>
            <th>LAT2</th>
            <th>LONG2</th>
            <th>LAT3</th>
            <th>LONG3</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vuelo as $v)
        <tr>
            <td>{{ $v->id }}</td>
            <td>{{ $v->dni }}</td>
            <td>{{ $v->nombre }}</td>
            <td>{{ $v->latitud1 }}</td>
            <td>{{ $v->longitud1 }}</td>
            <td>{{ $v->latitud2 }}</td>
            <td>{{ $v->longitud2 }}</td>
            <td>{{ $v->latitud3 }}</td>
            <td>{{ $v->longitud3 }}</td>
            <td>
                <a href="{{ route('vuelos.edit', $v->id) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('vuelos.destroy', $v->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este vuelo?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                <a href="{{ url('/vuelos/mapa', $v->id ) }}" class="btn btn-success"> Graficar ruta</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection