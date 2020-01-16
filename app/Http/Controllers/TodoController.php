<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Auth; //ログインしているユーザーを Auth::id() という形で取得を可能にするために追記しました

class TodoController extends Controller
{
    private $todo;

     public function __construct(Todo $instanceClass)
    {//dd($this);
        $this->middleware('auth'); //このコントローラー内の全アクションを、認証済みユーザーだけがアクセスできるように保護する。
        //ログイン済だったら、以下の処理が継続　すでにログイン済
        //ログイン済じゃなかったらAuthenticate.phpのルーティング処理が実行される。(ログイン画面に飛ばされる)/URL直打ちなど。
        //ユーザーが認証されていないときにリダイレクトされる。
        $this->todo = $instanceClass;
        //dd($this);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = $this->todo->all();
        //all()はeloquentの中のcollection.phpのcollectionクラスをインスタンスで$todosに格納している。
        //dd($todos,compact('todos'));
        $todos = $this->todo->getByUserId(Auth::id());
        // Auth::id() = uesrsテーブルのログインしている自分のIDを取得
        // getByUserId() = todosテーブルのuesrs_idと同じレコード取得してviewに渡している。
        // dd($todos);
        return view('todo.index',compact('todos'));//viewインスタンスで返してる
        // ['todos' => $todos]
    }

    /**
     * Show the form for creating a new resource.新しいリソースを作成するためのフォームを表示します。
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.新しく作成したリソースをストレージに保存します。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//入力された値をこの引数でキャッチしている。
    {
        $input = $request->all();
        //$inputの中には"title"=>"aaa"が入っている。
        //inputの連想配列のキーは、formタグを作成した時の第二引数(name)のところで指定したものがキーになる。
        //$input['test'] = 'test';
        // dd($input, $this->todo->fill($input));
        $input['user_id'] = Auth::id();//userのidカラムの番号をuser_idに格納している。
        //dd($input);
        $this->todo->fill($input)->save();
        //dd(redirect()->to('todo'));
        return redirect()->to('todo.index');
        //一覧画面に遷移させてる。
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = $this->todo->find($id);
       // dd($todo,compact('todo'));
        return view('todo.edit',compact('todo'));
    }

    /**
     * Update the specified resource in storage.ストレージ内の指定されたリソースを更新します。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();/*$inputの中身　method=>PUT token=>... title=>nnn */
        //dd($input,$id);
        $this->todo->find($id)->fill($input)->save();
        //dd(redirect()->to('todo'));
        return redirect()->to('todo.index');//リソースを取得する場合はGETで送られる。
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->todo->find($id)->delete();
        //dd(redirect()->to('todo'));
        return redirect()->to('todo.index');
    }
}
