@extends('partial.main')

@section('title', 'submitted')
    
@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Datatables</h5>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Form Type</th>
                  <th scope="col">Submission date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($submitted as $item)
                <tr>
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
                              Are you sure want to permanently delete {{$item->type}} submission ?
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
</section>
@endsection