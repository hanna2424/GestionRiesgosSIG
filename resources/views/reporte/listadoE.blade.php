@extends('layout.app')

@section('titulo')
Reporte Zonas de Encuentro
@endsection

@section('contenido')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mt-4 mb-3"><i class="fa-solid fa-bars-staggered"></i> Listado de Zonas de Encuentro</h2>

            <!-- Opciones de exportación -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4><i class="fa-solid fa-file-export"></i> Opciones de Exportación</h4>
                <div class="d-flex gap-2">
                    <button class="btn btn-danger" id="btn-custom-pdf"><i class="fa fa-file-pdf"></i> Exportar PDF</button>
                    <button class="btn btn-success" id="btn-excel" name="btn-excel"><i class="fa fa-file-excel"></i> Exportar a Excel</button>
                </div>
            </div>

            <!-- Botón ingresar nueva zona -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('rriesgo.index') }}" class="btn btn-outline-danger">
                    <i class="fa fa-list"></i> Reporte de Zonas de Riesgo
                </a>&nbsp;&nbsp;&nbsp;&nbsp;

                <a href="{{ route('rencuentro.index') }}" class="btn btn-outline-primary">
                    <i class="fa fa-list"></i> Reporte de Zonas de Encuentro
                </a>&nbsp;&nbsp;&nbsp;&nbsp;
                
                <a href="{{ route('rseguro.index') }}" class="btn btn-outline-success">
                    <i class="fa fa-list"></i> Reporte de Zonas Seguras
                </a>&nbsp;&nbsp;&nbsp;&nbsp;
                
            </div>

            <!-- Tabla -->
            <div class="table-responsive">
                <table id="tablaxd" name="tablaxd" class="table table-hover table-striped table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>CAPACIDAD</th>
                            <!-- Coordenadas centrales -->
                            <th>LATITUD</th>
                            <th>LONGITUD</th>
                            <th>RESPONSABLE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rencuentro as $r)
                        <tr>
                            <td>{{ $r->id }}</td>
                            <td>{{ $r->nombre }}</td>
                            <td>{{ $r->capacidad }}</td>
                            <td>{{ number_format($r->latitud, 2) }}</td>
                            <td>{{ number_format($r->longitud, 2) }}</td>
                            <td>
                                @php
                                    $color = match($r->riesgo) {
                                        default => 'success'
                                    };
                                @endphp
                                <span class="badge bg-{{ $color }}">{{ $r->responsable }}</span>
                            </td>
                            <!-- <td>
                                <a href="{{ route('seguro.edit', $r->id) }}" class="btn btn-warning btn-sm mb-1">Editar</a>
                                <form action="{{ route('seguro.destroy', $r->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar esta zona?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td> -->
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
    const MAPBOX_TOKEN = 'pk.eyJ1IjoidmludGFpbHN6IiwiYSI6ImNtY3MzajdkMTB0MngyanEyc2o5bjAwOHEifQ.FkEeSTHc8LB9ws0_jaQ6FA';

    let table = $('#tablaxd').DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
    });

    $('#btn-excel').on('click', function () {
        table.button('.buttons-excel').trigger();
    });

    $('#btn-custom-pdf').on('click', async function () {
        const data = table.rows({ search: 'applied' }).data().toArray();

        const urlConsultaCompleta = 'https://gestionriesgossig.infinityfreeapp.com/rencuentro';

        const qrUrl = `https://quickchart.io/qr?text=${encodeURIComponent(urlConsultaCompleta)}&size=150`;
        const qrImage = await getBase64ImageFromURL(qrUrl).catch(() => null);

        const content = [];

        if (qrImage) {
            content.push(
                { text: 'Código QR para consulta completa', style: 'subheader', alignment: 'center' },
                { image: qrImage, width: 150, height: 150, alignment: 'center' },
                { text: '\n', margin: [0, 0, 0, 10] }
            );
        } else {
            content.push({ text: 'QR no disponible', alignment: 'center' });
        }

        // Tabla
        const body = [
            [
                { text: 'ID', style: 'tableHeader' },
                { text: 'Nombre', style: 'tableHeader' },
                { text: 'Capacidad', style: 'tableHeader' },
                { text: 'Responsable', style: 'tableHeader' },
                { text: 'Mapa', style: 'tableHeader' }
            ]
        ];

        for (const row of data) {
            const id = row[0];
            const nombre = row[1];
            const capacidad = row[2];
            const lat = parseFloat(row[3]);
            const lng = parseFloat(row[4]);
            const responsableHTML = row[5];
            const responsable = $('<div>').html(responsableHTML).text().trim();

            const mapUrl = `https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/pin-s+f00(${lng},${lat})/${lng},${lat},15/400x200?access_token=${MAPBOX_TOKEN}`;
            const mapImage = await getBase64ImageFromURL(mapUrl).catch(() => null);

            body.push([
                id,
                nombre,
                capacidad,
                responsable,
                mapImage ? { image: mapImage, width: 200, height: 100 } : 'No disponible'
            ]);
        }

        content.push({
            table: {
                widths: ['auto', 'auto', '*', 'auto', 200],
                body: body
            }
        });

        const docDefinition = {
            content: [
                { text: 'Listado de Puntos de Encuentro', style: 'header', alignment: 'center', margin: [0, 0, 0, 10] },
                ...content
            ],
            styles: {
                header: {
                    fontSize: 18,
                    bold: true
                },
                subheader: {
                    fontSize: 14,
                    margin: [0, 10, 0, 5],
                    bold: true
                },
                tableHeader: {
                    bold: true,
                    fontSize: 12,
                    color: 'black'
                }
            }
        };

        pdfMake.createPdf(docDefinition).download('puntos_encuentro.pdf');
    });

    function getBase64ImageFromURL(url) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.crossOrigin = 'anonymous';
            img.onload = function () {
                const canvas = document.createElement("canvas");
                canvas.width = this.width;
                canvas.height = this.height;
                const ctx = canvas.getContext("2d");
                ctx.drawImage(this, 0, 0);
                resolve(canvas.toDataURL("image/png"));
            };
            img.onerror = function () {
                reject("No se pudo cargar la imagen");
            };
            img.src = url;
        });
    }
});
</script>


@endsection
