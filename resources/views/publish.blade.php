@extends('partial.publishmain')

@section('title', 'Publish')
    
@section('content')





  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-4">

      </div>
      <!-- Left side columns -->
      <div class="col-lg-4">
        <div class="row">
            <div id="loading-screen-published" style="display: none;">
                Sending Your Form...  <div class="spinner-border" style="width: 50px; height: 50px;" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
            </div>
            
          <div class="card">
          <form id="myForm">
            @foreach ($form as $forms)
            @if ($forms->logo !== null)
            <center><img style="padding-top: 30px" width="500" height="300" src="{{$forms->logo}}" alt=""></center>
            @else
            @endif
            <h3 class="pt-3 text-center formTypeTemp">{{$forms->type}} Form</h3>
            <p style="font-size: 13px" class="pt-0 text-center formTypeTemp">{{$forms->subtitle}}</p>
                  <input type="hidden" class="formPublisher" id="idInput" value="{{$user->id}}">
                  <input type="approval" name="approval" class="formFieldHide formApproval" id="approval" value="{{$forms->approval}}">
                  <input type="approver" name="approver" class="formFieldHide formApprover" id="approver" value="{{$forms->approveBy}}">
                  @php
                    $notifyFields = json_decode($forms->notify);
                    $notification = [];
                    if ($notifyFields !== null) {
                      foreach ($notifyFields as $value) {
                        $notification[] = $value;
                      }
                    } 
                  @endphp
                  <input type="notify" name="notify" class="formFieldHide formNotify" id="notify" value="{{ implode(',', $notification) }}">

                  <hr>
                  <div class="col-6 p-4">
                    <label for="inputText" class="form-label"><b>Email (for submit notification)</b></label>
                    <input type="email" name="emailNotify" class="form-control">
                  </div>
                  @php
                     $fieldsData = json_decode($forms->fields, true);
                  @endphp
                  @if (is_array($fieldsData))
                      @php
                          $fieldsByPage = [];
                      @endphp
                      @foreach ($fieldsData as $field)
                          @php
                              $pageNumber = $field['pageNumber'];
                                  if (!isset($fieldsByPage[$pageNumber])) {
                                      $fieldsByPage[$pageNumber] = [];
                                  }
                              $fieldsByPage[$pageNumber][] = $field;
                          @endphp
                      @endforeach

                    @foreach ($fieldsByPage as $pageNumber => $fields)
                      <div class="card-body page-content"  style="display: none;">
                        @foreach ($fields as $field)
                        @if ($field['type'] === 'Heading')
                        <h2 class="text-center">{{$field['label']}}</h2>
                        <p class="text-center">{{$field['subheading']}}</p>
                        <hr>
                          @elseif ($field['type'] === 'text')
                              <div class="col-12 pt-2 fieldType">
                                
                                <label for="inputText" class="form-label"><b>{{ $field['label'] }}</b></label>
                                @if ($field['required'] == 'yes')
                                <input type="text" name="text" class="form-control val" required>
                                @else
                                <input type="text" name="text" class="form-control val">
                                @endif
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                                
                              </div><br>
                          @elseif ($field['type'] === 'email')
                              <div class="col-12 pt-2 fieldType">
                                
                                <label for="inputText" class="form-label"><b>{{ $field['label'] }}</b></label>
                                @if ($field['required'] == 'yes')
                                <input type="email" name="email" class="form-control val" required>
                                @else
                                <input type="email" name="email" class="form-control val">
                                @endif
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                                
                              </div><br>
                          @elseif ($field['type'] === 'textarea')
                              <div class="col-12 pt-2 fieldType">
                                <label for="inputPassword" class="form-label"><b>{{$field['label']}}</b></label>
                                @if ($field['required'] == 'yes')
                                <textarea class="form-control val" name="textarea" style="height: 100px" required></textarea>
                                @else
                                <textarea class="form-control val" name="textarea" style="height: 100px"></textarea>
                                @endif
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                              </div><br>
                          @elseif ($field['type'] === 'file allFile')
                              <div class="col-12 pt-2 fieldType">
                                <label for="inputNumber" class="form-label"><b>{{$field['label']}}</b></label>
                                @if ($field['required'] == 'yes')
                                <input class="form-control val" name="file allFile" type="file" id="formFile" multiple required>
                                @else
                                <input class="form-control val" name="file allFile" type="file" id="formFile" multiple>
                                @endif
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                              </div><br>
                          @elseif ($field['type'] === 'date')
                              <div class="col-12 pt-2 fieldType">
                                <label for="inputDate" class="form-label"><b>{{$field['label']}}</b></label> 
                                @if ($field['required'] == 'yes')                             
                                <input type="date" class="form-control val" name="date" required>
                                @else
                                <input type="date" class="form-control val" name="date">
                                @endif
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                              </div><br>
                          @elseif ($field['type'] === 'time')
                              <div class="col-12 pt-2 fieldType">
                                <label for="inputTime" class="form-label"><b>{{$field['label']}}</b></label>
                                @if ($field['required'] == 'yes') 
                                <input type="time" class="form-control val" name="time" required>
                                @else
                                <input type="time" class="form-control val" name="time">
                                @endif
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                              </div><br>
                          @elseif ($field['type'] === 'select') 
                              <div class="col-12 pt-2 fieldType">
                                <label class="form-label"><b>{{$field['label']}}</b></label>
                                @if ($field['required'] == 'yes') 
                                  <select class="form-select val" aria-label="Default select example" name="select" required>
                                    @foreach ($field['selectOption'] as $opt)
                                       <option value="{{$opt}}">{{$opt}}</option>
                                    @endforeach
                                  </select>
                                @else
                                <select class="form-select val" aria-label="Default select example" name="select">
                                  @foreach ($field['selectOption'] as $opt)
                                     <option value="{{$opt}}">{{$opt}}</option>
                                  @endforeach
                                </select>
                                @endif
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                              </div><br>
                          @elseif ($field['type'] === 'checkbox')
                              <div class="col-12 fieldType">
                                <div class="invalid-feedback" id="checkboxError" style="display: none;">Please select at least one option.</div>
                                <legend class="col-form-label form-label pt-2"><b>{{$field['label']}}</b></legend>
                                
                                @if ($field['required'] === 'yes') 
                                  @foreach ($field['checkValues'] as $opt)
                                  <div class="form-check">
                                    <input class="form-check-input val" type="checkbox" id="gridCheck1" name="checkbox" value="{{$opt}}" required>
                                    <label class="form-check-label" for="gridCheck1">
                                      {{$opt}}
                                    </label>
                                  </div>
                                  @endforeach
                                @else
                                @foreach ($field['checkValues'] as $opt)
                                  <div class="form-check">
                                    <input class="form-check-input val" type="checkbox" id="gridCheck1" name="checkbox" value="{{$opt}}">
                                    <label class="form-check-label" for="gridCheck1">
                                      {{$opt}}
                                    </label>
                                  </div>
                                  @endforeach
                                @endif
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                              </div><br>
                            @elseif ($field['type'] === 'radio')
                              <fieldset class="col-12 fieldType">
                                <div class="invalid-feedback" id="checkboxError" style="display: none;">Please select at least one option.</div>
                                <legend class="col-form-label form-label pt-2"><b>{{$field['label']}}</b></legend>
                                
                                @if ($field['required'] == 'yes')
                                  @foreach ($field['radioValues'] as $item)
                                  <div class="form-check">
                                    <input class="form-check-input val" type="radio" name="radio{{$field['fieldID']}}" id="{{$field['fieldID']}}" value="{{$item}}" required>
                                    <label class="form-check-label" for="gridRadios1">
                                      {{$item}}
                                    </label>
                                  </div>
                                  @endforeach
                                @else
                                @foreach ($field['radioValues'] as $item)
                                  <div class="form-check">
                                    <input class="form-check-input val" type="radio" name="radio{{$field['fieldID']}}" id="{{$field['fieldID']}}" value="{{$item}}">
                                    <label class="form-check-label" for="gridRadios1">
                                      {{$item}}
                                    </label>
                                  </div>
                                  @endforeach
                                @endif
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                              </fieldset><br>
                            @elseif ($field['type'] === 'text datetime')
                              <div class="col-12 pt-2 fieldType" >
                                <label for="inputText" class="form-label"><b>{{$field['label']}}</b></label>
                                @if ($field['required'] == 'yes')
                                <input type="text" name="datetime" class="form-control val" id="reservationdatetime" required>
                                @else
                                <input type="text" name="datetime" class="form-control val" id="reservationdatetime">
                                @endif
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                              </div><br>
                            @elseif ($field['type'] === 'text location')
                            <div class="col-12 pt-2 fieldType">
                                <label for="inputText" class="form-label"><b>{{$field['label']}}</b></label>
                                <div class="col-sm-10">
                                    <a  class="btn btn-outline-primary" id="getLocationBtnGetLocation">Get Location</a>
                                    <div class="val" id="coordinatesGetLocation{{$loop->index}}"></div>
                                    <div id="mapGetLocation"></div>
                                    <input type="{{$field['type']}}" class="inputType formFieldHide">
                                </div>
                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPyDbSSao5JOxiTLETXEU7neCpLqpxiwE&libraries=places"></script>
                                 <script>
                                    // Declare the map variable outside the function for global access
                                   // Declare the marker variable
                               
                                   // Function to initialize the map and marker
                                   function initMap(currentLocation) {
                                      var mapGet = new google.maps.Map(document.getElementById('mapGetLocation'), {
                                           center: currentLocation,
                                           zoom: 15
                                       });
                               
                                       // Add a draggable marker for the current location
                                      var markerGet = new google.maps.Marker({
                                           position: currentLocation,
                                           map: mapGet,
                                           draggable: true
                                       });
                               
                                       // Handle marker dragend event
                                       markerGet.addListener('dragend', function(event) {
                                           const updatedLatLng = event.latLng;
                                           const lat = updatedLatLng.lat().toFixed(6);
                                           const lng = updatedLatLng.lng().toFixed(6);
                               
                                           // Update displayed coordinates and location name
                                           reverseGeocodeGet(updatedLatLng, lat, lng);
                                       });
                                   }
                               
                                   // Function to get the current location
                                   function getCurrentLocationCurrent() {
                                       if (navigator.geolocation) {
                                           navigator.geolocation.getCurrentPosition(function(position) {
                                               var latitude = position.coords.latitude;
                                               var longitude = position.coords.longitude;
                                               var currentLocation = { lat: latitude, lng: longitude };
                               
                                               // Display the coordinates and location name
                                               reverseGeocodeGet(currentLocation, latitude, longitude);
                               
                                               // Initialize the map with draggable marker
                                               initMap(currentLocation);
                                           }, function(error) {
                                               console.error("Error getting the current location: ", error);
                                           });
                                       } else {
                                           console.error("Geolocation is not supported by this browser.");
                                       }
                                   }
                               
                                   // Function to reverse geocode the coordinates and display location name
                                   function reverseGeocodeGet(location, lat, lng) {
                                       var geocoder = new google.maps.Geocoder();
                                       geocoder.geocode({ location: location }, function(results, status) {
                                           if (status === "OK") {
                                               if (results[0]) {
                                                   var locationName = results[0].formatted_address;
                                                   document.getElementById("coordinatesGetLocation{{$loop->index}}").textContent = `Latitude: ${lat}, Longitude: ${lng}\nLocation: ${locationName}`;
                                               }
                                           } else {
                                               console.error("Geocoder failed due to: " + status);
                                           }
                                       });
                                   }
                               
                                   // Call the function to get the current location when the button is clicked
                                   document.getElementById("getLocationBtnGetLocation").addEventListener("click", getCurrentLocationCurrent);
                               </script>
                              </div><br>

                          @elseif ($field['type'] === 'search')
                          <div class="col-12 pt-2 fieldType">
                            <label for="inputText" class="form-label"><b>{{$field['label']}}</b></label>
                            <div class="col-sm-10 input-group">
                                <input class="form-control" type="text" id="searchInput{{$field['fieldID']}}" placeholder="Search for a location">
                                <a class="btn btn-success search-buttonSearch" id="searchButton{{$field['fieldID']}}" data-field-id="{{$field['fieldID']}}">Search</a>
                            </div>
                                <div class="val" id="coordinatesSearch{{$field['fieldID']}}"></div>
                                <p id="locationName{{$field['fieldID']}}"></p>
                                <div id="map{{$field['fieldID']}}" style="height: 400px;"></div>
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                                
                          </div><br>
                          @elseif ($field['type'] === 'hidden')
                               <div class="col-12 pt-2 fieldType">
                                   <label class="form-label"><b>{{$field['label']}}</b></label>
                                   <div class="col-sm-10">
                                       <div class="star-rating d-inline-flex">
                                           <i class="fas fa-star" data-rating="1"></i>
                                           <i class="fas fa-star" data-rating="2"></i>
                                           <i class="fas fa-star" data-rating="3"></i>
                                           <i class="fas fa-star" data-rating="4"></i>
                                           <i class="fas fa-star" data-rating="5"></i>
                                         </div>
                                         @if ($field['required'] == 'yes')
                                         <input type="hidden" name="starrating" id="rating-value" required>
                                         @else
                                         <input type="hidden" name="starrating" id="rating-value">
                                         @endif
                                         <input type="{{$field['type']}}" class="inputType formFieldHide">
                                   </div>
                               
                               </div><br>
                          @elseif ($field['type'] === 'text youtube')
                            <div class="col-12 pt-2 fieldType">
                                <label class="form-label"><b>{{$field['label']}}</b></label>
                                <div class="col-sm-10">
                                    <iframe width="420" height="310" src="{{$field['youtubeLink']}}"></iframe>
                                </div>
                            </div>
                          @elseif ($field['type'] === 'file')
                          <div class="text-center pt-2 fieldType">
                            <label class="form-label formFieldHide"><b>{{$field['label']}}</b></label>
                            <img src='{{$field['image']}}' alt="" class="img-fluid">
                            <p><b>{{$field['label']}}</b></p>
                          </div><br>
                          @elseif ($field['type'] === 'Rating')
                            <div class="col-12 pt-2 fieldType">
                              <label class="form-label" for="rating"><b>{{$field['label']}}</b></label><br><br>
                              <input type="{{$field['type']}}" class="inputType formFieldHide">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating1" value="1">
                                <label class="form-check-label" for="rating1">Disagree</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating2" value="2">
                                <label class="form-check-label" for="rating2">2</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating3" value="3">
                                <label class="form-check-label" for="rating3">3</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating4" value="4">
                                <label class="form-check-label" for="rating4">4</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating5" value="5">
                                <label class="form-check-label" for="rating5">Agree</label>
                              </div>
                            </div><br>
                            @elseif ($field['type'] === 'termscondition')
                        <div class="form-check">
                          <div class="invalid-feedbackterm" id="checkboxError" style="display: none;">Check this</div>
                          @if ($field['required'] == 'yes')
                          <input class="form-check-input val" type="checkbox" id="gridCheck1" name="termscondition" value="agree" required>
                          <label class="form-check-label" for="gridCheck1">
                            <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#verticalycentered-terms">
                              {{ $field['label'] }}
                            </button>
                            <div class="modal fade" id="verticalycentered-terms" tabindex="-1">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Terms & Condition</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <textarea class="form-control" style="height: 500px" readonly>
                                      {{$field['terms']}}
                                    </textarea>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                   
                                  </div>
                                </div>
                            </div>
                          </label>
                          @else
                          <input class="form-check-input val" type="checkbox" id="gridCheck1" name="termscondition" value="agree">
                          <label class="form-check-label" for="gridCheck1">
                            <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#verticalycentered-terms">
                              {{ $field['label'] }}
                            </button>
                            <div class="modal fade" id="verticalycentered-terms" tabindex="-1">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Terms & Condition</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <textarea class="form-control" style="height: 500px" readonly>
                                      {{$field['terms']}}
                                    </textarea>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                   
                                  </div>
                                </div>
                            </div>
                          </label>
                          @endif
                        </div>
                        @elseif ($field['type'] === 'Signature')
                        <div class="col-12 pt-2 fieldType">
                          <label class="form-label"><b>{{$field['label']}}</b></label>
                          <div class="col-sm-10">
                            @if ($field['required'] == 'yes')
                             <canvas class="canvasBack" name="signature" id="signatureCanvas" @required(true)></canvas>
                             <button id="clearButton">Clear</button>
                             <br>
                             @else
                             <canvas class="canvasBack" name="signature" id="signatureCanvas"></canvas>
                             <button type="button" id="clearButton">Clear</button>
                             <br>
                             @endif
                             <input type="{{$field['type']}}" class="inputType formFieldHide">
                          </div>
                        </div>
                          @endif
                          
                        @endforeach
                      </div>
                    @endforeach
                  @else
                      No fields
                  @endif
                  <div class="d-grid gap-2 d-md-flex justify-content-center pt-2 mb-4">
                    <button type="button" class="btn btn-primary" id="prev-btn" onclick="prevPage()">Previous</button>
                    <button type="button" class="btn btn-primary" id="next-btn" onclick="nextPage()">Next</button>
                    <button type="button" class="btn btn-success" id="submit-btn" style="display: none;" onclick="validateAndSubmit()">Submit</button>
                    <button style="display: none" class="btn btn-success" type="button" id="buttonLoading" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                      </button>
                </div>
                
                
                
                    
          @endforeach
        </form>
        </div>
        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-4">

      </div><!-- End Right side columns -->

    </div>
  </section>
          

  <script>
   function validateAndSubmit() {
    const currentPageInputs = formPages[currentPage - 1].querySelectorAll('.val[required]');
    const currentPageCheckboxes = formPages[currentPage - 1].querySelectorAll('.val[type="checkbox"][required]');
    const currentPageRadios = formPages[currentPage - 1].querySelectorAll('.val[type="radio"][required]');
    const currentPageTerms = formPages[currentPage - 1].querySelector('.val[name="termscondition"]');

    const inputError = formPages[currentPage - 1].querySelector('.invalid-feedback');
    const checkError = formPages[currentPage - 1].querySelector('.invalid-feedback');
    const radioError = formPages[currentPage - 1].querySelector('.invalid-feedback');
    const termError = formPages[currentPage - 1].querySelector('.invalid-feedbackterm');

    let isValidInputs = true;
    let isValidCheckboxes = true;
    let isValidRadios = true;
    let isValidTerms = true;

    currentPageInputs.forEach(input => {
        if (input.value.trim() === '') {
            isValidInputs = false;
            inputError.style.display = 'block';
            input.classList.add('is-invalid');
        } else {
            inputError.style.display = 'none';
            input.classList.remove('is-invalid');
        }
    });

    if (currentPageCheckboxes.length > 0) {
        isValidCheckboxes = Array.from(currentPageCheckboxes).some(input => input.checked);
        if (!isValidCheckboxes) {
            checkError.style.display = 'block';
        } else {
            checkError.style.display = 'none';
        }
    }

    if (currentPageRadios.length > 0) {
        isValidRadios = Array.from(currentPageRadios).some(input => input.checked);
        if (!isValidRadios) {
            radioError.style.display = 'block';
        } else {
            radioError.style.display = 'none';
        }
    }

    if (currentPageTerms) {
        isValidTerms = currentPageTerms.checked;
        if (!isValidTerms) {
            termError.style.display = 'block';
        } else {
            termError.style.display = 'none';
        }
    }

    if (isValidInputs && isValidCheckboxes && isValidRadios && isValidTerms) {
        if (currentPage === formPages.length) {
            // Handle submission logic here
            
        } else {
            nextPage();
        }
    }
}


    </script>
    

    <script>
      let currentPage = 1;
      const formPages = document.querySelectorAll('.page-content');
      const prevBtn = document.getElementById('prev-btn');
      const nextBtn = document.getElementById('next-btn');
      const submitBtn = document.getElementById('submit-btn');
  
      function showPage(pageNum) {
          formPages.forEach((page, index) => {
              if (index + 1 === pageNum) {
                  page.style.display = 'block';
              } else {
                  page.style.display = 'none';
              }
          });
      }
  
      function updateButtonVisibility() {
            if (formPages.length === 1) {
                prevBtn.style.display = 'none';
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'block';
            } else {
                if (currentPage === 1) {
                    prevBtn.style.display = 'none';
                    nextBtn.style.display = 'block';
                    submitBtn.style.display = 'none';
                } else if (currentPage === formPages.length) {
                    prevBtn.style.display = 'block';
                    nextBtn.style.display = 'none';
                    submitBtn.style.display = 'block';
                } else {
                    prevBtn.style.display = 'block';
                    nextBtn.style.display = 'block';
                    submitBtn.style.display = 'none';
                }
            }
        }
  
        function validatePage(pageNum) {
    if (pageNum < formPages.length) {
        const currentPageCheckboxes = formPages[pageNum - 1].querySelectorAll('.val[type="checkbox"][required]');
        const isChecked = Array.from(currentPageCheckboxes).some(input => input.checked);

        if (!isChecked) {
            const checkError = formPages[pageNum - 1].querySelector('.invalid-feedback');
            checkError.style.display = 'block';
            return false;
        } else {
            const checkError = formPages[pageNum - 1].querySelector('.invalid-feedback');
            checkError.style.display = 'none';
        }
    } else {
        const currentPageRadios = formPages[pageNum - 1].querySelectorAll('.val[type="radio"][required]');
        const isChecked = Array.from(currentPageRadios).some(input => input.checked);

        if (!isChecked) {
            const radioError = formPages[pageNum - 1].querySelector('.invalid-feedback');
            radioError.style.display = 'block';
            return false;
        } else {
            const radioError = formPages[pageNum - 1].querySelector('.invalid-feedback');
            radioError.style.display = 'none';
        }
    }

    // Check for termscondition input type
    const currentPageterms = formPages[pageNum - 1].querySelector('.val[name="termscondition"]');
    if (currentPageterms) {
        const isChecked = currentPageterms.checked;

        if (!isChecked) {
            const checkError = formPages[pageNum - 1].querySelector('.invalid-feedbackterm');
            checkError.style.display = 'block';
            return false;
        } else {
            const checkError = formPages[pageNum - 1].querySelector('.invalid-feedbackterm');
            checkError.style.display = 'none';
        }
    }

    const currentPageInputs = formPages[pageNum - 1].querySelectorAll('.val[required]');
    let isValid = true;

    currentPageInputs.forEach(input => {
        if (input.value.trim() === '') {
            isValid = false;
            input.classList.add('is-invalid');
        } else {
            input.classList.remove('is-invalid');
        }
    });

    return isValid;
}


  
function nextPage() {
    if (currentPage < formPages.length) {
        const currentPageCheckboxes = formPages[currentPage - 1].querySelectorAll('.val[type="checkbox"][required]');
        const currentPageRadios = formPages[currentPage - 1].querySelectorAll('.val[type="radio"][required]');
        const currentPageTerms = formPages[currentPage - 1].querySelector('.val[name="termscondition"]');

        const checkError = formPages[currentPage - 1].querySelector('.invalid-feedback');
        const radioError = formPages[currentPage - 1].querySelector('.invalid-feedback');
        const termError = formPages[currentPage - 1].querySelector('.invalid-feedbackterm');

        let isValidCheckboxes = true;
        let isValidRadios = true;
        let isValidTerms = true;

        if (currentPageCheckboxes.length > 0) {
            isValidCheckboxes = Array.from(currentPageCheckboxes).some(input => input.checked);
            if (!isValidCheckboxes) {
                checkError.style.display = 'block';
            } else {
                checkError.style.display = 'none';
            }
        }

        if (currentPageRadios.length > 0) {
            isValidRadios = Array.from(currentPageRadios).some(input => input.checked);
            if (!isValidRadios) {
                radioError.style.display = 'block';
            } else {
                radioError.style.display = 'none';
            }
        }

        if (currentPageTerms) {
            isValidTerms = currentPageTerms.checked;
            if (!isValidTerms) {
                termError.style.display = 'block';
            } else {
                termError.style.display = 'none';
            }
        }

        if (isValidCheckboxes && isValidRadios && isValidTerms) {
            currentPage++;
            showPage(currentPage);
            updateButtonVisibility();
        }
    }
}





  
      function prevPage() {
          if (currentPage > 1) {
              currentPage--;
              showPage(currentPage);
              updateButtonVisibility();
          }
      }
  
      showPage(currentPage);
      updateButtonVisibility();
  </script>
  

