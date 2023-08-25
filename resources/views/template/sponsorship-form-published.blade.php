@extends('partial.publishmain')

@section('title', 'View Form')
    
@section('content')

<div class="col d-flex justify-content-center">

  <div class="col-lg-6">
    
    <div class="card">
      <div id="loading-screen-published" style="display: none;">
        Sending Your Form...  <div class="spinner-border" style="width: 50px; height: 50px;" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
    </div>
        <div class="text-center pt-2">
          
        </div>

        <!--<div class="text-center pt-2">
        <img src="" alt="" class="img-fluid" width="200px" height="200px">
        </div>-->
        <center><img style="padding-top: 30px" width="300" height="100" src="{{asset('images/Artboard-5.png')}}" alt=""></center>
              <h5 class="card-title text-center formTypeTemp">Intake & Consent Form</h5>
              <input type="hidden" id="idInput" class="formPublisher" value="">
              <input type="approval" name="approval" id="approval" class="formFieldHide" value="No">
              <hr>
              <!-- Multi Columns Form -->
              <form class="row g-3" id="paginationForm">
                  <!-- Page 1 -->
                  <div class="page page1 p-5 pt-2">
                    <h2>Client Information</h2>
                    <hr>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Your Name</b></label>
                      <input type="text" name="text" class="form-control inputTypeTemp" required>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Birth Date</b></label>
                      <input type="date" name="date" class="form-control inputTypeTemp" required>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label for="inputText" class="form-label form-labelTemp"><b>Address</b></label>
                      <input type="location" class="inputTypeTemp formFieldHide">
                      <div class="col-sm-10 input-group">
                          <input class="form-control" type="text" id="searchInput" placeholder="Search for a location">
                          <a class="btn btn-success" id="searchButton">Search</a>
                      </div>
                          <div class="val" id="coordinatesSearch"></div>
                          <p id="locationName"></p>
                          <div id="map"></div>
                          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPyDbSSao5JOxiTLETXEU7neCpLqpxiwE&libraries=places"></script>
                          <script>
                           let map;
                           let marker;
                           const malaysiaBounds = new google.maps.LatLngBounds(
                               new google.maps.LatLng(-1.0, 99.6),
                               new google.maps.LatLng(7.4, 119.3)
                           );
                         
                           function initMap() {
                               map = new google.maps.Map(document.getElementById('map'), {
                                   center: { lat: 4.2105, lng: 101.9758 }, // Initial focus on Malaysia
                                   zoom: 6
                               });
                         
                               map.addListener('click', (event) => {
                                   addMarker(event.latLng.lat(), event.latLng.lng());
                               });
                         
                               const searchInput = document.getElementById('searchInput');
                               const autocomplete = new google.maps.places.Autocomplete(searchInput);
                           }
                         
                           function addMarker(lat, lng) {
                               if (marker) {
                                   marker.setMap(null); // Remove the previous marker from the map
                               }
                         
                               marker = new google.maps.Marker({
                                   position: { lat: lat, lng: lng },
                                   map: map,
                                   draggable: true
                               });
                         
                               marker.addListener('dragend', (event) => {
                                   const updatedLatLng = event.latLng;
                                   const lat = updatedLatLng.lat().toFixed(6);
                                   const lng = updatedLatLng.lng().toFixed(6);
                         
                                   const coordinatesElement = document.getElementById('coordinatesSearch');
                                   coordinatesElement.textContent = `Latitude: ${lat}, Longitude: ${lng}`;
                         
                                   reverseGeocode(updatedLatLng);
                               });
                           }
                         
                           function reverseGeocode(latLng) {
                               const geocoder = new google.maps.Geocoder();
                         
                               geocoder.geocode({ location: latLng }, (results, status) => {
                                   if (status === google.maps.GeocoderStatus.OK && results.length > 0) {
                                       const locationNameElement = document.getElementById('locationName');
                                       locationNameElement.textContent = `Location: ${results[0].formatted_address}`;
                                   }
                               });
                           }
                         
                           function searchLocation() {
                               const searchInput = document.getElementById('searchInput').value;
                               const geocoder = new google.maps.Geocoder();
                         
                               geocoder.geocode({ address: searchInput }, (results, status) => {
                                   if (status === google.maps.GeocoderStatus.OK && results.length > 0) {
                                       const latLng = results[0].geometry.location;
                         
                                       if (malaysiaBounds.contains(latLng)) {
                                           map.setCenter(latLng);
                                           addMarker(latLng.lat(), latLng.lng());
                         
                                           const coordinatesElement = document.getElementById('coordinatesSearch');
                                           coordinatesElement.textContent = `Latitude: ${latLng.lat().toFixed(6)}, Longitude: ${latLng.lng().toFixed(6)}`;
                         
                                           reverseGeocode(latLng);
                                       } else {
                                           alert('Location is outside of Malaysia.');
                                       }
                                   } else {
                                       alert('Location not found.');
                                   }
                               });
                           }
                         
                           const searchButton = document.getElementById('searchButton');
                           searchButton.addEventListener('click', searchLocation);
                         
                           initMap();
                         </script>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Telephone</b></label>
                      <input type="text" name="text" class="form-control inputTypeTemp" required>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Email</b></label>
                      <input type="email" name="email" class="form-control inputTypeTemp" required>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>How did you hear about us ?</b></label>
                      <input type="radio" class="formFieldHide inputTypeTemp">
                       <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck1" value="Website">
                          <label class="form-check-label">
                            Website
                          </label>
                        </div>
    
                        <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck2" value="Tiktok">
                          <label class="form-check-label">
                            Tiktok
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck1" value="Google/Social Media">
                          <label class="form-check-label">
                            Google/Social Media
                          </label>
                        </div>
    
                        <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck2" value="Friends">
                          <label class="form-check-label">
                            Friends
                          </label>
                        </div>
                        
                        <div class="form-check">
                          <input class="form-check-input" type="radio" id="eventType" value="">
                          <input type="text" placeholder="other" class="form-control" onchange="updateCheckboxValue1(this)">
                        </div>
                        <script>
                          function updateCheckboxValue1(inputElement) {
                              // Get the checkbox element by ID
                              var checkbox = document.getElementById('eventType');
                              
                              // Set the value of the checkbox to the value of the text input
                              checkbox.value = inputElement.value;
                          }
                      </script>
                  </div><br>
                  <div class="col-md-12 fieldTypeTemp">
                    <label class="form-label form-labelTemp"><b>Visit Outlet</b></label>
                    <input type="radio" class="formFieldHide inputTypeTemp">
                     <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridCheck1" value="Bangsar Telawi">
                        <label class="form-check-label">
                          Bangsar Telawi
                        </label>
                      </div>
  
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridCheck2" value="Bangsar Shopping Mall">
                        <label class="form-check-label">
                          Bangsar Shopping Mall
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridCheck1" value="IOI City Mall">
                        <label class="form-check-label">
                          IOI City Mall
                        </label>
                      </div>
  
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridCheck2" value="My Town">
                        <label class="form-check-label">
                          My Town
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridCheck1" value="Pavilion 2">
                        <label class="form-check-label">
                          Pavilion 2
                        </label>
                      </div>
  
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridCheck2" value="Camp">
                        <label class="form-check-label">
                         Setia City Mall
                        </label>
                      </div>
                      
                  </div><br>
                    <hr>
                    <h2>Questions</h2>
                    <hr>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Is this your first time you have eyelash extensions/lash lift/brow lamination?</b></label>
                      <input type="radio" class="formFieldHide inputTypeTemp">
                       <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck1" value="Yes">
                          <label class="form-check-label">
                            Yes
                          </label>
                        </div>
    
                        <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck2" value="No">
                          <label class="form-check-label">
                            No
                          </label>
                        </div>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Do you</b></label>
                      <input type="radio" class="formFieldHide inputTypeTemp">
                       <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck1" value="Curl">
                          <label class="form-check-label">
                            Curl
                          </label>
                        </div>
    
                        <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck2" value="Perm">
                          <label class="form-check-label">
                            Perm
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck2" value="Tint your lashes">
                          <label class="form-check-label">
                            Tint your lashes
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck2" value="No">
                          <label class="form-check-label">
                            No
                          </label>
                        </div>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Are you getting your lash extensions. lash lift, or brow lamination applied for</b></label>
                      <input type="radio" class="formFieldHide inputTypeTemp">
                       <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck1" value="a special occasion">
                          <label class="form-check-label">
                            a special occasion
                          </label>
                        </div>
    
                        <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck2" value="regular daily use">
                          <label class="form-check-label">
                            regular daily use
                          </label>
                        </div>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Do you habitually rub or pull your lashes for any reason ?</b></label>
                      <input type="radio" class="formFieldHide inputTypeTemp">
                       <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck1" value="Yes">
                          <label class="form-check-label">
                            Yes
                          </label>
                        </div>
    
                        <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck2" value="No">
                          <label class="form-check-label">
                            No
                          </label>
                        </div>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Do you have or are you being treated for any eye illness or injury ?</b></label>
                      <input type="radio" class="formFieldHide inputTypeTemp">
                       <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck1" value="Yes">
                          <label class="form-check-label">
                            Yes
                          </label>
                        </div>
    
                        <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck2" value="No">
                          <label class="form-check-label">
                            No
                          </label>
                        </div>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Do you able to keep your eye's closed and lie still for up 2 hours?</b></label>
                      <input type="radio" class="formFieldHide inputTypeTemp">
                       <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck1" value="Yes">
                          <label class="form-check-label">
                            Yes
                          </label>
                        </div>
    
                        <div class="form-check">
                          <input class="form-check-input" type="radio" id="gridCheck2" value="No">
                          <label class="form-check-label">
                            No
                          </label>
                        </div>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Please include any of the following options that apply to you</b></label>
                      <input type="checkbox" class="formFieldHide inputTypeTemp">
                       <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheck1" value="Lash Eye Surgery">
                          <label class="form-check-label">
                            Lash Eye Surgery
                          </label>
                        </div>
    
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheck2" value="Permanent Eye Make Up">
                          <label class="form-check-label">
                            Permanent Eye Make Up
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheck1" value="Blepharoplasty (Eye Lift)">
                          <label class="form-check-label" for="gridCheck1">
                            Blepharoplasty (Eye Lift)
                          </label>
                        </div>
    
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheck2" value="Allergies to adhesives or synthetics">
                          <label class="form-check-label">
                            Allergies to adhesives or synthetics
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheck1" value="Hypersensitivity to cyanoacrylate or formaldehyde or certain adhesives/glues">
                          <label class="form-check-label">
                            Hypersensitivity to cyanoacrylate or formaldehyde or certain adhesives/glues
                          </label>
                        </div>
    
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheck2" value="Major surgery within last 120 days">
                          <label class="form-check-label">
                           Major surgery within last 120 days
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheck1" value="Cherntherapeutic agents used in cancer treatments">
                          <label class="form-check-label">
                            Cherntherapeutic agents used in cancer treatments
                          </label>
                        </div>
                  </div><br>
                    <hr>
                    <h2>Lash Chart (Fill by professional)</h2>
                    <hr>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Lashes</b></label>
                      <input type="text" name="text" class="form-control inputTypeTemp" required>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Lash Design</b></label>
                      <input type="text" name="text" class="form-control inputTypeTemp" required>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Lash Length</b></label>
                      <input type="text" name="text" class="form-control inputTypeTemp" required>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Lash Curl</b></label>
                      <input type="text" name="text" class="form-control inputTypeTemp" required>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Lash Type</b></label>
                      <input type="text" name="text" class="form-control inputTypeTemp" required>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Lash Stylist</b></label>
                      <input type="text" name="text" class="form-control inputTypeTemp" required>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Remarks</b></label>
                      <input type="text" name="text" class="form-control inputTypeTemp" required>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <div class="form-check">
                        <input type="checkbox" class="formFieldHide inputTypeTemp">
                        <input class="form-check-input inputTypeTemp" type="checkbox" id="gridCheck1" value="I agree to terms & conditions">
                        <label class="form-check-label form-labelTemp">
                          <b>I AGREE TO THE FOLLOWING. </b>
                        </label>
                      </div>
                      <textarea class="form-control" name="" id="" cols="30" rows="10" readonly>
