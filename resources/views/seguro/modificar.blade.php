@extends('layout.app')

@section('titulo')
Modificar Zona Segura
@endsection

@section('contenido')

<br><br><br>
<center>
    <h3><b>Modificar Zona Segura</b></h3><br><br><hr>
</center>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <br>
        <form action="{{ route('seguro.update', $seguro->id) }}" id="frm_val" method="post" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label><b>Nombre de la Zona Segura</b></label>
                    <input type="text" name="nombre" class="form-control" id="nombre" value="{{ $seguro->nombre }}" placeholder="Nombre de la zona segura" required><br>
                    <label><b>Tipo de Seguridad</b></label>
                    <select class="form-control" id="seguridad" name="seguridad" required>
                        <option value="" disabled selected>-----Seleccione------</option>
                        <option value="Seguridad Alta" {{ $seguro->seguridad == 'Seguridad Alta' ? 'selected' : '' }} >Seguridad Alta</option>
                        <option value="Seguridad Media" {{ $seguro->seguridad == 'Seguridad Media' ? 'selected' : '' }} >Seguridad Media</option>
                        <option value="Seguridad Baja" {{ $seguro->seguridad == 'Seguridad Baja' ? 'selected' : '' }} >Seguridad Baja</option>
                    </select><br><br><br>
                    <label><b>Radio</b></label>
                    <input type="number" name="radio" id="radio" class="form-control" value="{{ $seguro->radio }}" placeholder="Ingrese el radio de la zona" required><br>
                    <center>
                        <button class="btn btn-success">Guardar</button>
                        &nbsp;&nbsp;&nbsp;
                        <a href="{{ url('/listado2/') }}" class="btn btn-danger">cancelar</a>

                    </center>
                </div>
                <div class="col-md-6">
                    <div id="mapa-poligono" style="height: 400px; width: 100%; border: 2px solid blue;"></div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label><b>Latitud</b></label>
                            <input type="number" step="any" name="latitud" id="latitud" class="form-control" readonly required>
                        </div>
                        <div class="col-md-6">
                            <label><b>Longitud</b></label>
                            <input type="number" step="any" name="longitud" id="longitud" class="form-control" readonly required>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </form>
    </div>
    <div class="col-md-1"></div>
</div>

<!-- jQuery & Validator -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.21.0/dist/jquery.validate.min.js"></script>


<script type="text/javascript">
    let mapaPoligono;
    let marcador;
    let circulo;

    function initMap() {
        const centro = new google.maps.LatLng(-0.9374805, -78.6161327);
        mapaPoligono = new google.maps.Map(document.getElementById('mapa-poligono'), {
            zoom: 15,
            center: centro,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        marcador = new google.maps.Marker({
            position: centro,
            map: mapaPoligono,
            title: "Seleccione la ubicación",
            draggable: true
        });

        document.getElementById("latitud").value = centro.lat();
        document.getElementById("longitud").value = centro.lng();

        google.maps.event.addListener(marcador, 'dragend', function () {
            const pos = this.getPosition();
            document.getElementById("latitud").value = pos.lat();
            document.getElementById("longitud").value = pos.lng();
            dibujarCirculo();
        });

        document.querySelector('input[name="radio"]').addEventListener('input', dibujarCirculo);
        document.querySelector('select[name="seguridad"]').addEventListener('change', dibujarCirculo);

        dibujarCirculo(); 
    }

    function dibujarCirculo() {
        const radio = parseFloat(document.querySelector('input[name="radio"]').value);
        const lat = parseFloat(document.getElementById("latitud").value);
        const lng = parseFloat(document.getElementById("longitud").value);
        const tipoSeguridad = document.querySelector('select[name="seguridad"]').value;

        if (isNaN(radio) || isNaN(lat) || isNaN(lng) || !tipoSeguridad) return;

        let color = "#28a745";
        if (tipoSeguridad === "Seguridad Media") color = "#ffc107";
        else if (tipoSeguridad === "Seguridad Baja") color = "#dc3545";

        const centro = new google.maps.LatLng(lat, lng);

        if (circulo) {
            circulo.setMap(null);
        }

        circulo = new google.maps.Circle({
            center: centro,
            radius: radio,
            map: mapaPoligono,
            strokeColor: color,
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: color,
            fillOpacity: 0.35
        });

        mapaPoligono.panTo(centro);
    }
</script>

