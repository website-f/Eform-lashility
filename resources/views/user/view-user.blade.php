@extends('partial.main')
@section('title', 'Profile')
    
@section('content')
<section class="section profile">
    <div class="row">
      <div class="col-xl-4">
        @if (Session::has('status') && Session::get('status') == 'success')
            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
        @elseif (Session::has('status') && Session::get('status') == 'danger')
            <div class="alert alert-danger" role="alert">{{ Session::get('message') }}</div>
        @endif

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            @if ($user->image == null)
            <img src="{{asset('images/default.png')}}" alt="Profile" class="rounded-circle">
            @else
            <img src="{{$user->image}}" alt="Profile" class="rounded-circle">
            @endif
            
            <h2>{{$user->name}}</h2>
            <h3>{{$user->role->role}}</h3>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Profile</button>
              </li>
              @if (Auth::user()->role->role == "SuperAdmin" || Auth::user()->role->role == "Admin" || Auth::user()->name == $user->name)
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>
              @endif

              

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8">{{$user->name}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{$user->email}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Role</div>
                  <div class="col-lg-9 col-md-8">{{$user->role->role}}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone Number</div>
                    <div class="col-lg-9 col-md-8">{{$user->phone}}</div>
                  </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="/edit-user/{{$user->id}}" method="POST">
                  @method('PUT')
                  @csrf
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      @if ($user->image == null)
                      <img src="{{asset('images/default.png')}}" alt="Profile">
                      @else 
                      <img src="{{$user->image}}" alt="Profile">
                      @endif
                      
                      <div class="pt-2">
                        <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                        <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="fullName" value="{{$user->name}}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email" value="{{$user->email}}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="Phone" value="{{$user->phone}}">
                    </div>
                  </div>

                  @if (Auth::user()->role->role == "SuperAdmin")
                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Role</label>
                    <div class="col-md-8 col-lg-9">
                      <select name="role_id" class="form-select">
                        @foreach ($role as $item)
                          <option value="{{$item['id']}}">{{$item['role']}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  @else
                  <div class="row mb-3 formFieldHide">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Role</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="role_id" type="text" class="form-control" id="Phone" value="{{$user->role->id}}">
                    </div>
                  </div>
                  @endif

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <div id="passwordNotSame" class="alert alert-danger" style="display: none;">Re-enter New Password and New Password not match</div>
                <!-- Change Password Form -->
                <form action="/change-password-user/{{$user->id}}" method="POST">
                  @method('PUT')
                  @csrf

                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="currentPassword" type="password" class="form-control" id="currentPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="newPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="passwordenter" type="password" class="form-control" id="renewPassword">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>
  <script>
    
    const password = document.getElementById('newPassword');
    const repassword = document.getElementById('renewPassword');
    const err = document.getElementById('passwordNotSame');

    repassword.addEventListener("input", function(event) {
      if (password.value !== event.target.value) {
        err.style.display = "block"
      } else {
        err.style.display = "none"
      }
    })
    
  
  </script>
@endsection