TERMS AND CONDITIONS
a) I understand there are risks associated with having artificial eyelashes applied to and / or removed from my natural eyelashes.

b) I understand that the eyelash extensions will be applied to the natural lash as determined by the technician so as not to create excessive weight on the natural eyelash thereby preserving the health,
growth, and natural look of the client's natural eyelashes.

c) I understand as part of the procedure eye irritation, eye pain, eye itching, discomfort and in rare cases eye infection may occur.

d) I understand and agree that if I experience any of these issues with my lashes that I will contact my technician and have to remove eyelashes immediately and consult a physician at my own expense. understand that even though my technician may apply and remove the eyelash properly, that adhesive materials may become dislodged during or after the procedure. 

e) I understand and agree to follow the after care instructions provided by the technician. Failure to follow the after care instructions can cause the eyelash to fall off.

f) I understand in order to have the eyelash extensions applied to my eyelashes I will need to keep my eye closes for 60-100 minutes during the procedure. I also need to understand that I will be lying down on a reclined position.

g) This agreement will remain in effect of the procedure and all future procedures conducted by my technician from one year from the date of this form is signed. I understand that this agreement is binding and that I have read and understand all the information listed above
                      </textarea>
                      </div><br>
                      <hr>
                      <h2>Confirmation</h2>
                      <hr>
                      <div class="col-md-12 fieldTypeTemp">
                        <label class="form-label form-labelTemp"><b>Date</b></label>
                        <input type="date" name="date" class="form-control inputTypeTemp" required>
                      </div><br>
                      <div class="col-12 pt-2 fieldTypeTemp">
                        <label class="form-label form-labelTemp"><b>Signature</b></label>
                        <div class="col-sm-10">
                           <canvas class="canvasBack" name="signature" id="signatureCanvas" width="400" height="200"></canvas>
                           <br>
                           <button type="button" id="clearButton">Clear</button>
                           
                           <input type="Signature" class="inputTypeTemp formFieldHide">
                        </div>
                      </div>
                  </div>
              
                  
                  <div class="text-center d-grid gap-2 d-md-flex justify-content-center pt-2 mb-4">
                    <hr>
                    
                    <button type="button" class="btn btn-success" id="tempsubmit-btn">Submit</button>
                  </div>
                </form><!-- End Multi Columns Form -->


    </div>
  </div>

