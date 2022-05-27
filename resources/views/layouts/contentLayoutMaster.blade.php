<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title') - {{env('APP_NAME')}}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="DEVGIRI<dev.giridhari@gmail.com>">
  
  {{-- Include core + vendor Styles --}}
  @include('panels/styles')  
  <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" />
</head>
<body>
  <div class="container-scroller">
    @include('panels.navbar')

    <div class="container-fluid page-body-wrapper">
      
      @include('panels.sidebar')
      
      <div class="main-panel">
        <div class="content-wrapper">
          {{-- Breadcrumb --}}
          @include('panels.breadcrumb')

          {{-- Include Page Content --}}
          @yield('content')
          
          
        </div>
        @include('panels.footer')
      </div>
    </div>
  </div>
  {{-- include default scripts --}}
  @include('panels/scripts')
  
</body>

</html>

