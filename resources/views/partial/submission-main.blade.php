
    
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>E-Form | Submission</title>
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
        <img src="{{asset('images/white-logo.png')}}" class="img-fluid">
        <span style="color: white; margin-top: 10px" class="d-none d-lg-block">E-Form</span>
      </a>
      

      
    </div><!-- End Logo -->
    <nav class="header-nav ms-auto">
      <!-- Add the Copy Link button -->
<div class="col d-flex justify-content-center p-3">
  <a href="/login" class="btn btn-info m-2" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Login">Login</a>
</div>
    </nav>
  </header><!-- End Header -->

  <main style="margin-top: 90px">

   

    <div class="col d-flex justify-content-center">

        <div class="col-lg-8">
         <div class="text-center">
      
         </div>
          <div class="card">
                      <!-- Vertically centered Modal -->
      
                     <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                      Export to PDF
                     </button>
                     <div class="modal fade" id="verticalycentered" tabindex="-1">
                       <div class="modal-dialog modal-dialog-centered modal-lg">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title">PDF</h5> 
                             <button type="button" class="btn btn-outline-warning" onclick="exportToPDF()" style="margin-left: 20px">Export</button>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body card-exportPDF">
                            @if ($submitted->logo == null)
                            <center></center>
                            @else
                            <center><img class="img-fluid" style="padding-top: 10px" width="200" height="200" src="{{asset($submitted->logo)}}" alt=""></center>
                            @endif
                            <h3 class="text-center pt-3" style="color: #001689">{{$submitted->type}}</h3>
                            @if ($submitted->type == "Employment Application Form")
                            @else
                            <p style="font-size: 13px" class="pt-0 text-center">{{$submitted->subtitle}}</p>
                            @endif
                            <hr>
                            <div class="p-4">
                              @if ($submitted->tags !== null)
                              @php
                              $tagsArray = json_decode($submitted->tags);
                              @endphp
                                @if (!empty($tagsArray))
                                  @foreach ($tagsArray as $item)
                                  <button class="btn btnTag btn-sm">{{$item}}</button>
                                  @endforeach
                                @endif
                              @else
                              @endif
                            </div>
                            <form>
                                @php
                                   $fields = json_decode($submitted->fields, true);
                                   $hasTextLocation = false;
                                @endphp
                                @if (is_array($fields))
                                    <div class="card-body">
                                      @foreach ($fields as $field)
                                      @if ($field['fieldType'] === 'Heading')
                                  <hr>
                                    <h2>{{ $field['label'] }}</h2>
                                    <p>{{$field['value']}}</p>
                                  <hr>
                                        @elseif ($field['fieldType'] === 'text')
                                            <div class="row mb-3">
                                              <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                              <div class="col-sm-8">
                                               <p>{{$field['value']}}</p>
                                              </div>
                                            </div>
                                        @elseif ($field['fieldType'] === 'table')
                                            <div class="row mb-3">
                                              <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                              <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            @foreach ($field['head'] as $item)
                                                                @foreach ($item as $value)
                                                                    <th scope="col">{{$value}}</th>
                                                                @endforeach
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($field['value'] as $item)
                                                            <tr>
                                                                @foreach ($item as $value)
                                                                    <td>{{$value}}</td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                              </div>
                                            
                                            </div>
                                            @elseif ($field['fieldType'] === 'email')
                                            <div class="row mb-3">
                                              <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                              <div class="col-sm-8">
                                               <p>{{$field['value']}}</p>
                                              </div>
                                            </div>
                                        @elseif ($field['fieldType'] === 'approval')
                                            <div class="row mb-3">
                                              <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                              <div class="col-sm-8">
                                               <p>{{$field['value']}}</p>
                                              </div>
                                            </div>
                                        @elseif ($field['fieldType'] === 'textarea')
                                            <div class="row mb-3">
                                              <label for="inputPassword" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                              <div class="col-sm-8">
                                                <p>{{$field['value']}}</p>
                                               </div>
                                            </div>
                                        @elseif ($field['fieldType'] === 'file allFile')
                                        <div class="row mb-3">
                                          <label for="inputNumber" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                          
                                              @if ($field['value'] == "No File")
                                              <div class="col-sm-8">
                                                  No File Given
                                              </div>
                                              @else
                                                  @if (pathinfo($field['value'], PATHINFO_EXTENSION) === 'jpg' || pathinfo($field['value'], PATHINFO_EXTENSION) === 'jpeg' || pathinfo($field['value'], PATHINFO_EXTENSION) === 'png' || pathinfo($field['value'], PATHINFO_EXTENSION) === 'gif')
                                                  <div class="col-sm-8">
                                                    <div class="row">
                                                        <div class="col-5">
                                                          <img class="img-fluid" src="{{ asset($field['value']) }}" alt="Image">
                                                        </div>
                                                    </div>
                                                  </div>
                                                  @else
                                                  <div class="col-sm-8">
                                                      <a href="{{ asset($field['value']) }}" target="_blank">View File</a>
                                                  </div>
                                                  @endif
                                              @endif
                                          
                                        </div>
                                        @elseif ($field['fieldType'] === 'date')
                                            <div class="row mb-3">
                                              <label for="inputDate" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                              <div class="col-sm-8">
                                                <p>{{$field['value']}}</p>
                                               </div>
                                            </div>
                                        @elseif ($field['fieldType'] === 'time')
                                            <div class="row mb-3">
                                              <label for="inputTime" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                              <div class="col-sm-8">
                                                <p>{{$field['value']}}</p>
                                               </div>
                                            </div>
                                        @elseif ($field['fieldType'] === 'select')
                                            <div class="row mb-3">
                                              <label class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                              <div class="col-sm-8">
                                                <p>{{$field['value']}}</p>
                                               </div>
                                            </div>
                                        @elseif ($field['fieldType'] === 'checkbox')
                                           <div class="row mb-3">
                                              <label class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                              <div class="col-sm-8">
                                             @foreach ($field['value'] as $item)
                                             <button type="button" class="btn btnTagCheck btn-sm">{{$item}}</button>
                                             @endforeach
                                              </div>
                                            </div>
                                          @elseif ($field['fieldType'] === 'radio')
                                            <div class="row mb-3">
                                              <label class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                              <div class="col-sm-8">
                                                <p>{{$field['value']}}</p>
                                               </div>
                                              </div>
                                          @elseif ($field['fieldType'] === 'text datetime')
                                            <div class="row mb-3">
                                              <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                              <div class="col-sm-8">
                                                <p>{{$field['value']}}</p>
                                               </div>
                                            </div>
                                          @elseif ($field['fieldType'] === 'datetime')
                                            <div class="row mb-3">
                                              <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                              <div class="col-sm-8">
                                                <p>{{$field['value']}}</p>
                                               </div>
                                            </div>
                                          @elseif ($field['fieldType'] === 'approval')
                                            <div class="row mb-3">
                                              <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                              <div class="col-sm-8">
                                                <p>{{$field['value']}}</p>
                                               </div>
                                            </div>
                                          @elseif ($field['fieldType'] === 'text location')
                                             @php
                                                 $hasTextLocation = true;
                                             @endphp
                                              <div class="row mb-3">
                                               <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
      
      
                                                   @php
                                                       $locationValue = $field['value'];
      
                                                       // Extract latitude and longitude using regular expressions
                                                       preg_match('/Latitude:\s*([\d.]+),\s*Longitude:\s*([\d.]+)/', $locationValue, $matches);
                                                       $latitude = $matches[1];
                                                       $longitude = $matches[2];
      
                                                   @endphp
                                                   <div class="col-sm-8">
                                                    <p>{{$field['value']}}</p>
      
                                                   </div>
      
      
                                             </div>
                                             @elseif ($field['fieldType'] === 'location')
                                             @php
                                                 $hasTextLocation = true;
                                             @endphp
                                              <div class="row mb-3">
                                               <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                                   <div class="col-sm-8">
                                                    @foreach ($field['value'] as $location)
                                                    <p><b>Search Input:</b> {{ $location['searchInput'] }}</p>
                                                    <p><b>Location Name:</b> {{ $location['locationName'] }}</p>
                                                    <p><b>Coordinates:</b> {{ $location['coordinates'] }}</p>
                                                    @endforeach
      
                                                   </div>
      
      
                                             </div>
                                             @elseif ($field['fieldType'] === 'search')
                                             @php
                                                 $hasTextLocation = true;
                                             @endphp
                                              <div class="row mb-3">
                                               <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
      
      
                                                   @php
                                                   if (!empty($field['value'])) {
                                                    $locationValue = $field['value'];
      
                                                       // Extract latitude and longitude using regular expressions
                                                       preg_match('/Latitude:\s*([\d.]+),\s*Longitude:\s*([\d.]+)/', $locationValue, $matches);
                                                       $latitude = $matches[1];
                                                       $longitude = $matches[2];
                                                   }
      
      
                                                   @endphp
                                                   @if (!empty($field['value']))
                                                   <div class="col-sm-8">
                                                    <p>{{$field['value']}}</p>
                                                    <p>{{$field['location']}}</p>
      
                                                   </div>
                                                   @else
                                                   <div class="col-sm-8">
                                                     <p>No location included</p>
                                                   </div>
                                                   @endif
      
      
      
                                             </div>
                                          @elseif ($field['fieldType'] === 'hidden')
                                             <div class="row mb-3">
                                                 <label class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b></label>
                                                 <div class="col-sm-8">
                                                  <p>{{$field['value']}}</p>
                                                 </div>
                                             </div>
                                        @elseif ($field['fieldType'] === 'Rating')
                                        <div class="row mb-3">
                                          <label class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b></label>
                                          <div class="col-sm-8">
                                           <p>{{$field['value']}}</p>
                                          </div>
                                      </div>
                                          @elseif ($field['fieldType'] === 'Signature')
                                          <div class="row mb-3">
                                            <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                            <div class="col-sm-8">
                                             <img src="{{asset($field['value'])}}" alt="">
                                            </div>
                                          </div>
                                        @endif
      
                                      @endforeach
                                    </div>
      
                                @else
                                    No fields
                                @endif
      
                            </form><!-- End General Form Elements -->
                           </div>
                           <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                             <button type="button" class="btn btn-outline-warning" onclick="exportToPDF()">Export</button>
                           </div>
                         </div>
                       </div>
                     </div><!-- End Vertically centered Modal-->
                     @if ($submitted->logo == null)
                            <center></center>
                            @else
                            <center><img class="img-fluid" style="padding-top: 30px" width="200" height="200" src="{{asset($submitted->logo)}}" alt=""></center>
                            @endif
                     @if ($submitted->type == 'Sponsorship Form')
                     <h3 class="pt-3 text-center" style="color: #001689">{{$submitted->type}}</h3>
                     <p style="font-size: 13px" class="pt-0 text-center">{{$submitted->subtitle}}</p>
                     @else
                     <h3 class="pt-3 text-center" style="color: #001689">{{$submitted->type}}</h3>
                     <p style="font-size: 13px" class="pt-0 text-center">{{$submitted->subtitle}}</p>
                     @endif
                    <hr>
                    <div class="p-4">
                      @if ($submitted->tags !== null)
                      @php
                      $tagsArray = json_decode($submitted->tags);
                      @endphp
                        @if (!empty($tagsArray))
                          @foreach ($tagsArray as $item)
                          <a href="/delete-tag/{{$submitted->id}}/{{$item}}" class="btn btnTag btn-sm">{{$item}} <i class="bi bi-x-lg"></i></a>
                          @endforeach
                        @endif
                      @endif
                    </div>
                    <script>
                      // Function to generate a random RGB color
                      function getRandomRGBColor() {
                          const r = Math.floor(Math.random() * 256); // Red component (0-255)
                          const g = Math.floor(Math.random() * 256); // Green component (0-255)
                          const b = Math.floor(Math.random() * 256); // Blue component (0-255)
                      
                          return `rgba(${r}, ${g}, ${b}, 0.5)`; // Fixed alpha value (0.5)
                      }
                      
                      // Get all buttons with the "btn" class
                      const buttons = document.querySelectorAll('.btnTag');
                      
                      // Loop through each button and set a random background color
                      buttons.forEach((button) => {
                          button.style.backgroundColor = getRandomRGBColor();
                      });
      
                    </script>
                        @php
                           $fields = json_decode($submitted->fields, true);
                           $hasTextLocation = false;
                        @endphp
                        @if (is_array($fields))
                            <div class="card-body">
                              @foreach ($fields as $field)
                              @if ($field['fieldType'] === 'Heading')
                                  <hr>
                                    <h2>{{ $field['label'] }}</h2>
                                    <p>{{$field['value']}}</p>
                                  <hr>
                                    
                                @elseif ($field['fieldType'] === 'text')
                                    <div class="row mb-3">
                                      <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                      <div class="col-sm-8">
                                       <p>{{$field['value']}}</p>
                                      </div>
                                    </div>
                                @elseif ($field['fieldType'] === 'table')
                                            <div class="row mb-3">
                                              <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                              <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            @foreach ($field['head'] as $item)
                                                                @foreach ($item as $value)
                                                                    <th scope="col">{{$value}}</th>
                                                                @endforeach
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($field['value'] as $item)
                                                            <tr>
                                                                @foreach ($item as $value)
                                                                    <td>{{$value}}</td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                              </div>
                                            
                                            </div>
                                @elseif ($field['fieldType'] === 'email')
                                    <div class="row mb-3">
                                      <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                      <div class="col-sm-8">
                                       <p>{{$field['value']}}</p>
                                      </div>
                                    </div>
                                @elseif ($field['fieldType'] === 'textarea')
                                    <div class="row mb-3">
                                      <label for="inputPassword" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                      <div class="col-sm-8">
                                        <p>{{$field['value']}}</p>
                                       </div>
                                    </div>
                                @elseif ($field['fieldType'] === 'file allFile')
                                <div class="row mb-3">
                                  <label for="inputNumber" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                  
                                      @if ($field['value'] == "No File")
                                      <div class="col-sm-8">
                                          No File Given
                                      </div>
                                      @else
                                      @if (pathinfo($field['value'], PATHINFO_EXTENSION) === 'jpg' || pathinfo($field['value'], PATHINFO_EXTENSION) === 'jpeg' || pathinfo($field['value'], PATHINFO_EXTENSION) === 'png' || pathinfo($field['value'], PATHINFO_EXTENSION) === 'gif')
                                      <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-5">
                                              <img class="img-fluid" src="{{ asset($field['value']) }}" alt="Image">
                                            </div>
                                        </div>
                                      </div>
                                          @else
                                          <div class="col-sm-8">
                                              <a href="{{ asset($field['value']) }}" target="_blank">View File</a>
                                          </div>
                                          @endif
                                      @endif
                                  
                                </div>
                                @elseif ($field['fieldType'] === 'date')
                                    <div class="row mb-3">
                                      <label for="inputDate" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                      <div class="col-sm-8">
                                        <p>{{$field['value']}}</p>
                                       </div>
                                    </div>
                                @elseif ($field['fieldType'] === 'time')
                                    <div class="row mb-3">
                                      <label for="inputTime" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                      <div class="col-sm-8">
                                        <p>{{$field['value']}}</p>
                                       </div>
                                    </div>
                                @elseif ($field['fieldType'] === 'select')
                                    <div class="row mb-3">
                                      <label class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                      <div class="col-sm-8">
                                        <p>{{$field['value']}}</p>
                                       </div>
                                    </div>
                                @elseif ($field['fieldType'] === 'checkbox')
                                   <div class="row mb-3">
                                      <label class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                      <div class="col-sm-8">
                                     @foreach ($field['value'] as $item)
                                         <button type="button" class="btn btnTagCheck btn-sm">{{$item}}</button>
                                     @endforeach
                                      </div>
                                      <script>
                                        // Function to generate a random RGB color
                                        function getRandomRGBColor() {
                                            const r = Math.floor(Math.random() * 256); // Red component (0-255)
                                            const g = Math.floor(Math.random() * 256); // Green component (0-255)
                                            const b = Math.floor(Math.random() * 256); // Blue component (0-255)
                                        
                                            return `rgba(${r}, ${g}, ${b}, 0.5)`; // Fixed alpha value (0.5)
                                        }
                                        
                                        // Get all buttons with the "btn" class
                                        const buttonCheck = document.querySelectorAll('.btnTagCheck');
                                        
                                        // Loop through each button and set a random background color
                                        buttonCheck.forEach((button) => {
                                            button.style.backgroundColor = getRandomRGBColor();
                                        });
                        
                                      </script>
                                    </div>
                                  @elseif ($field['fieldType'] === 'radio')
                                    <div class="row mb-3">
                                      <label class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                      <div class="col-sm-8">
                                        <p>{{$field['value']}}</p>
                                       </div>
                                      </div>
                                  @elseif ($field['fieldType'] === 'text datetime')
                                    <div class="row mb-3">
                                      <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                      <div class="col-sm-8">
                                        <p>{{$field['value']}}</p>
                                       </div>
                                    </div>
                                    @elseif ($field['fieldType'] === 'datetime')
                                    <div class="row mb-3">
                                      <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                      <div class="col-sm-8">
                                        <p>{{$field['value']}}</p>
                                       </div>
                                    </div>
                                  @elseif ($field['fieldType'] === 'approval')
                                    <div class="row mb-3">
                                      <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                      <div class="col-sm-8">
                                        <p>{{$field['value']}}</p>
                                        @if ($field['value'] == "Pending")
                                                   <a class="btn btn-success" href="#">Approve</a>
                                                   <a class="btn btn-danger" href="#">Reject</a>
                                               @endif
                                       </div>
      
                                    </div>
                                  @elseif ($field['fieldType'] === 'text location')
                                     @php
                                         $hasTextLocation = true;
                                     @endphp
                                      <div class="row mb-3">
                                       <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
      
      
                                           @php
                                               $locationValue = $field['value'];
      
                                               // Extract latitude and longitude using regular expressions
                                               preg_match('/Latitude:\s*([\d.]+),\s*Longitude:\s*([\d.]+)/', $locationValue, $matches);
                                               $latitude = $matches[1];
                                               $longitude = $matches[2];
      
                                           @endphp
                                           <div class="col-sm-8">
                                            <p>{{$field['value']}}</p>
      
                                           </div>
      
      
                                     </div>
                                     @elseif ($field['fieldType'] === 'location')
                                     @php
                                         $hasTextLocation = true;
                                     @endphp
                                      <div class="row mb-3">
                                       <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                           <div class="col-sm-8">
                                            @foreach ($field['value'] as $location)
                                                <p><b>Search Input:</b> {{ $location['searchInput'] }}</p>
                                                <p><b>Location Name:</b> {{ $location['locationName'] }}</p>
                                                <p><b>Coordinates:</b> {{ $location['coordinates'] }}</p>
                                            @endforeach
                                           </div>
      
      
                                     </div>
                                     @elseif ($field['fieldType'] === 'search')
                                     @php
                                         $hasTextLocation = true;
                                     @endphp
                                      <div class="row mb-3">
                                       <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
      
      
                                           @php
                                           if (!empty($field['value'])) {
                                            $locationValue = $field['value'];
      
                                               // Extract latitude and longitude using regular expressions
                                               preg_match('/Latitude:\s*([\d.]+),\s*Longitude:\s*([\d.]+)/', $locationValue, $matches);
                                               $latitude = $matches[1];
                                               $longitude = $matches[2];
                                           }
      
      
                                           @endphp
                                           @if (!empty($field['value']))
                                           <div class="col-sm-8">
                                            <p>{{$field['value']}}</p>
                                            <p>{{$field['location']}}</p>
      
                                           </div>
                                           @else
                                           <div class="col-sm-8">
                                             <p>No location included</p>
                                           </div>
                                           @endif
      
      
      
                                     </div>
                                  @elseif ($field['fieldType'] === 'hidden')
                                     <div class="row mb-3">
                                         <label class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b></label>
                                         <div class="col-sm-8">
                                          <p>{{$field['value']}}</p>
                                         </div>
                                     </div>
                                @elseif ($field['fieldType'] === 'Rating')
                                <div class="row mb-3">
                                  <label class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b></label>
                                  <div class="col-sm-8">
                                   <p>{{$field['value']}}</p>
                                  </div>
                                </div>
                                  @elseif ($field['fieldType'] === 'Signature')
                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                    <div class="col-sm-8">
                                     <img src="{{asset($field['value'])}}" alt="">
                                    </div>
                                  </div>
                                @endif
      
                              @endforeach
                            </div>
      
                        @else
                            No fields
                        @endif
      
          </div>
      
      
        </div>
      
      </div>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

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
</body>

</html>

