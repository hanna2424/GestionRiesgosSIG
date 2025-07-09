@extends('layout.app')

@section('titulo')
Nuevo Punto de Encuentro
@endsection

@section('contenido')

<br><br><br>
<center>
    <h3><b>Registrar Punto de Encuentro</b></h3><br><br><hr>
</center>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <br>
        <form action="{{ route('encuentro.update', $encuentro->id) }}" id="frm_val" method="post" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label><b>Nombre del Punto de encuentro</b></label>
                    <input type="text" name="nombre" class="form-control" value="{{ $encuentro->nombre }}" placeholder="Nombre del punto de encuentro" required><br>
                    <label><b>Capacidad</b></label>
                    <input type="number" name="capacidad" class="form-control" value="{{ $encuentro->capacidad }}" placeholder="Ingrese la capacidad del punto" required><br>
                    <label><b>Responsable</b></label>
                    <input type="text" name="responsable" class="form-control" value="{{ $encuentro->responsable }}" placeholder="Ingrese el responsable del punto" required><br>


                    <center>
                        <button class="btn btn-success">Guardar</button>
                        &nbsp;&nbsp;&nbsp;
                        <a href="{{ url('/listado1/') }}" class="btn btn-danger">cancelar</a>

                    </center>
                </div>
                <div class="col-md-6">
                    <div id="mapa-poligono" style="height: 400px; width: 100%; border: 2px solid blue;"></div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label><b>Latitud</b></label>
                            <input type="number" step="any" value="{{ $encuentro->latitud }}" name="latitud" id="latitud" class="form-control" readonly required>
                        </div>
                        <div class="col-md-6">
                            <label><b>Longitud</b></label>
                            <input type="number" step="any" value="{{ $encuentro->latitud }}" name="longitud" id="longitud" class="form-control" readonly required>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </form>
    </div>
    <div class="col-md-1"></div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.21.0/dist/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $('#frm_val').validate({
            rules: {
                nombre: { required: true, minlength: 3 },
                capacidad: { required: true, number: true, min: 1, max: 200 },
                responsable: { required: true, minlength: 3 },
                latitud: { required: true },
                longitud: { required: true }
            },
            messages: {
                nombre: {
                    required: "El nombre es obligatorio",
                    minlength: "Debe tener al menos 3 caracteres"
                },
                capacidad: {
                    required: "La capacidad es obligatoria",
                    number: "Debe ser un número válido",
                    min: "Debe ser mayor que 0",
                    max: "No puede ser mayor a 200"
                },
                responsable: {
                    required: "El responsable es obligatorio",
                    minlength: "Debe tener al menos 3 caracteres"
                },
                latitud: {
                    required: "Debe seleccionar una ubicación en el mapa"
                },
                longitud: {
                    required: "Debe seleccionar una ubicación en el mapa"
                }
            },
            errorPlacement: function(error, element) {
            },
            highlight: function(element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            invalidHandler: function(event, validator) {
                let errors = validator.numberOfInvalids();
                if (errors) {
                    let message = "Por favor corrija los siguientes errores:\n";
                    $.each(validator.errorList, function(index, error) {
                        message += " - " + error.message + "\n";
                    });
                    Toast.fire({
                        icon: 'warning',
                        title: message
                    });
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>

<script>
    let mapa;
    let marcadores = [];

    function initMap() {
        const centro = { lat: -0.9374805, lng: -78.6161327 };
        mapaPoligono = new google.maps.Map(document.getElementById('mapa-poligono'), {
            zoom: 15,
            center: centro,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

            const marcador = new google.maps.Marker({
                position: centro,
                map: mapaPoligono,
                draggable: true,
                title: 'Fijar Punto de Encuentro'
            });

            marcador.addListener('dragend', function() {
                const pos = this.getPosition();
                document.getElementById('latitud').value = pos.lat();
                document.getElementById('longitud').value = pos.lng();
            });

            marcadores.push(marcador);
    }

</script>