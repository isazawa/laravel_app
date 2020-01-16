<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

     このコントローラーは、アプリケーションのユーザーの認証を処理し、
     それらをホーム画面にリダイレクトします。コントローラーは特性を使用します
     その機能をアプリケーションに便利に提供します。
    |
    */

    use AuthenticatesUsers;//これを書くことによって、useした(trait)ファイルをこのクラス内で実行できるようにしている。
    protected $maxAttempts = 3;  //ログイン試行回数(回)とログインロックタイム（分）
    protected $decayMinutes = 1;
    //PHPのバージョン5.4.0以降では「trait(トレイト)」と呼ばれるコードを再利用するための機能が導入されました。
    //トレイトは継承することなくメンバを他のクラスで使用することができます。

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/todo';//loginしたあとの遷移先を/todoに変更。

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout'); 
        //入力データの一部を取得。このクラス内で実行される全てのメソッドは、middleware(guest)の処理をするが、logoutメソッドに関しては処理をしない。
        //logoutメソッドからguestを外すことによって、ログアウト先が/hemoに遷移することを防いでいる。
        //ログインは認証されていないのでそのまま処理に移動します。

        //dd($this);
    }
    

    protected function loggedOut(Request $request)
    {
        return redirect('/login');//AuthenticateUsersファイルのloggedOutメソッドの内容をオーバーライドして書き換えてる。
    }

}
