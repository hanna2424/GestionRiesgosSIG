<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

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
  
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh; background-image: url('https://www.gestionderiesgos.gob.ec/wp-content/uploads/2024/01/OXAZ8129.jpg'); ">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow">
          <div class="card-body">

            <!-- Imagen centrada y redonda -->
            <div class="text-center mb-3">
              <img src="https://www.ongproteccioncivil.cl/wp-content/uploads/2021/06/logo-gestion-de-riesgos-1024x1024.png"
                  alt="img_logo"
                  class="rounded-circle login-logo mb-3">
              
              <!-- Redes sociales -->
              <div class="d-flex justify-content-center gap-3">
                <a href="#"><i class="bi bi-twitter-x fs-4"></i></a>
                <a href="#"><i class="bi bi-facebook fs-4"></i></a>
                <a href="#"><i class="bi bi-instagram fs-4"></i></a>
                <a href="#"><i class="bi bi-linkedin fs-4"></i></a>
              </div>
            </div>

            <h3 class="text-center mb-4">Iniciar Sesión</h3>

            <form action="{{ route('login.store') }}" method="POST" autocomplete="off">
              @csrf
              <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" name="username" id="username" class="form-control" autocomplete="off" required>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" autocomplete="new-password" required>
              </div>

              <div class="mb-3 text-center">
                <a href="/inicio/">¿No tienes cuenta? Ingresa como invitado</a>
              </div>

              <button type="submit" class="btn btn-primary w-100">Ingresar</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.querySelector('form');
      
      form.addEventListener('submit', function () {
        setTimeout(() => {
          document.getElementById('username').value = '';
          document.getElementById('password').value = '';
        }, 100);
      });
    });
  </script>


  <!-- Vendor JS Files -->
   
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      @if(session('error'))
        Toast.fire({
          icon: 'error',
          title: '{{ session('error') }}'
        });
      @elseif(session('success'))
        Toast.fire({
          icon: 'success',
          title: '{{ session('success') }}'
        });
      @elseif(session('warning'))
        Toast.fire({
          icon: 'warning',
          title: '{{ session('warning') }}'
        });
      @elseif(session('info'))
        Toast.fire({
          icon: 'info',
          title: '{{ session('info') }}'
        });
      @endif
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('assets/scripts/Toast.js') }}"></script>
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
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
