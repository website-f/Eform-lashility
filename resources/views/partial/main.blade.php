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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPyDbSSao5JOxiTLETXEU7neCpLqpxiwE&libraries=places"></script>
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
  <link href="{{asset('assets/vendor/select2/css/select2.min.css')}}" rel="stylesheet">
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

<body>

  <!-- ======= Header =======
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/"  class="logo d-flex align-items-center">

        <span style="color: white" class="d-none d-lg-block">E-Form</span>
      </a>
      <i style="color: white" class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center p-3">
       @guest
       <a style="color: white" class="btn btn-primary" href="/login">Sign In</a>
       @endguest
      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">
    @auth
    <div class="d-flex align-items-center justify-content-center">
      <img src="{{asset('images/Artboard-5.png')}}" alt="" class="img-fluid" width="200px" height="300px">

    </div><br>
    <div class="d-flex align-items-center justify-content-center">
      <a style="background-color: #FB1363; color: white;" href="/form-builder" class="btn btn-lg btn-block">Create Form</a>
    </div><br><br>
    @endauth


    <li class="nav-item">
      <a class="nav-link {{ Request::is('/') ? ' ' : 'collapsed' }}" href="/">
        <i class="bi bi-house-fill"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('/report') ? ' ' : 'collapsed' }}" href="/report">
        <i class="bi bi-clipboard-data"></i>
        <span>Report</span>
      </a>
    </li><!-- End Dashboard Nav -->


   @auth


  <li class="nav-item">
    <a class="nav-link {{ Request::is('ready-forms') ? ' ' : 'collapsed' }}" href="/ready-forms">
      <i class="bi bi-ui-checks"></i>
      <span>Ready Made Forms</span>
    </a>
  </li><!-- End Dashboard Nav --> <li class="nav-item">

    <li class="nav-item">
      <a class="nav-link {{ Request::is('forms') ? ' ' : 'collapsed' }}" href="/forms">
        <i class="bi bi-journal-text"></i>
        <span>All Forms</span>
      </a>
    </li><!-- End Dashboard Nav --> <li class="nav-item">
      <a class="nav-link {{ Request::is("myforms/" . Auth::user()->id) ? ' ' : 'collapsed' }}" href="/myforms/{{Auth::user()->id}}">
        <i class="bi bi-journal-text"></i>
        <span>My Forms</span>
      </a>
    </li><!-- End Dashboard Nav --> <li class="nav-item">
      <a class="nav-link {{ Request::is('submitted') ? ' ' : 'collapsed' }}" href="/submitted">
        <i class="bi bi-journal-text"></i>
        <span>Submitted Forms</span>
      </a>
    </li><!-- End Dashboard Nav -->
    <!--<li class="nav-item">
      <a class="nav-link {{ Request::is('/template') ? ' ' : 'collapsed' }}" href="/template">
        <i class="bi bi-pencil-square"></i>
        <span>Template</span>
      </a>
     </li> End Dashboard Nav -->
     @if (Auth::user()->role->role == 'SuperAdmin' || Auth::user()->role->role == 'Admin')
     <li class="nav-item">
      <a class="nav-link {{ Request::is('users') ? ' ' : 'collapsed' }}" href="/users">
        <i class="bi bi-people-fill"></i>
        <span>Users</span>
      </a>
    </li><!-- End Dashboard Nav --> <li class="nav-item">
   @endif
     @if (Auth::user()->role->role == 'SuperAdmin')
     <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#trash-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-trash2-fill"></i><span>Recycle Bin</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="trash-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="/trash-form">
            <i class="bi bi-circle"></i><span>Deleted Forms</span>
          </a>
        </li>
        <li>
          <a href="/trash-submitted">
            <i class="bi bi-circle"></i><span>Deleted Submission</span>
          </a>
        </li>


      </ul>
    </li><!-- End Forms Nav -->
@endif
<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#profile" data-bs-toggle="collapse" href="#">
      <i class="bi bi-person-square"></i><span>Profile</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="profile" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
          <div class="d-flex align-items-center justify-content-center">
            @if (Auth::user()->image == null)
            <img src='{{asset("images/default.png")}}' alt="Profile" class="rounded-circle img-fluid" width="100" height="200">
            @else
            <img src='{{Auth::user()->image}}' alt="Profile" class="rounded-circle">
            @endif

          </div>
          <p class="text-center">{{Auth::user()->name}}</p>
      </li>
      <li>
          <a href="/profile/{{Auth::user()->id}}">
              <i class="bi bi-circle"></i><span>My profile</span>
          </a>
      </li>
      <li>
          <a href="/logout">
              <i class="bi bi-circle"></i><span>Logout</span>
          </a>
      </li>
  </ul>
</li>
<li class="nav-item">
  <a class="nav-link {{ Request::is('/guideline') ? ' ' : 'collapsed' }}" href="/guideline">
    <i class="bi bi-mortarboard-fill"></i>
    <span>Guidelines</span>
  </a>
</li>
   @endauth
  </ul>

</aside><!-- End Sidebar-->

  <main id="main" class="main">
    <div class="card desktop-only">
      <div class="p-3 d-flex justify-content-start align-items-center">
          <div>
              <!-- Content aligned to the left (e.g., nav) -->
              <i style="font-size: 30px" class="bi bi-list toggle-sidebar-btn"></i>
          </div>
          <div class="flex-grow-1 text-center">
              <!-- Centered content here -->
              <img src="{{asset('images/Artboard-5.png')}}" alt="" class="img-fluid" width="200px" height="300px">
          </div>
      </div>
  </div>




    <div class="pagetitle">
        <h1>@yield('title')</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->

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
<script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
<script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
<script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
<script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>





  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>


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

<script>
  function exportToPDF() {
    const contentDiv = document.querySelector('.card-exportPDF');
    contentDiv.s

    if (!contentDiv) {
      alert('No content to export.');
      return;
    }

    // Convert the content to PDF using html2pdf
   const options = {
     margin: 10,
     filename: 'selected_data.pdf',
     image: { type: 'jpeg', quality: 0.98 },
     html2canvas: { scale: 2 },
     jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
     background: 'white', // Set the background color to white
   };

    // Convert the content to PDF using html2pdf
    html2pdf().from(contentDiv).set(options).save();
  }

  function exportReportToPDF() {
    const contentDiv = document.querySelector('.card-exportReportPDF');
    contentDiv.s

    if (!contentDiv) {
      alert('No content to export.');
      return;
    }

    // Convert the content to PDF using html2pdf
   const options = {
     margin: 5,
     filename: 'report.pdf',
     image: { type: 'jpeg', quality: 0.98 },
     html2canvas: { scale: 2 },
     jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
     background: 'white', // Set the background color to white
   };

    // Convert the content to PDF using html2pdf
    html2pdf().from(contentDiv).set(options).save();
  }
</script>
<script>
  $(function () {
      $('[data-bs-toggle="tooltip"]').tooltip();
  });
</script>
<script>
  $(document).ready(function() { 
    $("#e7").select2(); 

    $('#e7').on('change', function() {
                var selectedValues = $(this).val();
                $('#selectedValuesData').val(selectedValues);
            });
    });

    $(document).ready(function() { $("#e1").select2(); });
</script>

</body>

</html>
