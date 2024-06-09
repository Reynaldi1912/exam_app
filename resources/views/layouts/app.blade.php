<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/niceadmin/assets/img/favicon.png" rel="icon">
  <link href="/niceadmin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/niceadmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <style>
    .alert-absolute {
        position: fixed;
        bottom: 20px; /* Sesuaikan jarak dari bawah sesuai kebutuhan */
        right: 20px; /* Sesuaikan jarak dari kanan sesuai kebutuhan */
        z-index: 9999; /* Pastikan nilai z-index lebih tinggi dari elemen lain */
        width: auto; /* Sesuaikan lebar sesuai kebutuhan */
    }
</style>
  <!-- Template Main CSS File -->
  <link href="/niceadmin/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
@if (session('success'))
        <div class="alert alert-success alert-dismissible fade show alert-absolute" role="alert" id="autoDismissAlert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('danger'))
        <div class="alert alert-danger alert-dismissible fade show alert-absolute" role="alert" id="autoDismissAlert">
            {{ session('danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


  @include('layouts.header')

  @include('layouts.sidebar')

  <main id="main" class="main">
    @yield('content')
  </main><!-- End #main -->
  @include('layouts.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script>
    // Tunggu hingga halaman selesai dimuat
    document.addEventListener('DOMContentLoaded', (event) => {
        // Temukan elemen alert
        const alert = document.getElementById('autoDismissAlert');
        
        // Setel timeout untuk menghapus alert setelah 5 detik
        setTimeout(() => {
            alert.classList.remove('show');
        }, 5000);
    });
</script>
  <!-- Vendor JS Files -->
  <script src="/niceadmin/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/niceadmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/niceadmin/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="/niceadmin/assets/vendor/echarts/echarts.min.js"></script>
  <script src="/niceadmin/assets/vendor/quill/quill.js"></script>
  <script src="/niceadmin/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/niceadmin/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="/niceadmin/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/niceadmin/assets/js/main.js"></script>

</body>

</html>