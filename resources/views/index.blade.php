@extends('partial.main')
@section('title', 'Dashboard')

@section('content')
@auth

<section class="section dashboard">
  @if (Auth::user()->role->role == "Admin" || Auth::user()->role->role == "SuperAdmin")
  <div class="row">
    <!-- Sales Card -->
    <div class="col-lg-4 ">
      <div class="card info-card sales-card">
        <a href="/forms">
        <div class="card-body">
          <h5 class="card-title">Forms</h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-pencil-square"></i>
            </div>
            <div class="ps-3">
              <h6 class="text-primary pt-1 fw-bold">{{$forms->count()}}</h6>

            </div>
          </div>
        </div>
       </a>
      </div>
    </div><!-- End Sales Card -->

    <!-- Revenue Card -->
    <div class="col-lg-4">
      <div class="card info-card revenue-card overflow-auto">
      <a href="/submitted">
        <div class="card-body">
          <h5 class="card-title">Submission</h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-layout-text-window"></i>
            </div>
            <div class="ps-3">
              <h6 class="text-success pt-1 fw-bold">{{$submitted->count()}}</h6>


            </div>
          </div>
        </div>
       </a>
      </div>
     </div><!-- End Revenue Card -->

     <!-- Sales Card -->
    <div class="col-lg-4 ">
      <div class="card info-card customers-card">
        <a href="/myforms/{{Auth::user()->id}}">
        <div class="card-body">
          <h5 class="card-title">My Forms</h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-file-earmark-text"></i>
            </div>
            <div class="ps-3">
              <h6 class="text-danger pt-1 fw-bold">{{$myform->count()}}</h6>

            </div>
          </div>
        </div>
       </a>
      </div>
    </div><!-- End Sales Card -->

  </div>
    <div class="row">
      
      <!-- Right side columns -->
    <div class="col-lg-12">
      <!-- Website Traffic -->
      <div class="card">

        <div class="card-body pb-0">
          <h5 class="card-title">Recent Submission</h5>

          <div class="table-responsive">
          <table class="table table-borderless datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Form Title</th>
                <th scope="col">Email</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($submitted as $item)
              @php
                      $fields = json_decode($item->fields, true);
              @endphp
              <tr>
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
                  <td>{{$item['created_at']->format('h:i')}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
          </div>


        </div>
      </div><!-- End Website Traffic -->



    </div><!-- End Right side columns -->

    
     <!-- Left side columns -->
     <div class="col-lg-12">
      <div class="row">
        <!-- Recent Sales -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="card-body">
              <h5 class="card-title">Recent Created Forms</h5>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Form Type</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Created Time</th>
                    <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
                  @foreach ($forms as $item)
                  <tr>
                      <th scope="row">{{$loop->iteration}}</th>
                      <td>{{$item['type']}}</td>
                      <td>{{$item['created_at']->format('d-m-Y')}}</td>
                      <td>{{$item['created_at']->format('h:i')}}</td>
                      <td><a class="btn btn-outline-primary" href="/form-view/{{$item->id}}">View</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Recent Sales -->

      </div>
    </div><!-- End Left side columns -->

    @else


      <!-- Right side columns -->
      <div class="col-lg-4">

        <!-- Website Traffic -->
        <div class="card info-card sales-card">

          <div class="card-body">
            <h5 class="card-title">My Forms</h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-pencil-square"></i>
              </div>
              <div class="ps-3">
                @php
                    $myforms = $forms->where('user_id', Auth::user()->id)
                @endphp
                <h6 class="text-primary pt-1 fw-bold">{{$myforms->count()}}</h6>

              </div>
            </div>
          </div>

        </div>



      </div><!-- End Right side columns -->
    @endif

    </div>
  </section>
@endauth
@guest
<section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">

  <h2>Create forms and publish it your way</h2>
  <a class="btn" href="/login">Sign In</a>
  <img src="assets/img/home3.svg" class="img-fluid py-5" alt="Page Not Found" width="500px" height="500px">
  <div class="credits">
    <!-- All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
  </div>
</section>
@endguest
@endsection
