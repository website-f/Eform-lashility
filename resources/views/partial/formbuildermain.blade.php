
    
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

<body id="main-body">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/" class="logo d-flex align-items-center">
        
        <span style="color: white" class="d-none d-lg-block">E-Form</span>
      </a>

      
      <i style="color: white" class="bi bi-list toggle-sidebar-btn"></i>


    </div><!-- End Logo -->
    

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            @if (Auth::user()->image == null)
            <img src="{{asset('images/default.png')}}" alt="Profile" class="rounded-circle">
            @else
            <img src="{{Auth::user()->image}}" alt="Profile" class="rounded-circle">
            @endif
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{Auth::user()->name}}</h6>
              <span>{{Auth::user()->email}}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/profile/{{Auth::user()->id}}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/forms">
                <i class="bi bi-file-text"></i>
                <span>All Forms</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/">
                <i class="bi bi-house-door-fill"></i>
                <span>Home</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
  <!-- ======= Header ======= -->
  <header id="header-second" class="header-second fixed-top d-flex align-items-center">

        <ul class="nav nav-tabs d-flex header-sec-navTab">
    
          <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#build">BUILD</button>
          </li>
    
         
          
          <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#publish">CREATE</button>
          </li>
    
        </ul>

    
  </header><!-- End Header -->
 

  <!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebarFormBuilder">

  <ul class="sidebar-nav" id="sidebar-nav">


    <!-- Bordered Tabs -->
    <ul class="nav nav-tabs  d-flex">

        <li class="nav-item">
          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#basics">Basics</button>
        </li>

        <li class="nav-item">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Widget</button>
        </li>
        
        <li class="nav-item">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Pages</button>
        </li>
       <!--
        <li class="nav-item">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
        </li>-->

    </ul>
      <div class="tab-content pt-2">

        <div class="tab-pane fade show active profile-overview" id="basics">
         
                  
            <!-- General Form Elements -->
            
            <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)"><i class="bi bi-type-h1"></i> Heading</div>
            <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)" data-content="Text Input"><i class="bi bi-card-text"></i> Text Input</div>
            <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)"><i class="bi bi-file-earmark-check-fill"></i> File Input</div>
            <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)"><i class="bi bi-textarea-resize"></i> Textarea</div>
            <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)"><i class="bi bi-ui-checks-grid"></i> Checkbox</div>
            <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)"><i class="bi bi-calendar-check-fill"></i> Date Input</div>
            <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)"><i class="bi bi-check2-all"></i> Select Field</div>
            <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)"><i class="bi bi-ui-radios-grid"></i> Radio Field</div>
            <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)"><i class="bi bi-clock-fill"></i> Time Input</div>
            <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)"><i class="bi bi-image"></i> Image</div>
        </div>


        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

          <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)"><i class="bi bi-calendar3-range-fill"></i> Date/Time Range</div>
          <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)"><i class="bi bi-geo-alt-fill"></i> Location</div>
          <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)"><i class="bi bi-pin-map-fill"></i> Search Location</div>
          <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)"><i class="bi bi-ui-checks-grid"></i> Checkbox Rating</div>
          <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)"><i class="bi bi-star-fill"></i> Star Rating</div>
          <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)"><i class="bi bi-youtube"></i> Youtube</div>
          <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)"><i class="bi bi-vector-pen"></i> Signature</div>
          <div class="alert alert-dark alert-dismissible fade show form-element p-3" onclick="clicked(event)" draggable="true" ondragstart="drag(event)"><i class="bi bi-info-circle-fill"></i> Terms & Condition</div>
        </div>

        <div class="tab-pane fade pt-3" id="profile-settings">

          <button type="submit" class="btn btn-outline-primary" id="addPage">Add Page <i class="bi bi-plus-lg"></i></button>

        </div>

        <div class="tab-pane fade pt-3" id="profile-change-password">
          

        </div>

      </div><!-- End Bordered Tabs -->


  </ul>

</aside><!-- End Sidebar-->

  <main id="main" class="main">

    
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
<script>
  $(document).ready(function() { 
    $("#e1").select2(); 

    $('#e1').on('change', function() {
                var selectedValues = $(this).val();
                $('#selectedValues').val(selectedValues);
            });
    });

    $(document).ready(function() { 
    $("#e3").select2(); 

    $('#e3').on('change', function() {
                var selectedValues = $(this).val();
                $('#selectedValuesEdit').val(selectedValues);
            });
    });

    $(document).ready(function() { 
    $("#e2").select2(); 

    $('#e2').on('change', function() {
                var selectedValues = $(this).val();
                $('#selectedValuesPrivacy').val(selectedValues);
            });
    });
</script>


  

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
  <script src="{{asset('assets/js/formBuilder.js')}}"></script>
  <script src="{{asset('assets/js/clicked.js')}}"></script>
  <script src="{{asset('assets/js/save.js')}}"></script>
  <script src="{{asset('assets/js/editSave.js')}}"></script>

  
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

