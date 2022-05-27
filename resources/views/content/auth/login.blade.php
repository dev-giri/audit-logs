@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('content')
<h3>Sign into your account</h3>
<h6 class="font-weight-light">Happy to see you again!</h6>
<form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
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
      <div class="input-group-prepend bg-transparent">
        <span class="input-group-text bg-transparent border-right-0">
          <i class="ti-user text-primary"></i>
        </span>
      </div>
      <input type="email" class="form-control form-control-lg border-left-0" id="exampleInputEmail" placeholder="Email Address" name="email" required>
    </div>
  </div>
  <div class="form-group">
    <div class="input-group">
      <div class="input-group-prepend bg-transparent">
        <span class="input-group-text bg-transparent border-right-0">
          <i class="ti-lock text-primary"></i>
        </span>
      </div>
      <input type="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Password" name="password" required>                        
    </div>
  </div>
  <div class="my-2 d-flex justify-content-between align-items-center">
    <div class="form-check">
      <label class="form-check-label text-muted">
        <input type="checkbox" class="form-check-input" name="remember">
        Remember me
      </label>
    </div>
    <a href="#" class="auth-link text-black">Forgot password?</a>
  </div>
  <div class="my-3">
    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn border-radius" type="submit">Login</button>
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
    Don't have an account? <a href="{{url('auth/register')}}" class="text-primary">Register here</a>
  </div>
</form>

@endsection

