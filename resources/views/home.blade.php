<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <title>ホーム画面</title>
<body>
  <div class="container">
    <div class="mt-5">
      <x-alert type="success" :session="session('login_success')"
      <h3>プロフィール</h3>
      <ul>
        <li>名前:{{ Auth::user()->name }}</li>
        <li>メールアドレス:{{ Auth::user()->email }}</li>
      </ul>
      <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">ログアウト</button>
      </div>
    </div>
</body>
</html>
