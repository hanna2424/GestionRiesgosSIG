@extends ('layout.app')

@section ('titulo')
Ver Zonas de Riesgo
@endsection

@section('contenido')


<div class="form-group">
    <label for="filtroRiesgo">Filtrar por Nivel de Riesgo:</label>
    <select id="filtroRiesgo" class="form-control" style="width: 300px;">
        <option value="todos">Mostrar Todos</option>
        <option value="Riesgo Alto">Riesgo Alto</option>
        <option value="Riesgo Medio">Riesgo Medio</option>
        <option value="Riesgo Bajo">Riesgo Bajo</option>
    </select>
</div>
<br>


<br>
<h1>Mapa de Clientes</h1>
<br>
<div id="mapa-riesgos" style="border:2px solid black;height:500px;width:100%;"></div>

<script type="text/javascript">
    let mapa = [];

    function initMap() {
        const centroEcuador = new google.maps.LatLng(-1.8312, -78.1834);
        mapa = new google.maps.Map(document.getElementById('mapa-riesgos'), {
            center: centroEcuador,
            zoom: 7,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        @foreach($riesgo as $mr)
            const coordenadas = [
                { lat: {{$mr->latitud1}}, lng: {{$mr->longitud1}} },
                { lat: {{$mr->latitud2}}, lng: {{$mr->longitud2}} },
                { lat: {{$mr->latitud3}}, lng: {{$mr->longitud3}} },
                { lat: {{$mr->latitud4}}, lng: {{$mr->longitud4}} }
            ];

            let color = '#00FF00';
            if ("{{$mr->riesgo}}" === "Riesgo Medio") color = '#FFFF00';
            if ("{{$mr->riesgo}}" === "Riesgo Alto") color = '#FF0000';

            const poligono = new google.maps.Polygon({
                paths: coordenadas,
                strokeColor: '#000000',
                strokeOpacity: 0.8,
                strokeWeight: 1,
                fillColor: color,
                fillOpacity: 0.35,
                map: mapa
            });

            // Guardar polígono y categoría
            poligono.nivelRiesgo = "{{$mr->riesgo}}";
            zonas.push(poligono);
        @endforeach
    }

</script>
@endsection