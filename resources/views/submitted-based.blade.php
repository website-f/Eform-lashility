@extends('partial.main')

@foreach ($submitted as $item)
@section('title', 'submitted-'.$item['type'])
@endforeach


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
              <button style="margin-left: 10px" class="btn btn-outline-success" onclick="exportToExcel()">Export to Excel</button>
              <button style="margin-left: 10px" type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#verticalycentered-selected-trash">
                Delete
              </button>
              <div class="modal fade" id="verticalycentered-selected-trash" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Delete</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     Delete all selected submission ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button id="delete-selected-submitted-based" class="btn btn-danger">Confirm</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Vertically centered Modal-->
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
                    <td><input style="font-size: 19px" type="checkbox" class="select-checkbox" data-id="{{$item['id']}}" value="{{$item['id']}}"></td>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                        @if (Auth::user()->role->role == "SuperAdmin" || Auth::user()->role->role == "Admin"  )
                        <a class="btn btn-outline-primary btn-sm" href="/submitted-view/{{$item['id']}}" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="bi bi-eye-fill"></i></a>
                        <a class="btn btn-outline-danger btn-sm" href="/submitted-based-delete/{{$item['id']}}/{{$item['type']}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="bi bi-trash3-fill"></i></a>
                        @else
                        <p>No Action</p>
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
            <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>

      </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<script>
  const deleteButton = document.getElementById("delete-selected-submitted-based");
function getFormattedDate(dateString) {
  const date = new Date(dateString);
  const day = date.getDate().toString().padStart(2, '0');
  const month = (date.getMonth() + 1).toString().padStart(2, '0');
  const year = date.getFullYear().toString();
  return `${day}-${month}-${year}`;
}

function getSelectedRows() {
  const checkboxes = document.querySelectorAll('.select-checkbox:checked');
  const selectedRows = [];

  checkboxes.forEach(checkbox => {
    const rowId = parseInt(checkbox.dataset.id);
    const submitted = @json($submitted); // Parse the rowId as an integer
    // Assuming your submitted data is an array of objects with 'id' as the unique identifier
    const selectedRow = submitted.find(item => item.id === rowId);
    if (selectedRow) {
      // Parse the 'fields' property as a JSON object
      selectedRow.fields = JSON.parse(selectedRow.fields);

      const newRow = { type: selectedRow.type, created_at: getFormattedDate(selectedRow.created_at) };

      // Extract field data and format it for the table head and values
      selectedRow.fields.forEach(field => {
        if (Array.isArray(field.value)) {
          newRow[field.label] = field.value.join(', ');
        } else {
          newRow[field.label] = field.value;
        }
      });

      selectedRows.push(newRow);
    }
  });

  return selectedRows;
}


document.getElementById('selectAllCheckbox').addEventListener('change', function () {
  const checkboxes = document.querySelectorAll('.select-checkbox');
  checkboxes.forEach(checkbox => {
    checkbox.checked = this.checked;
  });
});

function exportToExcel() {
  const selectedRows = getSelectedRows();
  console.log(selectedRows);

  if (selectedRows.length === 0) {
    alert('Please select at least one row to export.');
    return;
  }

  const rows = [Object.keys(selectedRows[0])]; // Headers
  selectedRows.forEach(row => {
    const values = Object.values(row);
    rows.push(values);
  });

  const sheetName = 'Sheet1';
  const workbook = XLSX.utils.book_new();
  const worksheet = XLSX.utils.aoa_to_sheet(rows);

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

// Delete selected items when the Delete Selected button is clicked
deleteButton.addEventListener("click", function () {
    const checkboxes = document.querySelectorAll('.select-checkbox');
        const selectedItems = Array.from(checkboxes)
            .filter((checkbox) => checkbox.checked)
            .map((checkbox) => checkbox.value);

        // Send the selected item IDs to the server for deletion using AJAX
        if (selectedItems.length > 0) {
            // You can use fetch or XMLHttpRequest to send a request to the server
            // Here's a simplified example using fetch:
            fetch("/delete-items-submitted", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                body: JSON.stringify({ items: selectedItems }),
            })
            .then((response) => {
                if (response.ok) {
                    // Handle successful deletion (e.g., remove the deleted rows from the table)
                    location.reload(); // Refresh the page
                }
            });
        }
    });

</script>


@endsection
