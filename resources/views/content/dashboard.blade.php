@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard | User')

@section('content')
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p class="card-title mb-3">Welcome, You are logged in at {{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('j F, Y H:i') }}</p>
        
      </div>
    </div>
  </div>
</div>

@endsection