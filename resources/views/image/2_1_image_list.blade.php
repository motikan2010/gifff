@extends('image.0_common')

@section('image')
  <div class="col-md-12">
    <div>
      <h3>画像一覧</h3>
    </div>
    <hr/>
    <div>
      <a class="btn btn-success" href="/image/upload">アップロード</a>
    </div>
    <div>
      @foreach ( $images as $image )
        <img src="/storage/img/upload/{{ $image->filename }}"/>
      @endforeach
    </div>
  </div>
@endsection
