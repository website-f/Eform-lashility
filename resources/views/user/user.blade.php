@extends('partial.main')
@section('title', 'Users')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        @if (Session::has('status') && Session::get('status') == 'success')
        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
    @elseif (Session::has('status') && Session::get('status') == 'danger')
        <div class="alert alert-danger" role="alert">{{ Session::get('message') }}</div>
    @endif
        <div class="card">
          <div class="card-body overflow-auto">
            <a href="/add-user" class="btn btn-success" style="margin-top: 10px">Add User <i class="bi bi-plus-lg"></i></a>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Created At</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($user as $item)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['email']}}</td>
                    <td>{{$item['created_at']->format('d-m-Y')}}</td>
                    <td>
                      <a class="btn btn-outline-primary btn-sm" href="/profile/{{$item['id']}}" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="bi bi-eye-fill"></i></a>
                      <a type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#verticalycentered-${{$item->id}}">
                        <i class="bi bi-trash3-fill"></i>
                      </a>
                      <div class="modal fade" id="verticalycentered-${{$item->id}}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Delete</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Are you sure want to remove {{$item->name}} ?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <a class="btn btn-outline-danger" href="/delete-user/{{$item->id}}">Confirm</a>
                            </div>
                          </div>
                        </div>
                      </div>
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
