<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        // ログインしていて、かつ管理者かチェック
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }

        // 管理者じゃなければ拒否
        abort(403);
    }
}
