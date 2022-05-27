@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('content')
<h3>Create an account</h3>
<h6 class="font-weight-light">Adventure starts here!</h6>
<form class="auth-login-form mt-2" action="{{ route('register') }}" method="POST">
  @csrf

  @if(session()->has('error'))
     <div class="alert alert-danger p-1">
          {{ session()->get('error') }}
      </div>
  @endif
  @if(session()->has('success'))
     <div class="alert alert-success p-1">
          {{ session()->get('success') }}
      </div>
  @endif
  
  
  <div class="form-group">
    <div class="input-group">
      <input type="text" class="form-control"  placeholder="Full Name" name="name" value="{{ old('name') }}" required>
      
    </div>
    @error('name') <span class="text-danger" > {{ $message }} </span> @enderror
  </div>
  <div class="form-group">
    <div class="input-group">
      <input type="email" class="form-control"  placeholder="Email Address" name="email" value="{{ old('email') }}" required>
      
    </div>
    @error('email') <span class="text-danger" > {{ $message }} </span> @enderror
  </div>
  <div class="form-group">
    <div class="input-group">
      <input type="password" class="form-control" type="password" placeholder="Password" name="password" required>
                             
    </div>
    @error('password') <span class="text-danger" > {{ $message }} </span> @enderror
  </div>
  <div class="my-2 d-flex justify-content-between align-items-center">
    <div class="form-check">
      <label class="form-check-label text-muted">
        <input type="checkbox" class="form-check-input" name="agree" required>
        I agree to the terms of service
      </label>
    </div>
  </div>
  <div class="my-3">
    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn border-radius" type="submit" >Register</button>
  </div>
  <div class="divider my-4">
      <div class="divider-text">Or Login With</div>
  </div>
  <div class="mb-2 d-flex">
    <button type="button" class="btn btn-facebook auth-form-btn flex-grow me-1">
      <i class="ti-facebook me-2"></i>
    </button>
    <button type="button" class="btn btn-twitter auth-form-btn flex-grow ms-1">
      <i class="ti-twitter me-2"></i>
    </button>
    <button type="button" class="btn btn-google auth-form-btn flex-grow ms-1">
      <i class="ti-google me-2"></i>
    </button>
    <button type="button" class="btn btn-linkedin auth-form-btn flex-grow ms-1">
      <i class="ti-linkedin me-2"></i>
    </button>
  </div>
  <div class="text-center mt-4 font-weight-light">
    Already a member? <a href="{{url('auth/login')}}" class="text-primary">Login here</a>
  </div>
              
</form>

@endsection

