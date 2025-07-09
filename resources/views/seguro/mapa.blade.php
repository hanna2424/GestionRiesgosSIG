@extends ('layout.app')

@section ('titulo')
Ver Zonas de Riesgo
@endsection

@section('contenido')
<br>
<h1>Mapa de Clientes</h1>
<br>
<div id="mapa-seguro" style="border:2px solid black;height:500px;width:100%;"></div>

<script type="text/javascript">

      function initMap(){
        //alert("mapa ok");
        var latitud_longitud= new google.maps.LatLng(-0.9374805,-78.6161327);
        var mapa=new google.maps.Map(
          document.getElementById('mapa-seguro'),
          {
            center:latitud_longitud,
            zoom:7,
            mapTypeId:google.maps.MapTypeId.ROADMAP
          }
        );  
        @foreach($riesgos as $mr)
            var coordenadaCliente= new google.maps.LatLng({{$mr->latitud}},{{$mr->longitud}});
            var marcador=new google.maps.Marker({
                position:coordenadaCliente,
                map:mapa,
                title:"{{$mr->nombre}} {{$mr->seguridad}}",
                draggable:false
            });   
        @endforeach
      }
</script>   
@endsection