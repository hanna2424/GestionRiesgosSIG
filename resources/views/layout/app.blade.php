<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('titulo')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- jquery validator -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.21.0/dist/jquery.validate.min.js"></script>
  
  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- DataTables Importacion -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

  <!-- FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.7.2/css/fontawesome.min.css" rel="stylesheet">
  
  <!-- Sweet Alert -->
  <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.min.css " rel="stylesheet">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

  <!-- importando la api de google maps --> 
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4QWwoWMmNZh56GuF5qKh3_zTCNjnvsU0&libraries=places&callback=initMap"></script>
</head>

<body class="index-page">
  <header id="header" class="header d-flex flex-column justify-content-center">
    <i class="header-toggle d-xl-none bi bi-list"></i>
    
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="{{ url('/menu') }}" class="active"><i class="bi bi-house navicon"></i><span>Inicio</span></a></li>
        <li class="dropdown"><a href="#" class="active"><i class="bi bi-pin-map-fill"></i> <span>Agregar Zona</span><i class="bi bi-chevron-up toggle-dropdown"></i></a>
          <ul>
            <li class="dropdown"><a href="{{ route('riesgo.create') }}" class="active"><i class="bi bi-exclamation-diamond"></i> <span>Riesgo</span></i></a>
            <li class="dropdown"><a href="{{ route('encuentro.create') }}" class="active"><i class="bi bi-pin-map-fill"></i> <span>Encuentro</span></a>
            <li class="dropdown"><a href="{{ route('seguro.create') }}"  class="active"><i class="bi bi-check-circle-fill"></i> <span>Seguras</span></a>
          </ul>
        </li>
        <li class="dropdown"><a href="#" class="active"><i class="bi bi-radar"></i> <span>Visualizar</span><i class="bi bi-chevron-up toggle-dropdown"></i></a>
          <ul>
            <li class="dropdown"><a href="#" class="active"><i class="bi bi-exclamation-diamond"></i> <span>Riesgo</span></i></a>
            <li class="dropdown"><a href="#" class="active"><i class="bi bi-pin-map-fill"></i> <span>Encuentro</span></a>
            <li class="dropdown"><a href="#" class="active"><i class="bi bi-check-circle-fill"></i> <span>Seguras</span></a>
          </ul>
        </li>
        <li><a href="{{ route('rriesgo.index') }}" class="active"><i class="bi bi-journal-check navicon"></i><span>Reporte</span></a></li>
        <li><a href="{{ url('/logout/') }}" class="active"><i class="bi bi-box-arrow-left navicon"></i><span>Cerrar Sesion</span></a></li>
      </ul>
    </nav>

  </header>

  <main class="main">
    
  <footer id="footer" class="footer position-relative light-background">
    <br><br><br><br><br>
    <div class="container">
      @yield('contenido')
    </div>
    <div class="container">
      <div class="container">
        <div class="copyright">
          <span>Copyright</span> <strong class="px-1 sitename">Alex Smith</strong> <span>All Rights Reserved</span>
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you've purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distribuited by <a href="https://themewagon.com">ThemeWagon</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.all.min.js"></script>
  <script src="{{ asset('assets/scripts/Toast.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      @if(session('error'))
        Toast.fire({ icon: 'error', title: '{{ session('error') }}' });
      @elseif(session('success'))
        Toast.fire({ icon: 'success', title: '{{ session('success') }}' });
      @elseif(session('warning'))
        Toast.fire({ icon: 'warning', title: '{{ session('warning') }}' });
      @elseif(session('info'))
        Toast.fire({ icon: 'info', title: '{{ session('info') }}' });
      @endif
    });
  </script>

  <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.all.min.js "></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/typed.js/typed.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.7.2/js/all.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>