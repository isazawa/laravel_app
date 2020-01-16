<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |

     このコントローラーは、新しいユーザーの登録とそのユーザーの登録を処理します
     検証と作成。デフォルトでは、このコントローラーは特性を使用して
     追加のコードを必要とせずにこの機能を提供します。


    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration. 登録後にユーザーをリダイレクトする場所。
     *
     * @var string
     */
    protected $redirectTo = '/todo';//ここでregisterで登録されたら/homeに遷移するところを/todoに変更して一覧表示画面に遷移するようにしている。
    //todoController.phpのindexの処理実行。
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');//ログイン済かどうかを見ている。
        // ⇒ ログインしてる場合は、/homeに移動。
        // ⇒ ログインしてない場合は、続行。
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {//dd($data); それぞれのフォームに入力された値と、csrfトークンが連想配列で渡ってきている。
        return Validator::make($data, [//自動リダイレクトを行わないバリデーション(通常、バリデーションに通らなかった場合に、エラーメッセージを持って自動的にフォームのページへ遷移する。)
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',//usersテーブルに一意なメールアドレスのみ追加可能
            'password' => 'required|string|min:6|confirmed',//上のパスワードと同じ値を打ってくださいね。passwordがpassword_confirmtionに入ってる値を参照してる。
        ]);//フォームのname' => 'バリデーションルール'
    } //validatorクラスのmakeメソッドに第一引数にPOST送信したデータ$dataを渡し、第二引数でバリデーションルールを渡す。

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)//arrayは引数にはいる型を指定する 型が違う場合は、FatalThrowableExceptionErorrで例外処理が投げられる。
    {//dd($data);
        return User::create([//App\Userクラスのインスタンスが返り値。$userに持たせたい値を返す Userファサードの静的メソッドを呼び出してる。
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            //毎回違うハッシュを返す。入力された現パスワードをHash::make()でハッシュ化した値とDBに保存されているハッシュ化されたパスワードを比較しても一致することはない。
        ]);
    }
}
