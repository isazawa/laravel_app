<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) //guestの処理
    {
        if (Auth::guard($guard)->check()) { //SessionGuardのcheckメソッドを実行しています。checkメソッドではユーザが認証済みであればtrueを戻す
            return redirect('/home');       //ここではまた認証が終わっていないのでfalseが戻されます
        }

        return $next($request);//ミドルウェアのチェックに合格し、アプリケーションの先へリクエストを通すには、$requestを渡し$nextコールバックを呼び出します。
    }
}
