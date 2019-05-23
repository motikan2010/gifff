@extends('layouts.main')

@section('css')
  <link rel="stylesheet" href="/css/font-awesome.css">
  <link rel="stylesheet" href="/css/bootstrap-social.css">
@endsection

@section('content')
  <div class="offset-4 col-md-4">
    <div class="card">
      <div class="card-header">
        ログイン
      </div>
      <div class="card-body">
        <a href="/login/github" class="btn btn-block btn-social btn-github"><i class="fa fa-github"></i> Sign in with Github</a>
      </div>
    </div>
  </div>
@endsection
