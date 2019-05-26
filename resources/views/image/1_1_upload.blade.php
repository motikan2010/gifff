@extends('image.0_common')

@section('image')
  <div class="col-md-12">
    <div class="row">

      <!-- TODO デバッグ用 -->
      <form method="post" action="/image/upload" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
          <label>画像ファイル 1</label>
          <input class="form-control-file @if( !empty($errors->first('file.0')) ) is-invalid @endif" type="file" name="file[]"/>
          <span class="invalid-feedback">{{ $errors->first('file.0') }}</span>
        </div>
        <div class="form-group">
          <label>画像ファイル 2</label>
          <input class="form-control-file @if( !empty($errors->first('file.1')) ) is-invalid @endif" type="file" name="file[]"/>
          <span class="invalid-feedback">{{ $errors->first('file.1') }}</span>
        </div>
        <div class="form-group">
          <label>画像ファイル 3</label>
          <input class="form-control-file @if( !empty($errors->first('file.2')) ) is-invalid @endif" type="file" name="file[]"/>
          <span class="invalid-feedback">{{ $errors->first('file.2') }}</span>
        </div>
        <button class="btn btn-info" type="submit">送信</button>
      </form>
      <!-- TODO ここまで -->

    </div>
  </div>
@endsection
