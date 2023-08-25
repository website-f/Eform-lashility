@extends('partial.main')
@section('title', 'Ready Made Forms')
    
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
                        $submittedCount = $submitted->where('type', 'Intake & Consent Form')->count();
                    @endphp
              <h5 class=""><a href="/sponsorship"><b>Intake & Consent Form</b></a></h5>
              <span style="font-size: 12px">{{$submittedCount}} Submission</span>
          </div>
      
          <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
            @if (Auth::user()->role->role == "SuperAdmin" || Auth::user()->role->role == "Admin")
              <li class="nav-item dropdown p-2">
                  
                
                
                
              
          
          
              </li><!-- End Messages Nav -->
          
              <li class="nav-item dropdown p-1">
                <!-- Vertically centered Modal -->
               
                @endif
             
          
              </li><!-- End Notification Nav -->
          
              <li class="nav-item dropdown p-1">
               
                <a class="btn btn-outline-primary btn-sm" href="/sponsorship-submission">
                  <i class="bi bi-envelope-exclamation-fill"></i>
                 Inbox
                </a><!-- End Messages Icon -->
          
          
              </li><!-- End Messages Nav -->
              <li class="nav-item dropdown p-1">
               
                <a class="btn btn-outline-secondary btn-sm" href="/sponsorship" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                  <i class="bi bi-eye-fill"></i>
                </a><!-- End Messages Icon -->
          
          
              </li><!-- End Messages Nav -->
          
          
            </ul>
          </nav><!-- End Icons Navigation -->
          
        
        </div><!-- End Header -->
    </div>
    <div>
    </div>
  </section>
@endsection