</div>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    // Function to get the current location
    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                var currentLocation = [latitude, longitude];

                // Display the coordinates
                document.getElementById("coordinates").innerHTML = "Latitude: " + latitude + ", Longitude: " + longitude;

                // Initialize the map
                var map = L.map('map').setView(currentLocation, 15);

                // Add a tile layer to the map (OpenStreetMap)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // Add a marker for the current location
                L.marker(currentLocation).addTo(map);
            }, function(error) {
                console.error("Error getting the current location: ", error);
            });
        } else {
            console.error("Geolocation is not supported by this browser.");
        }
    }

    // Call the function to get the current location when the button is clicked
    document.getElementById("getLocationBtn").addEventListener("click", getCurrentLocation);
</script>

<script>
    let currentPage = 1;
    const formPages = document.querySelectorAll('.page');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('tempsubmit-btn');
    const resetBtn = document.getElementById('resetBtn');
  
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
    if (currentPage === 1) {
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'block';
        submitBtn.style.display = 'none';
        resetBtn.style.display = 'none';
    } else if (currentPage === formPages.length) {
        prevBtn.style.display = 'block';
        nextBtn.style.display = 'none';

        // Show the submit button on the last page
        submitBtn.style.display = 'block';

        resetBtn.style.display = 'block';
    } else {
        prevBtn.style.display = 'block';
        nextBtn.style.display = 'block';
        submitBtn.style.display = 'none';
        resetBtn.style.display = 'none';
    }
}
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
  
    function nextPage() {
      if (currentPage < formPages.length) {
        currentPage++;
        showPage(currentPage);
        topFunction()
        updateButtonVisibility();
      }
    }
  
    function prevPage() {
      if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
        topFunction()
        updateButtonVisibility();
      }
    }
  
    showPage(currentPage);
    updateButtonVisibility();

    function validatePage(pageNum) {
        // Skip validation on the last page
        if (pageNum === formPages.length) {
            return true;
        }

        const currentPageInputs = formPages[pageNum - 1].querySelectorAll('input[required]');
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
        if (currentPage < formPages.length && validatePage(currentPage)) {
            currentPage++;
            showPage(currentPage);
            updateButtonVisibility();
        }
    }
  </script>
  
  <script>
    // Get the URL of the current page
    var currentUrl = window.location.href;
    
    // Use regular expression to extract the dynamic segment and ID from the URL
    var dynamicSegmentRegex = /\/sponsor-publish\/([^/]+)/;
    var matches = currentUrl.match(dynamicSegmentRegex);
    
    if (matches && matches.length >= 2) {
        var dynamicValue = matches[1];
        
        // Set the value of the input field to the extracted dynamic value
        document.getElementById('idInput').value = dynamicValue;
    }
  </script>
  <script>
    const quantityInputs = document.querySelectorAll('.quantityInput');
    const totalCartonsInput = document.getElementById('totalCartons');

    quantityInputs.forEach(input => {
        input.addEventListener('input', calculateTotalCartons);
    });

    function calculateTotalCartons() {
        let totalCartons = 0;
        quantityInputs.forEach(input => {
            const quantity = parseInt(input.value) || 0;
            totalCartons += quantity;
        });
        totalCartonsInput.value = totalCartons;
    }
