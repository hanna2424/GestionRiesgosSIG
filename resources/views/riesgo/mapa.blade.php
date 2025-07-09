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

      function initMap(){
        //alert("mapa ok");
        var latitud_longitud= new google.maps.LatLng(-0.9374805,-78.6161327);
        var mapa=new google.maps.Map(
          document.getElementById('mapa-riesgos'),
          {
            center:latitud_longitud,
            zoom:7,
            mapTypeId:google.maps.MapTypeId.ROADMAP
          }
        );
        @foreach($riesgo as $mr)
            var coordenadaCliente= new google.maps.LatLng({{$mr->latitud1}},{{$mr->longitud1}},{{$mr->latitud2}},{{$mr->longitud2}},{{$mr->latitud3}},{{$mr->longitud3}},{{$mr->latitud4}},{{$mr->longitud4}});
            var marcador=new google.maps.Marker({
                position:coordenadaCliente,
                map:mapa,
                title:"{{$mr->nombre}} {{$mr->riesgo}}",
                draggable:false
            });
        @endforeach
        
      }
</script>
@endsection