@extends('partial.main')

@section('title', 'All Forms Submission')
    
@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        @if (Session::has('status'))
          <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
        @endif
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Datatables</h5>

            <div class="form-check form-switch" style="margin-left: 10px; margin-bottom: 20px">
              <input style="font-size: 18px" class="form-check-input" type="checkbox" id="selectAllCheckbox">
              <label style="font-size: 18px" class="form-check-label" for="flexSwitchCheckChecked"><b>Select All</b></label>
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
                      <button id="delete-selected-submitted" class="btn btn-danger">Confirm</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Vertically centered Modal-->
            </div>
            
            <div class="table-responsive">
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th></th>
                  <th scope="col">#</th>
                  <th scope="col">Form Title</th>
                  <th scope="col">Email</th>
                  <th scope="col">Submission date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @if (Auth::user()->role->role == "SuperAdmin" || Auth::user()->role->role == "Admin")
                @foreach ($submitted as $item)
                @php
                      $fields = json_decode($item->fields, true);
              @endphp
                <tr>
                    <td><input type="checkbox" class="form-check-input select-checkbox" value="{{$item->id}}"></td>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$item['type']}}</td>
                    @if ($item['usermail'] !== null)
                       <td>{{$item['usermail']}}</td>
                    @else
                       @php $emailFieldExists = false @endphp
                       @foreach ($fields as $field)
                           @if ($field['fieldType'] == 'email')
                               <td>{{$field['value']}}</td>
                               @php $emailFieldExists = true @endphp
                               @break
                           @endif
                       @endforeach
                       @unless ($emailFieldExists)
                           <td>No Email</td>
                       @endunless
                   @endif
                    <td>{{$item['created_at']->format('d-m-Y')}}</td>
                    <td>
                      <a class="btn btn-outline-primary btn-sm" href="/submitted-view/{{$item['id']}}" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="bi bi-eye-fill"></i></a>
                      <a class="btn btn-outline-danger btn-sm" href="/submitted-delete/{{$item['id']}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="bi bi-trash3-fill"></i></a>
                    </td>
                    
                  </tr>
                @endforeach
                @else 
                @php
                    $currentSubmitted = $submitted->where("publisher_id", Auth::user()->id) 
                @endphp
                @foreach ($currentSubmitted as $item)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$item['type']}}</td>
                    <td>{{$item['created_at']->format('d-m-Y')}}</td>
                    <td>
                      <a class="btn btn-outline-primary btn-sm" href="/submitted-view/{{$item['id']}}" data-bs-toggle="tooltip" data-bs-placement="top" title="View">View Form</a>
                      
                    </td>
                    
                  </tr>
                @endforeach
                @endif
                
              </tbody>
            </table>
            <!-- End Table with stripped rows -->
            </div>

          </div>
        </div>

      </div>
    </div>
</section>
<script>
  const deleteButton = document.getElementById("delete-selected-submitted");
document.getElementById('selectAllCheckbox').addEventListener('change', function () {
  const checkboxes = document.querySelectorAll('.select-checkbox');
  checkboxes.forEach(checkbox => {
    checkbox.checked = this.checked;
  });
});

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