@extends('layout.app')

@section ('titulo')
Ver Zonas Seguras
@endsection

@section('contenido')


<div class="form-group">
    <label for="filtroSeguridad">Filtrar por Nivel de Seguridad:</label>
    <select id="filtroSeguridad" class="form-control" style="width: 300px;">
        <option value="todos" selected>---Mostrar Todos---</option>
        <option value="Seguridad Alta">Seguridad Alta</option>
        <option value="Seguridad Media">Seguridad Media</option>
        <option value="Seguridad Baja">Seguridad Baja</option>
    </select>
</div>
<br>

<h1>Mapa de Zonas Seguras</h1>
<br>
<div id="mapa-seguro" style="border:2px solid black;height:500px;width:100%;"></div>

<script type="text/javascript">
    let mapa;
    let circulos = [];

    function initMap() {
        const centro = new google.maps.LatLng(-0.9374805,-78.6161327);
        mapa = new google.maps.Map(document.getElementById('mapa-seguro'), {
            center: centro,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        @foreach($seguro as $sm)
          (function() {
            const posicion = new google.maps.LatLng({{ $sm->latitud }}, {{ $sm->longitud }});
            let color = '#28a745';

            if ("{{ $sm->seguridad }}" === "Seguridad Media") color = "#ffc107";
            else if ("{{ $sm->seguridad }}" === "Seguridad Baja") color = "#dc3545";

            const circulo = new google.maps.Circle({
                center: posicion,
                radius: {{ $sm->radio }},
                map: mapa,
                strokeColor: color,
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: color,
                fillOpacity: 0.35,
                title:"{{$sm->nombre}} {{$sm->seguridad}}"
            });

            circulo.nivelSeguridad = "{{ $sm->seguridad }}";
            circulos.push(circulo);

            google.maps.event.addListener(circulo, 'click', function (e) {
                infoWindow.setContent("<b>{{ $sm->nombre }}</b><br>{{ $sm->seguridad }}<br>Radio: {{ $sm->radio }} m"
          })();
        @endforeach
    }

    window.initMap = initMap;

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('filtroSeguridad').addEventListener('change', function () {
            const valorSeleccionado = this.value;

            circulos.forEach(circulo => {
                if (valorSeleccionado === 'todos' || circulo.nivelSeguridad === valorSeleccionado) {
                    circulo.setMap(mapa);
                } else {
                    circulo.setMap(null);
                }
            });
        });
    });
</script>
@endsection