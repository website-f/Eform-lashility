@extends('partial.main')

@section('title', 'Sponsorship Form Submission')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Datatables</h5>

            <div class="form-check form-switch" style="margin-left: 30px; margin-bottom: 20px">
              <input style="font-size: 21px" class="form-check-input" type="checkbox" id="selectAllCheckbox">
              <label style="font-size: 18px" class="form-check-label" for="flexSwitchCheckChecked"><b>Select All</b></label>

            </div>


            <!-- Table with stripped rows -->
            <div style="overflow: auto">
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">#</th>
                  <th scope="col">Action</th>
                  <th scope="col">Form Type</th>
                  <th scope="col">Submission date</th>
                  <th scope="col">Approval</th>
                  @php
                    $addedHeaders = []; // Store already added form types
                  @endphp
                  @foreach ($submitted as $item)
                    @php
                      $fields = json_decode($item->fields, true);
                    @endphp
                    @if (is_array($fields))
                      @foreach ($fields as $field)
                        @if (!in_array($field['label'], $addedHeaders)) {{-- Check if header is already added --}}
                          <th scope="col">{{$field['label']}}</th>
                          @php
                            $addedHeaders[] = $field['label']; // Add the form type to the addedHeaders array
                          @endphp
                        @endif
                      @endforeach
                    @endif
                  @endforeach
                  <th scope="col">Published By</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($submitted as $item)
                <tr>
                    <td><input style="font-size: 19px" type="checkbox" class="select-checkbox" data-id="{{$item['id']}}"></td>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                        @if (Auth::user()->role->role == "SuperAdmin" || Auth::user()->role->role == "Admin"  )
                        <a class="btn btn-outline-primary btn-sm" href="/submitted-view/{{$item['id']}}" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="bi bi-eye-fill"></i></a>
                        <a class="btn btn-outline-danger btn-sm" href="/submit-temp-del/{{$item['id']}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="bi bi-trash3-fill"></i></a>
                        @else
                        <a class="btn btn-outline-primary btn-sm" href="/submitted-view/{{$item['id']}}" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="bi bi-eye-fill"></i></a>
                        @endif

                      </td>
                    <td>{{$item['type']}}</td>
                    <td>{{$item['created_at']->format('d-m-Y')}}</td>
                    @if ($item['approval'] == 'pending')
                    <td><button class="btn btn-primary btn-sm">{{$item['approval']}}</button></td>
                    @elseif ($item['approval'] == 'Approved')
                    <td><button class="btn btn-success btn-sm">{{$item['approval']}}</button></td>
                    @elseif ($item['approval'] == 'Rejected')
                    <td><button class="btn btn-danger btn-sm">{{$item['approval']}}</button></td>
                    @else
                    <td>No Approval</td>
                    @endif

                    @php
                     $fields = json_decode($item->fields, true);
                     $hasTextLocation = false;
                    @endphp
                    @if (is_array($fields))
                    @foreach ($fields as $field)
                    @if ($field['fieldType'] === 'file allFile')
                        @if ($field['value'] == "No File")
                        <td>No File Given</td>
                        @else
                        <td><a class="btn btn-primary btn-sm" href="{{asset($field['value'])}}">View File</a></td>
                        @endif
                    @elseif ($field['fieldType'] == 'checkbox')
                    <td>
                       @foreach ($field['value'] as $value)
                          {{$value}}<br>
                       @endforeach
                    </td>
                    @elseif ($field['fieldType'] === 'Signature')
                    <td>Signed</td>
                    @elseif ($field['fieldType'] === 'location')
                    <td>
                    @foreach ($field['value'] as $loc)
                         @if ($loc['searchInput'] == null || $loc['locationName'] == null || $loc['coordinates'] == null)
                             No Data Given
                         @else
                         - Search Input: {{$loc['searchInput']}} <br>
                        - Location Name: {{$loc['locationName']}} <br>
                        - Coordinates: {{$loc['coordinates']}}
                         @endif
                    @endforeach
                    </td>
                    @else
                     <td>{{$field['value']}}</td>
                    @endif
                    @endforeach
                    @endif
                    <td>{{$item->published->name}}</td>

                  </tr>
                @endforeach
              </tbody>

            </table>
            <button class="btn btn-outline-success" onclick="exportToExcel()">Export to Excel</button>
            <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>

      </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<script>
function getFormattedDate(dateString) {
  const date = new Date(dateString);
  const day = date.getDate().toString().padStart(2, '0');
  const month = (date.getMonth() + 1).toString().padStart(2, '0');
  const year = date.getFullYear().toString();
  return `${day}-${month}-${year}`;
}

function getAllRows() {
  const submitted = @json($submitted);
  const allRows = [];

  submitted.forEach(item => {
    item.fields = JSON.parse(item.fields);
    const newRow = { type: item.type, created_at: getFormattedDate(item.created_at) };

    item.fields.forEach(field => {
      if (field.fieldType === 'location') {
        let locationInfo = '';
        field.value.forEach(loc => {
          if (loc.searchInput != null && loc.locationName != null && loc.coordinates != null) {
            locationInfo += `- Search Input: ${loc.searchInput} | Location Name: ${loc.locationName} | Coordinates: ${loc.coordinates}\n`;
          }
        });
        newRow[field.label] = locationInfo;
      } else if (Array.isArray(field.value)) {
        newRow[field.label] = field.value.join(', ');
      } else {
        newRow[field.label] = field.value;
      }
    });

    allRows.push(newRow);
  });

  return allRows;
}

document.getElementById('selectAllCheckbox').addEventListener('change', function () {
  const checkboxes = document.querySelectorAll('.select-checkbox');
  checkboxes.forEach(checkbox => {
    checkbox.checked = this.checked;
  });
});

function exportToExcel() {
  const selectedAll = document.getElementById('selectAllCheckbox').checked;
  const rows = selectedAll ? getAllRows() : getSelectedRows();

  if (rows.length === 0) {
    alert('Please select at least one row to export.');
    return;
  }

  const headers = Object.keys(rows[0]);
  const data = [headers, ...rows.map(row => headers.map(header => row[header]))];

  const sheetName = 'Sheet1';
  const workbook = XLSX.utils.book_new();
  const worksheet = XLSX.utils.aoa_to_sheet(data);

  XLSX.utils.book_append_sheet(workbook, worksheet, sheetName);

  const excelBuffer = XLSX.write(workbook, {
    bookType: 'xlsx',
    type: 'array',
  });

  const fileName = 'selected_data.xlsx';
  const blob = new Blob([excelBuffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
  const url = window.URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = fileName;
  document.body.appendChild(a);
  a.click();
  window.URL.revokeObjectURL(url);
  document.body.removeChild(a);
}

</script>



@endsection
