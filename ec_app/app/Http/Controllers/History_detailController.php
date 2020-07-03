<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class History_detailController extends Controller
{
    //
    public function __construct()
    {
        // authというミドルウェアを設定
        $this->middleware('auth');
    }

    public function index(Request $request){

        $url = $_SERVER['HTTP_REFERER'];
        $title = '購入履歴詳細';

        $categories = '';
        $text = '';
        $sort = '';

        $user_id = \Auth::user()->id;
        $detail_id = $request->history_id;
        $ec_detail = DB::table('ec_details')
                   ->join('ec_items', 'ec_details.item_id', '=', 'ec_items.id')
                   ->where('ec_details.history_id',$detail_id)->get();
        
        $datetime = $request->datetime;
        $total = $request->total;
        // views/history.blade.phpを指定
        return view('history_detail',[
            'title' => $title,
            'ec_details' => $ec_detail,
            'number' => $detail_id,
            'datetime' => $datetime,
            'total' => $total,
            'back' => $url,
            'categories' => $categories,
            'text' => $text,
            'sort' => $sort,
        ]);
    }
}
