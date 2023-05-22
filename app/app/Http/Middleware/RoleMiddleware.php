<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // ログインしているかをチェック
        if (Auth::check()) {
            // ユーザーの role 値を取得
            $userRole = Auth::user()->role;
            
            // ユーザーの role 値と指定された role 値が一致するかチェック
            if ($userRole == $role) {
                // 一致する場合は次のミドルウェアへ進む
                return $next($request);
            }
        }
        
        // role 値が一致しない場合はアクセスを拒否する
        abort(403, 'Unauthorized');
    }
}