<script> 
  document.addEventListener('DOMContentLoaded', function () {
      const canvas = document.getElementById('signatureCanvas');
      const clearButton = document.getElementById('clearButton');
      const saveButton = document.getElementById('saveButton');
      const savedSignature = document.getElementById('savedSignature');
  
      const context = canvas.getContext('2d');
      let isDrawing = false;
      
      canvas.addEventListener('mousedown', (event) => {
          isDrawing = true;
          const x = event.clientX - canvas.getBoundingClientRect().left;
          const y = event.clientY - canvas.getBoundingClientRect().top;
          context.beginPath();
          context.moveTo(x, y);
      });
  
      canvas.addEventListener('mousemove', (event) => {
          if (!isDrawing) return;
  
          const x = event.clientX - canvas.getBoundingClientRect().left;
          const y = event.clientY - canvas.getBoundingClientRect().top;
  
          context.lineWidth = 2;
          context.lineCap = 'round';
          context.strokeStyle = '#000';
  
          context.lineTo(x, y);
          context.stroke();
          context.beginPath();
          context.moveTo(x, y);
      });
  
      canvas.addEventListener('mouseup', () => {
          isDrawing = false;
      });
  
      clearButton.addEventListener('click', () => {
          context.clearRect(0, 0, canvas.width, canvas.height);
      });
  
      saveButton.addEventListener('click', () => {
          const signatureImage = canvas.toDataURL();
          savedSignature.src = signatureImage;
      });
  });
  
  </script>
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPyDbSSao5JOxiTLETXEU7neCpLqpxiwE&libraries=places"></script>
  <script>
  let map;
  let marker;
   const malaysiaBounds = new google.maps.LatLngBounds(
       new google.maps.LatLng(-1.0, 99.6),
       new google.maps.LatLng(7.4, 119.3)
   );
 
   const maps = {}; // Create an object to store map instances

