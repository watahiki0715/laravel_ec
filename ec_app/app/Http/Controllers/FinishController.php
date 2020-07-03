<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinishController extends Controller
{
    //
    public function __construct()
    {
        // authというミドルウェアを設定
        $this->middleware('auth');
    }

    public function index(){
        $title = '購入完了';

        $categories = '';
        $text = '';
        $sort = '';

        // ec_cartモデルを利用してec_cartの一覧を取得
        $user_id = \Auth::user()->id;
        $ec_cart = DB::table('ec_carts')
                   ->join('ec_items', 'ec_carts.item_id', '=', 'ec_items.id')
                   ->select('ec_carts.id as carts_id','image','name','price','amount','stock','item_id')
                   ->where('ec_carts.user_id',$user_id)->get();
        foreach($ec_cart as $cart){          
            $cart_id = $cart->carts_id;
            $delete_cart = \App\ec_cart::find($cart_id);
            $delete_cart->delete();
        }
        // views/finish.blade.phpを指定
        return view('finish',[
            'title' => $title,
            'ec_carts' => $ec_cart,
            'categories' => $categories,
            'text' => $text,
            'sort' => $sort,
        ]);
    }
}
