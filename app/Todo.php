<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'user_id',
    ];

    public function getByUserId($id)//ユーザーに紐づいたデータ取得
    {//dd($id);
       // dd($this->where('user_id', $id)->get());
    return $this->where('user_id', $id)->get();//返り値はcollectionクラスのインスタンス
    // uesrsテーブルのログインしている自分のidとtodosテーブルのuesrs_idが同じレコードをcollectionクラスのインスタンスに埋め込んでリターンしている。
    }
}
