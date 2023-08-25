@extends('partial.main')
@section('title', 'Add User')
    
@section('content')
<div class="col d-flex justify-content-center">

    <div class="col-lg-5">
      
      <div class="card">
                <center><img style="padding-top: 30px" width="300" height="100" src="{{asset('images/logo.png')}}" alt=""></center>
                <h5 class="card-title text-center formType">Register User</h5>
                <hr>
                <!-- Multi Columns Form -->
                <form class="row g-3" method="POST" action="/register-user">
                    @csrf
                    <div class="p-5 pt-2">
                      <div class="col-md-12">
                        <label class="form-label"><b>Name</b></label>
                        <input name="name" type="text" class="form-control" >
                      </div><br>
            
                      <div class="col-md-12">
                          <label class="form-label"><b>Email</b></label>
                          <input name="email" type="email" class="form-control" required>
                      </div><br>

                      <div class="col-md-12">
                        <label class="form-label"><b>Phone Number</b></label>
                        <input name="phone" type="text" class="form-control" required>
                    </div><br>

                      <div class="col-md-12">
                        <label class="form-label"><b>Password</b></label>
                        <input name="password" type="password" class="form-control" required>
                    </div><br>

                    <div class="col-12 pt-2 fieldType">
                        <label class="form-label"><b>Role</b></label>
                          <select class="form-select val" aria-label="Default select example" name="role_id">
                            @foreach ($role as $item)
                               <option value="{{$item->id}}">{{$item->role}}</option>
                            @endforeach
                          </select>
                      </div><br>
                    </div>

                    <div class="text-center d-grid gap-2 d-md-flex justify-content-center pt-2 mb-4">
                      <hr>
                      <button type="submit" class="btn btn-success">Create</button>
                    </div>
                  </form><!-- End Multi Columns Form -->
  
  
      </div>
    </div>
  
  </div>
@endsection