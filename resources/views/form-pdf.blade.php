<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
      .card-title.text-center.formType {
  text-align: center;
}

.card-title {
  font-size: 1.25rem;
  margin-bottom: 0.5rem;
}

hr {
  margin: 1rem 0;
  border: 0;
  border-top: 1px solid rgba(0, 0, 0, 0.1);
}

.card-body {
  padding: 1rem;
}

.row.mb-3 {
  margin-bottom: 1rem;
}

.col-sm-4.col-form-label b {
  font-weight: bold;
}

.col-sm-8 {
  flex: 0 0 auto;
  width: 66.666667%; /* 8-column layout for col-sm-8 */
  max-width: 66.666667%;
}

a {
  color: #007bff;
  text-decoration: none;
}
    </style>
</head>
<body>
    <div class="col d-flex justify-content-center">

        <div class="col-lg-8">
         <div class="text-center">
         
         </div>
          <div class="card">
            <hr>
            <form>
              @php
                $fields = json_decode($formData, true);
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
                            <div class="col-sm-8">
                              @if ($field['value'] == "No File")
                              No File Given
                              @else 
                              <a href="{{asset($field['value'])}}">View File</a>
                              @endif
                             
                             </div>
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
                               <p>- {{$item}}</p>
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
                           <img src="{{$field['value']}}" alt="">
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
    
        
        </div>
      
    </div>
</body>
</html>
