@extends('account.0_common')

@section('account')
  <div>
    <h3>Token Key</h3>
    <hr/>
    <div class="pt-0">
      <form method="post" action="/account/token">
        {{ csrf_field() }}
        <button class="btn btn-success" type="submit">Create Token</button>
      </form>
    </div>
    <div class="p-1">
      <table class="table">
        <tr>
          <th></th><th>作成日時</th>
        </tr>
        @foreach( $tokens as $token )
          <tr>
            <td>{{ $token->token  }}</td><td>{{ $token->created_at }}</td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection
