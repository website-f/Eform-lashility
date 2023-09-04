@extends('partial.main')

@section('title', 'View Form')

@section('content')

<div class="col d-flex justify-content-center">

  <div class="col-lg-5">

    <div class="card">
        @foreach ($form as $forms)
        <div class="text-center pt-2">
          @php
    $encodedType = str_replace(' ', '%20', urlencode($forms->type));
@endphp
          <a class="btn btn-outline-success btn-sm" href="{{ route('form.publish', ['type' => $forms->slug , 'id' => Auth::user()->id]) }}" target="_blank">Publish Form</a>
          <!-- Readonly input field styled like a label to store the link -->


          <button id="copyLinkBtn" class="btn btn-outline-primary btn-sm">Copy Link</button>
          <input type="text" id="formLink" value="http://e-form.lashility.com/form-publish/{{$forms->slug}}/{{Auth::user()->id}}" readonly>
          <span id="copyStatus" class="ms-3" style="display: none;">Link Copied!</span>
        </div>
        @if ($forms->logo !== null)
        <center><img class="img-fluid" style="padding-top: 30px" width="500" height="300" src="{{$forms->logo}}" alt=""></center>
        @else
        @endif
              <h5 class="card-title text-center formType"><span>(Created by: {{$forms->user->name}})</span></h5>
              <h3 class="pt-3 text-center formTypeTemp">{{$forms->type}} Form</h3>
              <p style="font-size: 13px" class="pt-0 text-center formTypeTemp">{{$forms->subtitle}}</p>
              <hr>

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
                        @foreach ($fields as $index => $field)
                        @if ($field['type'] === 'Heading')
                        <h2 class="text-center">{{$field['label']}}</h2>
                        <p class="text-center">{{$field['subheading']}}</p>
                        <hr>
                        @elseif ($field['type'] === 'termscondition')
                        <div class="form-check">
                          <input class="form-check-input val" type="checkbox" id="gridCheck1" name="checkbox" value="">
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
                        </div>

                          @elseif ($field['type'] === 'text')
                              <div class="col-12 pt-2 fieldType">
                                @if (isset($field['approval']))
                                    <input class="formFieldHide" name="approval" type="approval" value="{{$field['approval']}}">
                                @else

                                @endif
                                <label for="inputText" class="form-label"><b>{{ $field['label'] }}</b></label>
                                <input type="text" name="text" class="form-control val">
                                <input type="{{$field['type']}}" class="inputType formFieldHide">

                              </div><br>
                          @elseif ($field['type'] === 'email')
                              <div class="col-12 pt-2 fieldType">
                                @if (isset($field['approval']))
                                    <input class="formFieldHide" name="approval" type="approval" value="{{$field['approval']}}">
                                @else

                                @endif
                                <label for="inputText" class="form-label"><b>{{ $field['label'] }}</b></label>
                                <input type="text" name="text" class="form-control val">
                                <input type="{{$field['type']}}" class="inputType formFieldHide">

                              </div><br>
                          @elseif ($field['type'] === 'textarea')
                              <div class="col-12 pt-2 fieldType">
                                <label for="inputPassword" class="form-label"><b>{{$field['label']}}</b></label>
                                <textarea class="form-control val" name="textarea" style="height: 100px"></textarea>
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                              </div><br>
                          @elseif ($field['type'] === 'file allFile')
                              <div class="col-12 pt-2 fieldType">
                                <label for="inputNumber" class="form-label"><b>{{$field['label']}}</b></label>
                                <input class="form-control val" name="file allFile" type="file" id="formFile" multiple>
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                              </div><br>
                          @elseif ($field['type'] === 'date')
                              <div class="col-12 pt-2 fieldType">
                                <label for="inputDate" class="form-label"><b>{{$field['label']}}</b></label>
                                <input type="date" class="form-control val" name="date">
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                              </div><br>
                          @elseif ($field['type'] === 'time')
                              <div class="col-12 pt-2 fieldType">
                                <label for="inputTime" class="form-label"><b>{{$field['label']}}</b></label>
                                <input type="time" class="form-control val" name="time">
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                              </div><br>
                          @elseif ($field['type'] === 'select')
                              <div class="col-12 pt-2 fieldType">
                                <label class="form-label"><b>{{$field['label']}}</b></label>
                                  <select class="form-select val" aria-label="Default select example" name="select">
                                    @foreach ($field['selectOption'] as $opt)
                                       <option value="{{$opt}}">{{$opt}}</option>
                                    @endforeach
                                  </select>
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                              </div><br>
                          @elseif ($field['type'] === 'checkbox')
                              <div class="col-12 fieldType">
                                <legend class="col-form-label form-label pt-2"><b>{{$field['label']}}</b></legend>
                                  @foreach ($field['checkValues'] as $opt)
                                  <div class="form-check">
                                    <input class="form-check-input val" type="checkbox" id="gridCheck1" name="checkbox" value="{{$opt}}">
                                    <label class="form-check-label" for="gridCheck1">
                                      {{$opt}}
                                    </label>
                                  </div>
                                  @endforeach
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                              </div><br>
                            @elseif ($field['type'] === 'radio')
                              <fieldset class="col-12 fieldType">
                                <legend class="col-form-label form-label pt-2"><b>{{$field['label']}}</b></legend>
                                  @foreach ($field['radioValues'] as $item)
                                  <div class="form-check">
                                    <input class="form-check-input val" type="radio" name="radio{{$field['fieldID']}}" id="{{$field['fieldID']}}" value="{{$item}}">
                                    <label class="form-check-label" for="gridRadios1">
                                      {{$item}}
                                    </label>
                                  </div>
                                  @endforeach
                                <input type="{{$field['type']}}" class="inputType formFieldHide">
                              </fieldset><br>
                            @elseif ($field['type'] === 'text datetime')
                              <div class="col-12 pt-2 fieldType" >
                                <label for="inputText" class="form-label"><b>{{$field['label']}}</b></label>
                                <input type="text" name="datetime" class="form-control val" id="reservationdatetime">
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
                                         <input type="hidden" name="starrating" id="rating-value">
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
                        @elseif ($field['type'] === 'Signature')
                        <div class="col-12 pt-2 fieldType">
                          <label class="form-label"><b>{{$field['label']}}</b></label>
                          <div class="col-sm-10">
                             <canvas class="canvasBack" name="signature" id="signatureCanvas" width="400" height="200"></canvas>
                             <br>
                             <button id="clearButton">Clear</button>

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
                    <button type="button" class="btn btn-primary" id="prev-btn" onclick="navigatePage(-1)">Previous</button>
                    <button type="button" class="btn btn-primary" id="next-btn" onclick="navigatePage(1)">Next</button>
                    <button type="button" class="btn btn-success" id="submit" style="display: none;">Submit</button>
                  </div>

                <!-- End General Form Elements -->
      @endforeach

    </div>
  </div>

