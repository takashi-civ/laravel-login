<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

  /**
  * @return View
  */
  public function showLogin()
  {
    return view('login.login_form');
  }


  /**
  * @param App\Http\Request\LoginFormRequest
  */
  public function Login(LoginFormRequest $request)
  {
    $credentials = $request->only('email','password');
    $user = User::where('email','=',$credentials['email'])->first();
    // $userがnullではなかったらログイン処理の準備に入る
    if(!is_null($user))
    {
      if($user->locked_flg === 1)
      {
        return back()->withErrors([
          'danger' => 'アカウントがロックされています。',
        ]);
      }
      //アカウントがロックされていなければログイン処理を行う
      if(Auth::attempt($credentials)) {
        $request->session()->regenerate();
        //成功したらエラーカウントを0にする
        if ($user->error_count > 0)
        {
          $user->error_count = 0;
          $user->save();
        }
        return redirect()->route('home')->with('login_success','ログイン成功しました。');

      }
      //ログイン失敗したらエラーカウントを１増やす
      $user->error_count = $user->error_count + 1;
      //error_countが5より上の場合アカウントをロックする。
      if($user->error_count > 5) {
        $user->locked_flg = 1;
        $user->save();
        return back()->withErrors([
          'danger' => 'アカウントがロックされました。解除したい場合は運営に連絡してください。',
        ]);
      }
    }
    $user->save();
    return back()->withErrors([
      'login_error' => 'メールアドレスかパスワードが間違っています。',
    ]);

    return back();
  }

  /**
  * ユーザーをアプリケーションからログアウトさせる
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('login.show')->with('logout','ログアウトしました!');
  }
}
