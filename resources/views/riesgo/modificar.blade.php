@extends('layout.app')

@section('titulo')
Modificar Zona de Riesgo
@endsection

@section('contenido')

<br><br><br>
<center>
    <h3><b>Modificar Zona de Riesgo</b></h3><br><br><hr>
</center>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <br>
        <form action="{{ route('riesgo.update', $riesgo->id) }}" id="frm_val" method="post" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label><b>Nombre de la Zona</b></label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $riesgo->nombre }}" placeholder="Nombre de la zona de riesgo" required><br>
                    <label><b>Descripcion</b></label>
                    <textarea name="descripcion"  id="descripcion" class="form-control" rows="3" placeholder="Ingrese la descripcion de la zona" required>{{ $riesgo->descripcion }}</textarea><br>
                    <label><b>Nivel de Riesgo</b></label>
                    <select class="form-control" id="riesgo" name="riesgo" required>
                        <option value="" disabled selected>-----Seleccione------</option>
                        <option value="Riesgo Alto" {{ $riesgo->riesgo == 'Riesgo Alto' ? 'selected' : '' }} >Riesgo Alto</option>
                        <option value="Riesgo Medio" {{ $riesgo->riesgo == 'Riesgo Medio' ? 'selected' : '' }}>Riesgo Medio</option>
                        <option value="Riesgo Bajo" {{ $riesgo->riesgo == 'Riesgo Bajo' ? 'selected' : '' }}>Riesgo Bajo</option>
                    </select><br><br><br>

                    <center>
                        <button class="btn btn-success">Guardar</button>
                        &nbsp;&nbsp;&nbsp;
                        <a href="{{ url('/listado/') }}" class="btn btn-danger">cancelar</a>

                    </center>
                </div>
                <div class="col-md-6">
                    <div id="mapa-poligono" style="height: 400px; width: 100%; border: 2px solid blue;"></div><br>
                    <div class="row">
                        @for ($i = 1; $i <= 4; $i++)
                        <div class="col-md-6">
                            <label><b>Latitud {{ $i }}</b></label>
                            <input type="number" step="any" name="latitud{{ $i }}" id="latitud{{ $i }}" class="form-control" readonly value="{{ $riesgo->{'latitud'.$i} }}">
                        </div>
                        <div class="col-md-6">
                            <label><b>Longitud {{ $i }}</b></label>
                            <input type="number" step="any" name="longitud{{ $i }}" id="longitud{{ $i }}" class="form-control" readonly value="{{ $riesgo->{'longitud'.$i} }}">
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
            <br>
        </form>
    </div>
    <div class="col-md-1"></div>
</div>

<!-- jquery validator -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.21.0/dist/jquery.validate.min.js"></script>
<!-- Validación y Toast -->
<script>
$(document).ready(function() {
    $('#frm_val').validate({
        rules: {
            nombre: { required: true, minlength: 3 },
            descripcion: { required: true, minlength: 5 },
            riesgo: { required: true },
            latitud1: { required: true },
            longitud1: { required: true },
            latitud2: { required: true },
            longitud2: { required: true },
            latitud3: { required: true },
            longitud3: { required: true },
            latitud4: { required: true },
            longitud4: { required: true }
        },
        messages: {
            nombre: {
                required: "El nombre es obligatorio",
                minlength: "Debe tener al menos 3 caracteres"
            },
            descripcion: {
                required: "La descripción es obligatoria",
                minlength: "Debe tener al menos 5 caracteres"
            },
            riesgo: {
                required: "Seleccione un nivel de riesgo"
            },
            latitud1: { required: "Mueva el marcador 1 en el mapa" },
            longitud1: { required: "Mueva el marcador 1 en el mapa" },
            latitud2: { required: "Mueva el marcador 2 en el mapa" },
            longitud2: { required: "Mueva el marcador 2 en el mapa" },
            latitud3: { required: "Mueva el marcador 3 en el mapa" },
            longitud3: { required: "Mueva el marcador 3 en el mapa" },
            latitud4: { required: "Mueva el marcador 4 en el mapa" },
            longitud4: { required: "Mueva el marcador 4 en el mapa" }
        },
        errorPlacement: function(error, element) {
            error.addClass('text-danger');
            error.insertAfter(element);
        },
        highlight: function(element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        },
        invalidHandler: function(event, validator) {
            if (validator.numberOfInvalids()) {
                Toast.fire({
                    icon: 'warning',
                    title: 'Por favor complete correctamente los campos marcados.'
                });
            }
        }
    });
});
</script>


<script>
    let mapaPoligono;
    let marcadores = [];
    let poligono;

    function initMap() {
        const centro = { lat: -0.9374805, lng: -78.6161327 };
        mapaPoligono = new google.maps.Map(document.getElementById('mapa-poligono'), {
            zoom: 15,
            center: centro,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        for (let i = 1; i <= 4; i++) {
            const lat = parseFloat(document.getElementById(`latitud${i}`).value) || centro.lat;
            const lng = parseFloat(document.getElementById(`longitud${i}`).value) || centro.lng;

            const marcador = new google.maps.Marker({
                position: { lat, lng },
                map: mapaPoligono,
                draggable: true,
                title: `Punto ${i}`
            });

            marcador.addListener('dragend', function () {
                const pos = this.getPosition();
                document.getElementById(`latitud${i}`).value = pos.lat();
                document.getElementById(`longitud${i}`).value = pos.lng();
                dibujarPoligono();
            });

            marcadores.push(marcador);
        }

        dibujarPoligono();
    }

    function dibujarPoligono() {
        if (poligono) poligono.setMap(null);

        const coordenadas = marcadores.map(m => m.getPosition());

        const riesgo = document.getElementById('riesgo').value;
        let color = "#00FF00"; 

        if (riesgo === "Riesgo Alto") color = "#FF0000";
        else if (riesgo === "Riesgo Medio") color = "#FFFF00";

        poligono = new google.maps.Polygon({
            paths: coordenadas,
            strokeColor: "#000000",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: color,
            fillOpacity: 0.35,
        });

        poligono.setMap(mapaPoligono);
    }

    document.getElementById('riesgo').addEventListener('change', dibujarPoligono);
</script>
