<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'gifff') }}</title>

  <!-- Styles -->
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/app.css">
  {{-- Special Styles --}}
  @yield('css')

  <script>
    window.Laravel = {!! json_encode([
      'csrfToken' => csrf_token(),
    ]) !!};
  </script>
</head>
<body>

<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-bootstrap">
    <div class="container">
      <a class="navbar-brand" href="/">{{ config('app.name', 'gifff') }}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div  id="collapse" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto"></ul>
        <ul class="navbar-nav">
          {{-- Authentication Links --}}
          @if ( Auth::guest() )
            {{-- Guest state  --}}
            <li class="nav-item"><a class="nav-link" href="/login">Sign in</a></li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
</header>

<main id="main">
  <div class="container">
    @yield('content')
  </div>
</main>

<script src="/js/bootstrap-native-v4.min.js"></script>
</body>
