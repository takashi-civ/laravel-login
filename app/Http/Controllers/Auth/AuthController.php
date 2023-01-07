<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginFormRequest;

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
      dd($request->all());
    }
}
