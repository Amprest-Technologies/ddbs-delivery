<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/icon/icon.png') }}">

  <title>{{ config('app.name') }}</title>

  <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
  <div id="app">
    <header>
      @include('layouts.navbar')
    </header>

    <main>
      <div class="container-fluid">
        @if(Session::has('success'))
          <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
          </div>
        @endif
      </div>
      @yield('content')
    </main>

    <footer>
      @include('layouts.footer')
    </footer>
  </div>

  <script src="{{ mix('js/manifest.js') }}" defer></script>
  <script src="{{ mix('js/vendor.js') }}" defer></script>
  <script src="{{ mix('js/app.js') }}" defer></script>
  <script src="{{ mix('js/master.js') }}" defer></script>
</body>
</html>
