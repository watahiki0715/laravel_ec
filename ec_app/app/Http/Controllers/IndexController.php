<?php

namespace App\Http\Controllers;

use App\ec_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function __construct()
    {
        // authというミドルウェアを設定
        $this->middleware('auth');
    }

    public function index(Request $request){
        $title = '商品一覧';
        $text = $request->search_text;
        $categories = $request->search_categories;
        $sort = $request->sort;
        if($sort == '価格が高い順'){
            $sorts = 'desc';
        }else if($sort == '価格が低い順'){
            $sorts = 'asc';
        }
        if($categories != '' && $sort == ''){
            $ec_items = ec_item::where('name','like','%'.$text.'%')
                        ->where('status',1)->where('categories',$categories)->paginate(6);
        }else if($categories != '' && $sort != ''){
            $ec_items = ec_item::where('name','like','%'.$text.'%')
                        ->where('status',1)->where('categories',$categories)->orderBy('price',$sorts)->paginate(6);
        }else if($categories == '' && $sort != ''){
            $ec_items = ec_item::where('name','like','%'.$text.'%')
            ->where('status',1)->orderBy('price',$sorts)->paginate(6);
        }else{
            $ec_items = ec_item::where('name','like','%'.$text.'%')
            ->where('status',1)->paginate(6);
        }
        $count = $ec_items->total();
        $first = $ec_items->firstItem();
        $last = $ec_items->lastItem();
        return view('index',[
            'title' => $title,
            'ec_items' => $ec_items,
            'categories' => $categories,
            'text' => $text,
            'count' => $count,
            'first' => $first,
            'last' => $last,
            'sort' => $sort,
        ]);
    }
    
    //カート機能
    public function cart(Request $request){
        $url = $_SERVER['HTTP_REFERER']; 
        $user_id = \Auth::user()->id;
        $cart_id = $request->cart_id;
        $ec_cart = DB::table('ec_carts')->where('user_id',$user_id)
                   ->where('item_id',$cart_id)->first();

        //既にカートにある商品を１個追加
        if(isset($ec_cart) && $ec_cart->item_id == $cart_id){
            $id = $ec_cart->id;
            $ec_cart = \App\ec_cart::find($id);
            $ec_cart->amount ++;
            $ec_cart->save();
        //カートに商品を１個入れる
        }else{
            $ec_cart = new \App\ec_cart;
            $ec_cart->user_id = \Auth::user()->id;
            $ec_cart->item_id = $request->cart_id;
            $ec_cart->amount = 1;
        // ec_cartsテーブルにINSERT
        $ec_cart->save();
        }
        //メッセージ
        $message = 'カートに追加しました';
        $request->session()->flash('message', $message);
        // メッセージ一覧ページにリダイレクト
        return redirect($url);
    }
}
