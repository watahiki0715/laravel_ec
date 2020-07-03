<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    //
    public function __construct()
    {
        // authというミドルウェアを設定
        $this->middleware('auth');
    }

    public function index(){
        $title = '購入履歴';

        $categories = '';
        $text = '';
        $sort = '';

        $user_id = \Auth::user()->id;
        $ec_history = DB::table('ec_histories')->where('user_id',$user_id)->orderBy('id','desc')->paginate(10);
        // views/history.blade.phpを指定
        return view('history',[
            'title' => $title,
            'ec_histories' => $ec_history,
            'categories' => $categories,
            'text' => $text,
            'sort' => $sort,
        ]);
    }
}