</div>

<script>
  // JavaScript function to handle form navigation
  function navigatePage(step) {
      const pages = document.querySelectorAll('.page-content');
      let currentPageNumber = 0;

      pages.forEach((page, index) => {
          if (page.style.display === 'block') {
              currentPageNumber = index + 1;
          }
      });

      let nextPageNumber = currentPageNumber + step;
      if (nextPageNumber < 1) {
          nextPageNumber = 1;
      } else if (nextPageNumber > pages.length) {
          nextPageNumber = pages.length;
      }

      pages.forEach((page, index) => {
          page.style.display = index + 1 === nextPageNumber ? 'block' : 'none';
      });

      document.getElementById('prev-btn').style.display = nextPageNumber === 1 ? 'none' : 'block';
      document.getElementById('next-btn').style.display = nextPageNumber === pages.length ? 'none' : 'block';
      document.getElementById('submit').style.display = nextPageNumber === pages.length ? 'block' : 'none';

      // Update pagination indicators (optional)
      const pageIndicators = document.querySelectorAll('.page-indicator');
      pageIndicators.forEach((indicator, index) => {
          indicator.classList.remove('active');
          if (index + 1 === nextPageNumber) {
              indicator.classList.add('active');
          }
      });
  }

  // Show the first page initially
  navigatePage(0);
</script>
<script>
  // Function to copy the link to the clipboard
  function copyLink() {
    var linkInput = document.getElementById('formLink');

    linkInput.select();
    linkInput.setSelectionRange(0, 99999); // For mobile devices

    document.execCommand('copy');

    // Show the "Link Copied!" message for a short time
    var copyStatus = document.getElementById('copyStatus');
    copyStatus.style.display = 'inline';
    setTimeout(function () {
      copyStatus.style.display = 'none';
    }, 1500);
  }

  // Add click event listener to the "Copy Link" button
  var copyLinkBtn = document.getElementById('copyLinkBtn');
  copyLinkBtn.addEventListener('click', copyLink);
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










