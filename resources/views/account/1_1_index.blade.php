@extends('account.0_common')

@section('account')
  <div>
    <h3>index</h3>
    <hr/>
    <div>

      <!-- TODO デバッグ用 -->
      <form method="post" action="/api/image/upload" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="file"/>
        <button type="submit">送信</button>
      </form>

    </div>
  </div>
@endsection
