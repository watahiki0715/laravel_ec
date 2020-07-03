<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function __construct()
    {
        // authというミドルウェアを設定
        $this->middleware('auth');
    }

    public function index(){
        $title = 'ショッピングカート';

        $categories = '';
        $text = '';
        $sort = '';

        // ec_cartモデルを利用してec_cartの一覧を取得
        $user_id = \Auth::user()->id;
        $ec_cart = DB::table('ec_carts')
                   ->join('ec_items', 'ec_carts.item_id', '=', 'ec_items.id')
                   ->select('ec_carts.id as carts_id','image','name','price','amount','stock')
                   ->where('ec_carts.user_id',$user_id)->get();
        
        // views/index.blade.phpを指定
        return view('cart',[
            'title' => $title,
            'ec_carts' => $ec_cart,
            'categories' => $categories,
            'text' => $text,
            'sort' => $sort,
        ]);
    }
    
    //amount更新(追加)
    public function post(Request $request){
        //数量変更
        if (isset($request->amount)){
            $request->validate([
                'amount' => 'required',
            ]);
            $amount_id = $request->amount_id;
            $ec_cart = \App\ec_cart::find($amount_id);
            $ec_cart->amount = $request->amount;
            $ec_cart->save();
            //メッセージ
            $message = '数量を変更しました';
            $request->session()->flash('message', $message);
        return redirect('/cart');
        }

        //削除
        if (isset($request->delete_id)){
            $delete_id = $request->delete_id;
            $ec_cart = \App\ec_cart::find($delete_id);
            $ec_cart->delete();
            //メッセージ
            $message = '商品を削除しました';
            $request->session()->flash('message', $message);
            return redirect('/cart');
        }

        //購入
        if (isset($request->buy)){
            $user_id = \Auth::user()->id;
            $ec_carts = DB::table('ec_carts')
                       ->join('ec_items', 'ec_carts.item_id', '=', 'ec_items.id')
                       ->select('ec_carts.id as carts_id','image','name','price','amount','stock','item_id')
                       ->where('ec_carts.user_id',$user_id)->get();

            //購入できない商品がある場合エラーメッセージ を追加
            foreach($ec_carts as $ec_cart){
                $item_id = $ec_cart->item_id;
                $update = \App\ec_item::find($item_id);
                if($update->stock < $ec_cart->amount){
                    $message = '購入に失敗しました';
                    $request->session()->flash('message', $message);
                }
            }
            //エラーメッセージ がない場合      
            if(!isset($message)){
                $total = 0;
                foreach($ec_carts as $ec_cart){
                    $item_id = $ec_cart->item_id;
                    $cart_id = $ec_cart->carts_id;
                    //ec_itemsのitem_idが一致した商品データを取得
                    $update = \App\ec_item::find($item_id);
                    //商品在庫から購入数を引く
                    $update_stock = $update->stock - $ec_cart->amount;
                    //商品在庫を更新
                    $update->stock = $update_stock;
                    $update->save();
                    //商品ごとの小計を算出
                    $subtotal = $ec_cart->price * $ec_cart->amount;
                    //合計金額を算出
                    $total = $total + $subtotal;
                }
                //トランザクション処理開始
                DB::beginTransaction();
                try {
                    //ec_historiesに登録
                    $ec_history = new \App\ec_history;
                    $ec_history->user_id = \Auth::user()->id;
                    $ec_history->total = $total;
                    $ec_history->save();
                
                    //最後に登録された同ユーザーの購入履歴を取得
                    $ec_history = DB::table('ec_histories')->orderBy('id', 'desc')
                                  ->where('user_id',$user_id)->first();
                    foreach($ec_carts as $ec_cart){
                        //商品ごとの小計を算出
                        $subtotal = $ec_cart->price * $ec_cart->amount;
                        //ec_detailsに登録
                        $ec_detail = new \App\ec_detail;
                        $ec_detail->history_id = $ec_history->id;
                        $ec_detail->item_id = $ec_cart->item_id;
                        $ec_detail->amount = $ec_cart->amount;
                        $ec_detail->subtotal = $subtotal;
                        $ec_detail->save();  
                    }
                    //コミット処理
                    DB::commit();
                    return redirect('/finish');
                } catch (\Exception $e) {
                    $message = '商品履歴、詳細の登録に失敗しました';
                    $request->session()->flash('message', $message);
                    return redirect('/finish');
                    DB::rollback();
                }
            }else{
                foreach($ec_carts as $ec_cart){
                    $cart_id = $ec_cart->carts_id;
                    $delete_cart = \App\ec_cart::find($cart_id);
                    $delete_cart->delete();
                }
                return redirect('/cart');
            }
        }
    }
}
