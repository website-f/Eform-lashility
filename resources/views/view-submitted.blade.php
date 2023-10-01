@extends('partial.main')

@section('title', 'View Form')

@section('content')

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
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body card-exportPDF">
                      @if ($submitted->subtitle == null & $submitted->logo == null)
                      <center><img class="img-fluid" style="padding-top: 30px" width="200" height="200" src="{{asset('images/lash.jpg')}}" alt=""></center>
                      <h5 class="card-title text-center formType">{{$submitted['type']}}</h5>
                      @else
                      @if ($submitted->logo == null)
                      <center></center>
                      @else
                      <center><img class="img-fluid" style="padding-top: 30px" width="200" height="200" src="{{asset($submitted->logo)}}" alt=""></center>
                      @endif
                      <h3 class="pt-3 text-center" style="color: #001689">{{$submitted->type}}</h3>
                      <p style="font-size: 13px" class="pt-0 text-center">{{$submitted->subtitle}}</p>
                      @endif
                      <hr>
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
                                          <button type="button" class="btn btnTagCheck btn-sm">{{$field['value']}}</button>
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
                                       <img src="{{asset( $field['value'] )}}" alt="">
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
               @if ($submitted->subtitle == null & $submitted->logo == null)
                   <center><img class="img-fluid" style="padding-top: 30px" width="200" height="200" src="{{asset('images/lash.jpg')}}" alt=""></center>
                   <h5 class="card-title text-center formType">{{$submitted['type']}}</h5>
                @else
                   @if ($submitted->logo == null)
                   <center></center>
                   @else
                   <center><img class="img-fluid" style="padding-top: 30px" width="200" height="200" src="{{asset($submitted->logo)}}" alt=""></center>
                   @endif
                <h3 class="pt-3 text-center" style="color: #001689">{{$submitted->type}}</h3>
                <p style="font-size: 13px" class="pt-0 text-center">{{$submitted->subtitle}}</p>
                @endif
              <hr>
              <form>
                  @php
                     $fields = json_decode($submitted->fields, true);
                     $hasTextLocation = false;
                  @endphp
                  @if (is_array($fields))
                      <div class="card-body">
                        @foreach ($fields as $field)
                          @if ($field['fieldType'] === 'text')
                              <div class="row mb-3">
                                <label for="inputText" class="col-sm-4 col-form-label"><b>{{ $field['label'] }}</b> :</label>
                                <div class="col-sm-8">
                                 <p>{{$field['value']}}</p>
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
                                  <button type="button" class="btn btnTagCheck btn-sm">{{$field['value']}}</button>
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
                               <img src="{{asset( $field['value'] )}}" alt="">
                              </div>
                            </div>
                          @endif

                        @endforeach
                      </div>

                  @else
                      No fields
                  @endif
                  @if ($submitted['approval'] == 'pending' && Auth::user()->role->role == "SuperAdmin")
                  <div class="d-grid gap-2 d-md-flex justify-content-center pt-2 mb-4">
                    <div class="row mb-3">
                      <p><b>Approval Status : </b> {{$submitted['approval']}}</p>
                      <div class="col-sm-8">
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#approveSubmission">
                          Approve
                        </button>
                        <div class="modal fade" id="approveSubmission" tabindex="-1">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Approve</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                Are you sure want to APPROVE this submission ?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a id="approveBtn" href="/approve/{{$submitted['id']}}" class="btn btn-outline-success">
                                  <i class="fas fa-spinner fa-spin" style="display: none;"></i>Sure</a>
                              </div>
                            </div>
                          </div>
                        </div><!-- End Vertically centered Modal-->
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#rejectSubmission">
                          Reject
                        </button>
                        <div class="modal fade" id="rejectSubmission" tabindex="-1">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Reject</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                Are you sure want to REJECT this submission ?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="/reject/{{$submitted['id']}}" class="btn btn-outline-danger">Sure</a>
                              </div>
                            </div>
                          </div>
                        </div><!-- End Vertically centered Modal-->
                      </div>
                    </div>
                </div>
                  @endif
                </form><!-- End General Form Elements -->

    </div>


  </div>

</div>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
@if ($hasTextLocation)
@if (!empty($latitude) && !empty($longitude))
<script>

  var latitude = {{ $latitude }};
  var longitude = {{ $longitude }};

  var map = L.map('map').setView([latitude, longitude], 13);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  L.marker([latitude, longitude]).addTo(map)
      .bindPopup('Your location').openPopup();

  // Fetch location name using reverse geocoding
  fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}`)
      .then(response => response.json())
      .then(data => {
          var locationName = data.display_name;
          document.getElementById('locationName').innerText = locationName;
      })
      .catch(error => console.error('Error fetching location data:', error));

 </script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
      var approveBtn = document.getElementById('approveBtn');
      var spinnerIcon = approveBtn.querySelector('.fa-spinner');

      approveBtn.addEventListener('click', function() {
          // Show the loading spinner
          spinnerIcon.style.display = 'block';

          // Disable the button to prevent multiple clicks
          approveBtn.setAttribute('disabled', 'disabled');

          // Optionally, you can redirect to the link after a short delay
          // setTimeout(function() {
          //     window.location.href = approveBtn.getAttribute('href');
          // }, 1000);
      });
  });
</script>


 @endif
@endif

@endsection
