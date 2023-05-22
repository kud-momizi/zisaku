<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): RedirectResponse
    {
        if (Auth::check()) {
            if (Auth::user()->role === '2') {
                // 医療機関ユーザーの場合は、医療機関ホーム画面にリダイレクトする
                return redirect()->route('hospitals.home');
            } elseif (Auth::user()->role === '0') {
                // 管理者ユーザーの場合は、管理者ホーム画面にリダイレクトする
                return redirect()->route('admins.home');
            } else {
                // ユーザーの場合は、ユーザーホーム画面にリダイレクトする
                return redirect()->route('users.home');
            }
        } else {
            // ログインしていない場合は、ログイン画面にリダイレクトする
            return redirect()->route('login');
        }
    }
}