function initMap(fieldIDMap) {
    const mapContainer = document.getElementById('map' + fieldIDMap);

    const mapOptions = {
        center: { lat: 4.2105, lng: 101.9758 }, // Initial focus on Malaysia
        zoom: 6
    };

    maps[fieldIDMap] = new google.maps.Map(mapContainer, mapOptions);

    maps[fieldIDMap].addListener('click', (event) => {
        addMarker(event.latLng.lat(), event.latLng.lng(), fieldIDMap);
    });

    const searchInput = document.getElementById('searchInput' + fieldIDMap);
    const autocomplete = new google.maps.places.Autocomplete(searchInput);
}

function addMarker(lat, lng, fieldIDMap) {
    if (maps[fieldIDMap] && marker) {
        marker.setMap(null); // Remove the previous marker from the map
    }

    marker = new google.maps.Marker({
        position: { lat: lat, lng: lng },
        map: maps[fieldIDMap], // Add marker to the correct map
        draggable: true
    });

    marker.addListener('dragend', (event) => {
        const updatedLatLng = event.latLng;
        const lat = updatedLatLng.lat().toFixed(6);
        const lng = updatedLatLng.lng().toFixed(6);

        const coordinatesElement = document.getElementById('coordinatesSearch' + fieldIDMap);
        coordinatesElement.textContent = `Latitude: ${lat}, Longitude: ${lng}`;

        reverseGeocode(updatedLatLng, fieldIDMap);
    });
}


 
   function reverseGeocode(latLng, fieldIDMap) {
       const geocoder = new google.maps.Geocoder();
 
       geocoder.geocode({ location: latLng }, (results, status) => {
           if (status === google.maps.GeocoderStatus.OK && results.length > 0) {
               const locationNameElement = document.getElementById('locationName' + fieldIDMap);
               locationNameElement.textContent = `Location: ${results[0].formatted_address}`;
           }
       });
   }
 
   function searchLocation() {
    const fieldIDMap = this.getAttribute('data-field-id');
    const searchInput = document.getElementById('searchInput' + fieldIDMap).value;
    const geocoder = new google.maps.Geocoder();
    
    const map = maps[fieldIDMap]; // Retrieve the correct map instance
    
    geocoder.geocode({ address: searchInput }, (results, status) => {
        if (status === google.maps.GeocoderStatus.OK && results.length > 0) {
            const latLng = results[0].geometry.location;

            if (malaysiaBounds.contains(latLng)) {
                map.setCenter(latLng);
                addMarker(latLng.lat(), latLng.lng(), fieldIDMap);
                
                const coordinatesElement = document.getElementById('coordinatesSearch' + fieldIDMap);
                coordinatesElement.textContent = `Latitude: ${latLng.lat().toFixed(6)}, Longitude: ${latLng.lng().toFixed(6)}`;
                
                reverseGeocode(latLng, fieldIDMap);
            } else {
                alert('Location is outside of Malaysia.');
            }
        } else {
            alert('Location not found.');
        }
    });
}

 
   const searchButtonGetAll = document.querySelectorAll('.search-buttonSearch');
    searchButtonGetAll.forEach(function (searchButton) {
    searchButton.addEventListener('click', searchLocation);
    const fieldIDMap = searchButton.getAttribute('data-field-id');
    initMap(fieldIDMap);
});
 </script>

  
@endsection