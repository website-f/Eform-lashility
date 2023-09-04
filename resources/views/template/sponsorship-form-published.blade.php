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
        <center><img class="img-fluid" style="padding-top: 30px" width="500" height="300" src="{{asset('images/lash.jpg')}}" alt=""></center>
        <h3 class="pt-3 text-center formTypeTemp">INTAKE & CONSENT FORM</h3>
        <p style="font-size: 13px" class="pt-0 text-center formSub">Eyelash Extensions | Keratin Lash lift | Brow Lamination</p>
        <input type="hidden" id="idInput" class="formLogo" value="/images/lash.jpg">
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
                      <label class="form-label form-labelTemp"><b>Age</b></label>
                      <input type="text" name="text" class="form-control inputTypeTemp" required>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Race</b></label>
                      <input type="radio" class="formFieldHide inputTypeTemp">
                       <div class="form-check">
                          <input class="form-check-input" type="radio"  name="race" id="gridCheck1" value="Malay">
                          <label class="form-check-label">
                            Malay
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="race" id="gridCheck2" value="Chinese">
                          <label class="form-check-label">
                           Chinese
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="race" id="gridCheck1" value="Indian">
                          <label class="form-check-label">
                            Indian
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio"  name="race" id="eventType" value="">
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
                      <label class="form-label form-labelTemp"><b>Occupation</b></label>
                      <input type="text" name="text" class="form-control inputTypeTemp" required>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Address</b></label>
                      <input type="text" name="text" class="form-control inputTypeTemp" required>
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
                          <input class="form-check-input" type="radio" name="how" id="gridCheck1" value="Website">
                          <label class="form-check-label">
                            Website
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio"  name="how" id="gridCheck2" value="Tiktok">
                          <label class="form-check-label">
                            Tiktok
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio"  name="how" id="gridCheck1" value="Google/Social Media">
                          <label class="form-check-label">
                            Google/Social Media
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio"  name="how" id="gridCheck2" value="Friends">
                          <label class="form-check-label">
                            Friends
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio"  name="how" id="eventType" value="">
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
                        <input class="form-check-input" type="radio" name="outlet" id="gridCheck1" value="Bangsar Telawi">
                        <label class="form-check-label">
                          Bangsar Telawi
                        </label>
                      </div>

                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="outlet" id="gridCheck2" value="Bangsar Shopping Mall">
                        <label class="form-check-label">
                          Bangsar Shopping Mall
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="outlet" id="gridCheck1" value="IOI City Mall">
                        <label class="form-check-label">
                          IOI City Mall
                        </label>
                      </div>

                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="outlet" id="gridCheck2" value="My Town">
                        <label class="form-check-label">
                          My Town
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="outlet" id="gridCheck1" value="Pavilion 2">
                        <label class="form-check-label">
                          Pavilion 2
                        </label>
                      </div>

                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="outlet" id="gridCheck2" value="Camp">
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
                          <input class="form-check-input" type="radio" name="first" id="gridCheck1" value="Yes">
                          <label class="form-check-label">
                            Yes
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="first" id="gridCheck2" value="No">
                          <label class="form-check-label">
                            No
                          </label>
                        </div>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Do you</b></label>
                      <input type="radio" class="formFieldHide inputTypeTemp">
                       <div class="form-check">
                          <input class="form-check-input" type="radio" name="do" id="gridCheck1" value="Curl">
                          <label class="form-check-label">
                            Curl
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="do" id="gridCheck2" value="Perm">
                          <label class="form-check-label">
                            Perm
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="do" id="gridCheck2" value="Tint your lashes">
                          <label class="form-check-label">
                            Tint your lashes
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="do" id="gridCheck2" value="No">
                          <label class="form-check-label">
                            No
                          </label>
                        </div>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Are you getting your lash extensions. lash lift, or brow lamination applied for</b></label>
                      <input type="radio" class="formFieldHide inputTypeTemp">
                       <div class="form-check">
                          <input class="form-check-input" type="radio" name="are" id="gridCheck1" value="a special occasion">
                          <label class="form-check-label">
                            a special occasion
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="are" id="gridCheck2" value="regular daily use">
                          <label class="form-check-label">
                            regular daily use
                          </label>
                        </div>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Do you habitually rub or pull your lashes for any reason ?</b></label>
                      <input type="radio" class="formFieldHide inputTypeTemp">
                       <div class="form-check">
                          <input class="form-check-input" type="radio" name="habit" id="gridCheck1" value="Yes">
                          <label class="form-check-label">
                            Yes
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="habit" id="gridCheck2" value="No">
                          <label class="form-check-label">
                            No
                          </label>
                        </div>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Do you have or are you being treated for any eye illness or injury ?</b></label>
                      <input type="radio" class="formFieldHide inputTypeTemp">
                       <div class="form-check">
                          <input class="form-check-input" type="radio" name="illness" id="gridCheck1" value="Yes">
                          <label class="form-check-label">
                            Yes
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="illness" id="gridCheck2" value="No">
                          <label class="form-check-label">
                            No
                          </label>
                        </div>
                    </div><br>
                    <div class="col-md-12 fieldTypeTemp">
                      <label class="form-label form-labelTemp"><b>Do you able to keep your eye's closed and lie still for up 2 hours?</b></label>
                      <input type="radio" class="formFieldHide inputTypeTemp">
                       <div class="form-check">
                          <input class="form-check-input" type="radio" name="eye" id="gridCheck1" value="Yes">
                          <label class="form-check-label">
                            Yes
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="eye" id="gridCheck2" value="No">
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
                           <canvas class="canvasBack" name="signature" id="signatureCanvas" width="250" height="200"></canvas>
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
    // Get the URL of the current page
    var currentUrl = window.location.href;

    // Use regular expression to extract the dynamic segment and ID from the URL
    var dynamicSegmentRegex = /\/sponsor\/([^/]+)/;
    var matches = currentUrl.match(dynamicSegmentRegex);

    if (matches && matches.length >= 2) {
        var dynamicValue = matches[1];

        // Set the value of the input field to the extracted dynamic value
        document.getElementById('idInput').value = dynamicValue;
    }
  </script>
