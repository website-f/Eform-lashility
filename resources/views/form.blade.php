@extends('partial.main')
@section('title', 'Forms')
    
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
              <h5 class=""><a href="/form-view/{{$forms->id}}"><b>{{$forms->type}} Form</b></a></h5>
              <span style="font-size: 12px">{{$submittedCount}} Submission, Updated on {{$forms['updated_at']->format('d-m-Y')}}</span>
          </div>
      
          <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
            @if (Auth::user()->role->role == "SuperAdmin" || Auth::user()->role->role == "Admin")
              <li class="nav-item dropdown p-2">
                  
                
                @if ($forms->approval == "pending")
                @php
                $approvalCount = $submitted->where('type', $forms->type.' Form')->where('approval', 'pending')->count();
                @endphp
                    <a href="/approval-submission/{{$formType}}" class="btn btn-light btn-sm">
                      Need Approval <span class="badge bg-secondary text-light">{{$approvalCount}}</span>
                    </a>
                @endif
          
          
              </li><!-- End Messages Nav -->
          
              <li class="nav-item dropdown p-1">
                <!-- Vertically centered Modal -->
               
                <a type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#verticalycentered-${{$forms->id}}">
                  <i class="bi bi-trash3-fill"></i>
                </a>
                <div class="modal fade" id="verticalycentered-${{$forms->id}}" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Are you sure want to delete {{$forms->type}} form ?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a class="btn btn-outline-danger" href="/delete-form/{{$forms->id}}">Confirm</a>
                      </div>
                    </div>
                  </div>
                </div><!-- End Vertically centered Modal-->
                @endif
             
          
              </li><!-- End Notification Nav -->
          
              <li class="nav-item dropdown p-1">
               
                <a class="btn btn-outline-primary btn-sm" href="/submitted-based/{{$formType}}">
                  <i class="bi bi-envelope-exclamation-fill"></i>
                 Inbox
                </a><!-- End Messages Icon -->
          
          
              </li><!-- End Messages Nav -->
              @if (Auth::user()->role->role == "SuperAdmin" || $forms->user->name == Auth::user()->name || Auth::user()->role->role == "Admin")
              <li class="nav-item dropdown p-1">
               
                <a class="btn btn-outline-primary btn-sm" href="/edit-view-form/{{$forms->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                  <i class="bi bi-pencil-square"></i>
                </a><!-- End Messages Icon -->
          
          
              </li><!-- End Messages Nav -->
              @endif
              <li class="nav-item dropdown p-1">
               
                <a class="btn btn-outline-secondary btn-sm" href="/form-view/{{$forms->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                  <i class="bi bi-eye-fill"></i>
                </a><!-- End Messages Icon -->
          
          
              </li><!-- End Messages Nav -->
              <li class="nav-item dropdown p-1">
               
                <a class="btn btn-outline-warning btn-sm" href="/form-clone/{{$forms->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Clone">
                  <i class="bi bi-clipboard-fill"></i>
                </a><!-- End Messages Icon -->
          
          
              </li><!-- End Messages Nav -->
          
          
            </ul>
          </nav><!-- End Icons Navigation -->
          
        
        </div><!-- End Header -->
      @endforeach
    </div>
    <div style="margin-top: 10px">
      {{ $form->links() }}
    </div>
  </section>
@endsection