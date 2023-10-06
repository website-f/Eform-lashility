<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container {
            padding: 30px;
            justify-content: center;
            font-family: "Helvetica";
        }
        .logo {
            width: 350px;
            height: 75px;
        }
        .formFields {
            display: grid;
            grid-template-columns: auto auto;
            margin-top: 30px;
        }
        .btn {
            padding: 8px;
            background-color: #A1C2F1;
            border: none;
            border-radius: 6px;
        }
    </style>
</head>
<body>
  <div class="container">
    <center><h2>{{$formTitle}}</h3></center>
    <hr>
    <div>
      @php
        $fields = json_decode($formData, true);
      @endphp
      @if (is_array($fields))
        @foreach ($fields as $field)
            @if ($field['fieldType'] === 'Heading')
              <hr>
                <div><h2>{{ $field['label'] }}</h2>
                      <p>{{$field['value']}}</p></div>
              <hr>
            @elseif ($field['fieldType'] === 'text')
              <div class="formFields">
                <div><b>{{ $field['label'] }}</b> :</div>
                <div><p>{{ $field['value'] }}</p></div>
              </div>
            @elseif ($field['fieldType'] === 'email')
              <div class="formFields">
                <div><b>{{ $field['label'] }}</b> :</div>
                <div><p>{{ $field['value'] }}</p></div>
              </div>
            @elseif ($field['fieldType'] === 'textarea')
              <div class="formFields">
                <div><b>{{ $field['label'] }}</b> :</div>
                <div><p>{{ $field['value'] }}</p></div>
              </div>
           
            @elseif ($field['fieldType'] === 'date')
              <div class="formFields">
                <div><b>{{ $field['label'] }}</b> :</div>
                <div><p>{{ $field['value'] }}</p></div>
              </div>
            @elseif ($field['fieldType'] === 'time')
              <div class="formFields">
                <div><b>{{ $field['label'] }}</b> :</div>
                <div><p>{{ $field['value'] }}</p></div>
              </div>
            @elseif ($field['fieldType'] === 'select')
              <div class="formFields">
                <div><b>{{ $field['label'] }}</b> :</div>
                <div><p>{{ $field['value'] }}</p></div>
              </div>
            @elseif ($field['fieldType'] === 'checkbox')
              <div class="formFields">
                <div><b>{{ $field['label'] }}</b> :</div>
                <div>
                  @foreach ($field['value'] as $item)
                    <button class="btn" type="button">{{$item}}</button>
                  @endforeach
                </div>
              </div>
            @elseif ($field['fieldType'] === 'radio')
              <div class="formFields">
                <div><b>{{ $field['label'] }}</b> :</div>
                <div><p>{{ $field['value'] }}</p></div>
              </div>
            @elseif ($field['fieldType'] === 'text datetime')
              <div class="formFields">
                <div><b>{{ $field['label'] }}</b> :</div>
                <div><p>{{ $field['value'] }}</p></div>
              </div>
            @elseif ($field['fieldType'] === 'datetime')
              <div class="formFields">
                <div><b>{{ $field['label'] }}</b> :</div>
                <div><p>{{ $field['value'] }}</p></div>
              </div>
            @elseif ($field['fieldType'] === 'location')
              <div class="formFields">
                <div><b>{{ $field['label'] }}</b> :</div>
                <div>
                  @foreach ($field['value'] as $location)
                      <p><b>Search Input:</b> {{ $location['searchInput'] }}</p>
                      <p><b>Location Name:</b> {{ $location['locationName'] }}</p>
                      <p><b>Coordinates:</b> {{ $location['coordinates'] }}</p>
                  @endforeach
                </div>
              </div>
            @elseif ($field['fieldType'] === 'text location')
              <div class="formFields">
                <div><b>{{ $field['label'] }}</b> :</div>
                <div><p>{{ $field['value'] }}</p></div>
              </div>
            @elseif ($field['fieldType'] === 'hidden')
              <div class="formFields">
                <div><b>{{ $field['label'] }}</b> :</div>
                <div><p>{{ $field['value'] }}</p></div>
              </div>
            @elseif ($field['fieldType'] === 'Rating')
              <div class="formFields">
                <div><b>{{ $field['label'] }}</b> :</div>
                <div><p>{{ $field['value'] }}</p></div>
              </div>
            
            @endif
        @endforeach
      @else
        No fields
      @endif
    </div>
</div>
</body>
</html>
    