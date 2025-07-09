@extends('layout.app')

@section('titulo')
Zonas de Riesgo
@endsection

@section('contenido')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mt-4 mb-3"><i class="fa-solid fa-bars-staggered"></i> Listado de Zonas de Riesgo</h2>
            <!-- Botón ingresar nueva zona -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('riesgo.index') }}" class="btn btn-outline-primary">
                    <i class="fa fa-plus"></i> Agregar nueva Zona de Riesgo
                </a>&nbsp;&nbsp;&nbsp;&nbsp;
            </div>

            <!-- Tabla -->
            <div class="table-responsive">
                <table id="tablaxd" name="tablaxd" class="table table-hover table-striped table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>DESCRIPCIÓN</th>
                            <th>RIESGO</th>
                            <th>LAT 1</th>
                            <th>LONG 1</th>
                            <th>LAT 2</th>
                            <th>LONG 2</th>
                            <th>LAT 3</th>
                            <th>LONG 3</th>
                            <th>LAT 4</th>
                            <th>LONG 4</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riesgo as $r)
                        <tr>
                            <td>{{ $r->id }}</td>
                            <td>{{ $r->nombre }}</td>
                            <td>{{ $r->descripcion }}</td>
                            <td>
                                @php
                                    $color = match($r->riesgo) {
                                        'Riesgo Alto' => 'danger',
                                        'Riesgo Medio' => 'warning',
                                        'Riesgo Bajo' => 'success',
                                        default => 'secondary'
                                    };
                                @endphp
                                <span class="badge bg-{{ $color }}">{{ $r->riesgo }}</span>
                            </td>
                            <td>{{ number_format($r->latitud1, 2) }}</td>
                            <td>{{ number_format($r->longitud1, 2) }}</td>
                            <td>{{ number_format($r->latitud2, 2) }}</td>
                            <td>{{ number_format($r->longitud2, 2) }}</td>
                            <td>{{ number_format($r->latitud3, 2) }}</td>
                            <td>{{ number_format($r->longitud3, 2) }}</td>
                            <td>{{ number_format($r->latitud4, 2) }}</td>
                            <td>{{ number_format($r->longitud4, 2) }}</td>
                            <td>
                                <a href="{{ route('riesgo.edit', $r->id) }}" class="btn btn-warning btn-sm mb-1">Editar</a>
                                <form id="form-eliminar-{{ $r->id }}" action="{{ route('riesgo.destroy', $r->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminacion({{ $r->id }})">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<script>
    $(document).ready(function () {
        let table = $('#tablaxd').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });
    });
</script>

<script>
function confirmarEliminacion(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡Esta acción no se puede deshacer!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-eliminar-' + id).submit();
        }
    });
}
</script>



@endsection