<script>
 document.addEventListener('DOMContentLoaded', function () {
  const canvas = document.getElementById('signatureCanvas');
  const clearButton = document.getElementById('clearButton');
  const savedSignature = document.getElementById('savedSignature');

  const context = canvas.getContext('2d');
  let isDrawing = false;

  function getEventPos(canvasDom, event) {
    const rect = canvasDom.getBoundingClientRect();
    const clientX = event.clientX || event.touches[0].clientX;
    const clientY = event.clientY || event.touches[0].clientY;
    return {
      x: clientX - rect.left,
      y: clientY - rect.top
    };
  }

  function startDrawing(event) {
    const pos = getEventPos(canvas, event);
    context.beginPath();
    context.moveTo(pos.x, pos.y);
    isDrawing = true;
  }

  function continueDrawing(event) {
    if (!isDrawing) return;

    const pos = getEventPos(canvas, event);

    context.lineWidth = 2;
    context.lineCap = 'round';
    context.strokeStyle = '#000';

    context.lineTo(pos.x, pos.y);
    context.stroke();
    context.beginPath();
    context.moveTo(pos.x, pos.y);
  }

  function stopDrawing() {
    isDrawing = false;
  }

  canvas.addEventListener('mousedown', startDrawing);
  canvas.addEventListener('touchstart', (event) => {
    event.preventDefault(); // Prevent touch event from scrolling
    startDrawing(event.touches[0]);
  });

  canvas.addEventListener('mousemove', continueDrawing);
  canvas.addEventListener('touchmove', (event) => {
    event.preventDefault(); // Prevent touch event from scrolling
    continueDrawing(event.touches[0]);
  });

  canvas.addEventListener('mouseup', stopDrawing);
  canvas.addEventListener('touchend', stopDrawing);

  clearButton.addEventListener('click', () => {
    context.clearRect(0, 0, canvas.width, canvas.height);
  });
});

  </script>

@endsection
