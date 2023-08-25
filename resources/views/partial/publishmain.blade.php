
    
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>E-Form | @yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="referrer" content="origin-when-cross-origin" />

  <!-- Favicons -->
  <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
   <!-- Add Font Awesome CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/daterangepicker/daterangepicker.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  <style>
    /* Add some basic styling */
    #map {
        width: 100%;
        height: 400px;
        margin-top: 20px;
    }
</style>


  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body id="main-body">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="#" class="logo d-flex align-items-center">
        <img src="{{asset('images/Artboard-5.png')}}" class="img-fluid">
        <span style="color: white; margin-top: 10px" class="d-none d-lg-block">E-Form</span>
      </a>
      

      
    </div><!-- End Logo -->
    <nav class="header-nav ms-auto">
      <!-- Add the Copy Link button -->
<div class="col d-flex justify-content-center p-3">
  <a href="https://hairtricandlashility.com/" class="btn btn-warning m-2" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Our Website"><i class="bi bi-browser-chrome"></i></a>
 <a href="https://www.facebook.com/thehairtricandlashility?mibextid=ZbWKwL" target="_blank" class="btn btn-primary m-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook"><i class="bi bi-facebook"></i></a>
 <a href="#" class="btn btn-success m-2" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Whatsapp"><i class="bi bi-whatsapp"></i></a>
 <a href="https://www.tiktok.com/@thehairtricandlashility?_t=8f7gWWAEgk5&_r=1" class="btn btn-dark m-2" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="TikTok"><i class="bi bi-tiktok"></i></a>
 <a href="https://instagram.com/hairtricandlashility_academy?igshid=MzRlODBiNWFlZA==" style="background-color: pink" class="btn btn-primary m-2" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Instagram"><i class="bi bi-instagram"></i></a>
</div>
    </nav>
  </header><!-- End Header -->

  <main style="margin-top: 90px">

   

    @yield('content')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      
    </div>
    <div class="credits">
      
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  
<!-- Vendor JS Files -->
<script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/vendor/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/vendor/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="{{asset('assets/vendor/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>



  

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
  <script src="{{asset('assets/js/submit.js')}}"></script>
  <script src="{{asset('assets/js/tempSubmit.js')}}"></script>
  <script src="{{asset('assets/js/tempSecSubmit.js')}}"></script>
  
  <!-- Add the initialization script -->
  <script>
    $(document).ready(function() {
      $(".star-rating i").hover(function() {
        $(this).addClass("hovered");
        $(this).prevAll().addClass("hovered");
      }, function() {
        $(this).removeClass("hovered");
        $(this).prevAll().removeClass("hovered");
      });

      $(".star-rating i").click(function() {
        var rating = $(this).data("rating");
        $("#rating-value").val(rating);
        $(this).addClass("selected");
        $(this).prevAll().addClass("selected");
        $(this).nextAll().removeClass("selected");
      });
    });
  </script>

  <script>
    //Date range picker with time picker
    $('#reservationdatetime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
  </script>
</body>

</html>

