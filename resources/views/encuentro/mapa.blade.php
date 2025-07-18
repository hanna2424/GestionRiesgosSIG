@extends ('layout.app')

@section ('titulo')
Ver Puntos de Encuentro
@endsection

@section('contenido')

<div class="form-group">
    <label for="filtroCapacidad">Filtrar por Capacidad:</label>
    <select id="filtroCapacidad" class="form-control" style="width: 300px;">
        <option value="todos" selected>--- Mostrar Todos ---</option>
        <option value="10-500">10 a 500</option>
        <option value="501-5000">501 a 5000</option>
        <option value="9999+">9999 o más</option>
    </select>
</div>

<br>
<h1>Mapa de Puntos de Encuentro</h1>
<br>
<div id="mapa-riesgos" style="border:2px solid black;height:500px;width:100%;"></div>

<script>
    let mapa;
    let marcadores = [];

    function initMap() {
        const centro = new google.maps.LatLng(-0.9374805, -78.6161327);
        mapa = new google.maps.Map(document.getElementById('mapa-riesgos'), {
            center: centro,
            zoom: 15,
        });

        const infoWindow = new google.maps.InfoWindow();

        @foreach($encuentro as $punto)
        (function() {
            const posicion = new google.maps.LatLng({{ $punto->latitud }}, {{ $punto->longitud }});
            const marcador = new google.maps.Marker({
                position: posicion,
                map: mapa,
                title: "{{ $punto->nombre }}",
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

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('filtroCapacidad').addEventListener('change', function () {
            const valor = this.value;

            marcadores.forEach(marcador => {
                const capacidad = Number(marcador.capacidad);
                let mostrar = false;

                if (valor === 'todos') {
                    mostrar = true;
                } else if (valor === '10-500' && capacidad >= 10 && capacidad <= 500) {
                    mostrar = true;
                } else if (valor === '501-5000' && capacidad >= 501 && capacidad <= 5000) {
                    mostrar = true;
                } else if (valor === '9999+' && capacidad >= 9999) {
                    mostrar = true;
                }

                marcador.setMap(mostrar ? mapa : null);
            });
        });
    });

    window.initMap = initMap;
</script>

@endsection