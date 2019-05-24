@extends('layouts.main')

@section('content')
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-3">
        <nav class="nav flex-column p-0">
          <div class="nav-link list-group-item p-2 pt-3 pl-3" href="#"><h4>Settings</h4></div>
          <a class="nav-link list-group-item p-2 pl-3" href="/account">Profile</a>
          <a class="nav-link list-group-item p-2 pl-3" href="/account/token">Token Key</a>
        </nav>
      </div>
      <div class="col-md-9 border rounded p-3">
        @if ( Session::has('message') )
          <div class="alert alert-success" role="alert"><strong>Success</strong> - {{ session('message') }}</div>
        @endif
        @yield('account')
      </div>
    </div>
  </div>
@endsection
