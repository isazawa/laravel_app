<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //
    protected $fillable = [
        'title',
        'user_id'
    ];

    public function getByUserId($id)//ユーザーに紐づいたデータ取得
    {//dd($id);
       // dd($this->where('user_id', $id)->get());
    return $this->where('user_id', $id)->get();//返り値はcollectionクラスのインスタンス
    // uesrsテーブルのログインしている自分のidとtodosテーブルのuesrs_idが同じレコードをcollectionクラスのインスタンスに埋め込んでリターンしている。
    }
}
