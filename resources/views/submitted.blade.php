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
          <div class="card-body overflow-auto">
            <h5 class="card-title">Datatables</h5>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Form Type</th>
                  <th scope="col">Email</th>
                  <th scope="col">Submission date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @if (Auth::user()->role->role == "SuperAdmin" || Auth::user()->role->role == "Admin")
                @foreach ($submitted as $item)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$item['type']}}</td>
                    @if ($item['usermail'] !== null)
                       <td>{{$item['usermail']}}</td>
                    @else
                        <td>No Email Given</td>
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
</section>
@endsection
