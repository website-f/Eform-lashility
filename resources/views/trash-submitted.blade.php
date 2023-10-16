@extends('partial.main')

@section('title', 'submitted')
    
@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

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
                      Permanently delete all selected submission ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button id="delete-selected" class="btn btn-danger">Confirm</button>
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
                  <th scope="col">Form Type</th>
                  <th scope="col">Submission date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($submitted as $item)
                <tr>
                    <td><input type="checkbox" class="form-check-input select-checkbox" value="{{$item['id']}}"></td>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$item['type']}}</td>
                    <td>{{$item['created_at']->format('d-m-Y')}}</td>
                    <td>
                      <a class="btn btn-outline-primary" href="/trash-submitted-restore/{{$item['id']}}" data-bs-toggle="tooltip" data-bs-placement="top" title="restore">Restore</a>
                      
                      <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#verticalycentered-${{$item->id}}">
                        <i class="bi bi-trash3-fill"></i>
                      </button>
                      <div class="modal fade" id="verticalycentered-${{$item->id}}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Delete</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Permanently delete {{$item->type}} submission ?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <a class="btn btn-outline-danger" href="/trash-submitted-delete/{{$item->id}}">Confirm</a>
                            </div>
                          </div>
                        </div>
                      </div><!-- End Vertically centered Modal-->
                    </td>
                    
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
<script>
  const deleteButton = document.getElementById("delete-selected");
  const selectAllCheckbox = document.getElementById("selectAllCheckbox");
  selectAllCheckbox.addEventListener('change', function () {
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
            fetch("/delete-items-trash", {
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