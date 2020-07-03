<?php

namespace App\Http\Controllers;

use App\ec_item;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Item_detailController extends Controller
{
    //
    public function __construct()
    {
        // authというミドルウェアを設定
        $this->middleware('auth');
    }

    public function index(Request $request){
        $title = '商品詳細';
        $title2 = '商品レビュー';
        $item_id = $request->item_id;
        $categories = '';
        $text = '';
        $sort = '';

        $ec_item = \App\ec_item::find($item_id);

        $reviews = DB::table('reviews')
                    ->select('reviews.id','reviews.created_at','review','users.name','users.email')
                    ->join('users', 'reviews.user_id', '=', 'users.id')
                    ->where('reviews.item_id',$item_id)->get();


        return view('item_detail',[
            'title' => $title,
            'title2' => $title2,
            'ec_item' => $ec_item,
            'reviews' => $reviews,
            'categories' => $categories,
            'text' => $text,
            'sort' => $sort,
        ]);
    }
    
    //ポスト
    public function post(Request $request){
        $url = $_SERVER['HTTP_REFERER']; 
        //カート機能
        if(isset($request->cart_id)){
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
        
        elseif(isset($request->user_id)){
            //レビュー書き込み
            // requestオブジェクトのvalidateメソッドを利用。
            $request->validate([
                'text' => 'required|max:100', 
                ],[
                'text.required' => 'レビューを入力して下さい。',
                'text.max' => '100文字以内で入力して下さい。',
                ]);
            //全角スペースのみ書き込み不可
            if(!ctype_space (mb_convert_kana($request->text, "s"))){
                // reviewモデルを利用して空のec_itemオブジェクトを作成
                $review = new \App\Review;

                $review->user_id = $request->user_id;
                $review->item_id = $request->item_id;
                $review->review = $request->text;
            
                // reviewテーブルにINSERT
                $review->save();
                $message = 'レビューを書き込みました。';
                $request->session()->flash('message', $message);
            }else{
                $message = '文字を入力して下さい。';
                $request->session()->flash('message', $message);
            }
            return redirect($url);
        }

        elseif(isset($request->delete_id)){
            //レビューを削除
            $delete_id = $request->delete_id;
            $review = \App\Review::find($delete_id);
            $review->delete();
            $message = 'レビューを削除しました';
            $request->session()->flash('message', $message);
            return redirect($url);
        }

        else{
            return redirect($url);
        }
    }
}
