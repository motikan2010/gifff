@extends('image.0_common')

@section('image')
  <div class="col-md-12">
    <div>
      <h3>画像一覧</h3>
    </div>
    <hr/>
    <div class="col-md-12">
      <form method="post" action="/image/create">
        {{ csrf_field() }}
        <button class="btn btn-success" type="submit">作成</button>
        @foreach ( $images as $image )
          @if( $loop->first || $loop->index % 4 == 0 )
            <div class="row mt-2 pb-1">
          @endif
              <div class="col-md-3 m-0 p-1">
                <div class="card m-0">
                  <div class="card-body  m-0 p-1">
                    <img src="/storage/img/upload/{{ $image->filename }}" style="width: 100%"/>
                    <input type="checkbox" name="image_id[]" value="{{ $image->id }}" />
                  </div>
                </div>
              </div>
          @if( $loop->last || $loop->index % 4 == 3 )
            </div>
          @endif
        @endforeach
      </form>
    </div>
  </div>
@endsection
