<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotRegistered
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // ユーザーが認証されていない場合
        if (Auth::check()) {
            // 登録されていないユーザーの場合
            if (Auth::user()->email === false) {  
                return redirect('/register/step1');
            }
        } else {
            // 認証されていない場合もリダイレクト
            return redirect('/register/step1');
        }

        return $next($request);
    }
}
