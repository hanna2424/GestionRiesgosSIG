@extends('layout.app')

@section('titulo')
Listado de Zonas Seguras
@endsection

@section('contenido')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mt-4 mb-3"><i class="fa-solid fa-bars-staggered"></i> Listado de Zonas Seguras</h2>
            <!-- Botón ingresar nueva zona -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('seguro.index') }}" class="btn btn-outline-primary">
                    <i class="fa fa-plus"></i> Agregar nueva Zona Segura
                </a>&nbsp;&nbsp;&nbsp;&nbsp;
            </div>

            <!-- Tabla -->
            <div class="table-responsive">
                <table id="tablaxd" name="tablaxd" class="table table-hover table-striped table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>RADIO</th>
                            <!-- Coordenadas centrales -->
                            <th>LATITUD</th>
                            <th>LONGITUD</th>
                            <th>TIPO DE SEGURIDAD</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($seguro as $r)
                        <tr>
                            <td>{{ $r->id }}</td>
                            <td>{{ $r->nombre }}</td>
                            <td>{{ $r->radio }}</td>
                            <td>{{ number_format($r->latitud, 2) }}</td>
                            <td>{{ number_format($r->longitud, 2) }}</td>
                            <td>
                                @php
                                    $color = match($r->seguridad) {
                                        'Seguridad Alta' => 'danger',
                                        'Seguridad Media' => 'warning',
                                        'Seguridad Baja' => 'success',
                                        default => 'success'
                                    };
                                @endphp
                                <span class="badge bg-{{ $color }}">{{ $r->seguridad }}</span>
                            </td>
                            <td>
                                <a href="{{ route('seguro.edit', $r->id) }}" class="btn btn-warning btn-sm mb-1">Editar</a>
                                <form id="form-eliminar-{{ $r->id }}" action="{{ route('seguro.destroy', $r->id) }}" method="POST" style="display:inline-block;">
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