</script>
<script>
  let rowater = document.querySelector('.rowater')
  let rowatervalue = document.querySelector('.rowaterValue')
  let rowaterbottle = document.querySelector('.rowaterbottle')
  let rowaterbottlevalue = document.querySelector('.rowaterBottleValue')
  let rowaterbottleL = document.querySelector('.rowaterBottleL')
  let rowaterbottleLvalue = document.querySelector('.rowaterBottleLValue')

  rowater.addEventListener('input', calculaterowater);

  function calculaterowater() {
    let totalcups = 48;
    const quantity = parseInt(rowater.value) || 0
    totalcups *= quantity;

    rowatervalue.textContent = totalcups + " Cups"
  }

  rowaterbottle.addEventListener('input', calculaterowaterbottle);

  function calculaterowaterbottle() {
    let totalbottles = 24;
    const quantityBottle = parseInt(rowaterbottle.value) || 0
    totalbottles *= quantityBottle;

    rowaterbottlevalue.textContent = totalbottles + " Bottles"
  }

  rowaterbottleL.addEventListener('input', calculaterowaterbottleL);

  function calculaterowaterbottleL() {
    let totalbottlesL = 12;
    const quantityBottleL = parseInt(rowaterbottleL.value) || 0
    totalbottlesL *= quantityBottleL;

    rowaterbottleLvalue.textContent = totalbottlesL + " Bottles"
  }
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
  
@endsection