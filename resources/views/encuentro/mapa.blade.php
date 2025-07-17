@extends ('layout.app')

@section ('titulo')
Ver Puntos de Encuentro
@endsection

@section('contenido')

<div class="form-group">
    <label for="filtroCapacidad">Filtrar por Capacidad:</label>
    <select id="filtroCapacidad" class="form-control" style="width: 300px;">
        <option value="todos" selected>--- Mostrar Todos ---</option>
        <option value="10-100">10 a 100</option>
        <option value="101-200">101 a 200</option>
        <option value="201+">201 o más</option>
    </select>
</div>

<br>
<h1>Mapa de Puntos de Encuentro</h1>
<br>
<div id="mapa-riesgos" style="border:2px solid black;height:500px;width:100%;"></div>

<script type="text/javascript">
    let mapa;
    let marcadores = [];

    function initMap() {
        const centro = new google.maps.LatLng(-0.9374805, -78.6161327);
        mapa = new google.maps.Map(document.getElementById('mapa-riesgos'), {
            center: centro,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        const infoWindow = new google.maps.InfoWindow();

        @foreach($encuentro as $punto)
        (function() {
            const posicion = new google.maps.LatLng({{ $punto->latitud }}, {{ $punto->longitud }});
            const marcador = new google.maps.Marker({
                position: posicion,
                map: mapa,
                title: "{{ $punto->nombre }}",
                draggable: false
            });

            marcador.capacidad = {{ $punto->capacidad }};

            marcador.addListener('click', function () {
                infoWindow.setContent(`
                    <b>{{ $punto->nombre }}</b><br>
                    Responsable: {{ $punto->responsable }}<br>
                    Capacidad: {{ $punto->capacidad }}
                `);
                infoWindow.open(mapa, marcador);
            });

            marcadores.push(marcador);
        })();
        @endforeach
    }

    window.initMap = initMap;

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('filtroCapacidad').addEventListener('change', function () {
            const valor = this.value;

            marcadores.forEach(marcador => {
                let mostrar = false;
                const capacidad = marcador.capacidad;

                if (valor === 'todos') {
                    mostrar = true;
                } else if (valor === '10-100' && capacidad >= 10 && capacidad <= 100) {
                    mostrar = true;
                } else if (valor === '101-200' && capacidad >= 101 && capacidad <= 200) {
                    mostrar = true;
                } else if (valor === '201+' && capacidad >= 201) {
                    mostrar = true;
                }

                marcador.setMap(mostrar ? mapa : null);
            });
        });
    });
</script>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> d8dad7ca5a6828515ee92c1c7279c43159e91ff4
