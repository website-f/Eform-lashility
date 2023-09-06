@extends('partial.main')
@section('title', 'Report')

@section('content')


<section class="section">
  @if (request()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ request('success') }}
    </div>
  @endif
  @if (Session::has('status'))
       <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
    @endif
    <div class="row">
      <!-- ======= Header ======= -->
        <div style="background-color: white" class="d-flex align-items-center p-3 formLists">
          <div style="margin-right: 10px"><i class="bi bi-star"></i></div>
          <img style="margin-right: 20px" src="{{asset('images/formss.svg')}}" alt="" width="50" height="50" class="img-fluid formDummyImage">
          <div class="p-0">
                     @php
                        $submittedCount = $submitted->where('type', 'INTAKE & CONSENT FORM')->count();
                        $type = "INTAKE & CONSENT FORM"
                    @endphp
              <h5 class=""><a href="/report-view/{{$type}}"><b>Intake & Consent Form</b></a></h5>
              <span style="font-size: 12px">{{$submittedCount}} Submission</span>
          </div>

          <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
            
              <li class="nav-item dropdown p-1">

                <a class="btn btn-outline-secondary" href="/report-view/{{$type}}" data-bs-toggle="tooltip" data-bs-placement="top" title="View Report">
                  <i class="bi bi-eye-fill"></i>
                </a><!-- End Messages Icon -->


              </li><!-- End Messages Nav -->


            </ul>
          </nav><!-- End Icons Navigation -->


        </div><!-- End Header -->

        @foreach ($form as $forms)
      <!-- ======= Header ======= -->
        <div style="background-color: white" class="d-flex align-items-center p-3 formLists">
          <div style="margin-right: 10px"><i class="bi bi-star"></i></div>
          <img style="margin-right: 20px" src="{{asset('images/formss.svg')}}" alt="" width="50" height="50" class="img-fluid formDummyImage">
          <div class="p-0">
                     @php
                        $submittedCount = $submitted->where('type', $forms->type.' Form')->count();
                        $formType = $forms->type.' Form';
                    @endphp
              <h5 class=""><a href="/report-view/{{$forms->slug}}"><b>{{$forms->type}} Form</b></a></h5>
              <span style="font-size: 12px">{{$submittedCount}} Submission</span>
          </div>

          <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
            
              <li class="nav-item dropdown p-1">

                <a class="btn btn-outline-secondary" href="/report-view/{{$forms->type}}" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                  <i class="bi bi-eye-fill"></i>
                </a><!-- End Messages Icon -->


              </li><!-- End Messages Nav -->

            </ul>
          </nav><!-- End Icons Navigation -->


        </div><!-- End Header -->
      @endforeach
    </div>
    <div>
    </div>
  </section>
@endsection
