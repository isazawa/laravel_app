<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Auth;
// use App\Todo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');//このコントローラ内の全アクションを、認証済みユーザーだけがアクセスできるよう保護することになります。
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
