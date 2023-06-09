<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        if (Auth::check() && Auth::user()->role === 2) {
            // 医療機関ユーザーの場合は、医療機関ホーム画面にリダイレクトする
            return route('hospitals.home');
        } elseif (Auth::check() && Auth::user()->role === 0) {
            // 管理者ユーザーの場合は、管理者ホーム画面にリダイレクトする
            return route('admins.home');
        } else {
            // ユーザーの場合は、ユーザーホーム画面にリダイレクトする
            return route('users.home');
        }
    }
}
// // それ以外の場合は、デフォルトのリダイレクト先にリダイレクトする
// return $this->redirectTo