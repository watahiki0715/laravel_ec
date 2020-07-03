<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function __construct()
    {
        // authというミドルウェアを設定
        $this->middleware('auth:admin');
    }

    public function index(){
        $title = '商品追加';

        // ec_itemモデルを利用してec_itemの一覧を取得
        //$ec_items = DB::table('ec_items')->get();
        $ec_items = DB::table('ec_items')->orderBy('id','desc')->paginate(10);
        return view('admin/index',[
            'title' => $title,
            'ec_items' => $ec_items,
        ]);
    }

    public function post(Request $request){
        //追加
        if (isset($request->create_name)){
            // requestオブジェクトのvalidateメソッドを利用。
            $request->validate([
                'create_name' => 'required', 
                'price' => 'required|integer|min:0',
                'image' => [
                    'required',
                    'file',
                    'image',
                    'mimes:jpeg,png',
                    'dimensions:min_width=100,min_height=100,max_width=600,max_height=600',// imageは必須、ファイルアップロードが行われ、画像ファイルでjpeg,pngのいずれか、100x100~600x600まで
                ],
                'status' => 'required|integer',
                'stock' => 'required|integer|min:0',
                'detail' => 'required',
                'categories' => 'required',
            ],[
                'create_name.required' => '名前は必ず入力して下さい。',
                'price.required' => '価格は必ず入力して下さい。',
                'price.integer' => '価格は整数を入力して下さい。',
                'price.min' => '価格は0以上を入力して下さい。',
                'image.required' => '画像ファイルは必ず選択して下さい。',
                'image.file' => '画像ファイルを選択して下さい。',
                'image.image' => '画像ファイルを選択して下さい。',
                'image.mimes' => '画像ファイルはjpeg,pngを選択して下さい。',
                'image.dimensions' => '画像ファイルのサイズは横100px~600px、縦100px~600pxにして下さい。',
                'status.required' => 'ステータスは必ず選択して下さい',
                'status.integer' => 'ステータスは公開,非公開を選択して下さい',
                'stock.required' => '在庫数は必ず入力して下さい',
                'stock.integer' => '在庫数は整数を入力して下さい',
                'stock.min' => '在庫数は0以上を入力して下さい',
                'detail.required' => '詳細は必ず入力して下さい',
                'categories.required' => 'カテゴリーは必ず選択して下さい',
            ]);

            $filename = '';
            $image = $request->file('image');
            if( isset($image) === true ){
                // 拡張子を取得
                $ext = $image->guessExtension();
                // アップロードファイル名は [ランダム文字列20文字].[拡張子]
                $filename = str_random(20) . ".{$ext}";
                // publicディスク(storage/app/public/)のphotosディレクトリに保存
                $path = $image->storeAs('photos', $filename, 'public');
            }


            // ec_itemモデルを利用して空のec_itemオブジェクトを作成
            $ec_item = new \App\ec_item;

            $ec_item->name = $request->create_name;
            $ec_item->price = $request->price;
            // ファイル名を保存
            $ec_item->image = $filename;
            $ec_item->status = $request->status;
            $ec_item->stock = $request->stock;
            $ec_item->detail = $request->detail;
            $ec_item->categories = $request->categories;

            // ec_itemテーブルにINSERT
            $ec_item->save();
            //メッセージ
            $message = '商品を追加しました';
            $request->session()->flash('message', $message);
            // メッセージ一覧ページにリダイレクト
            return redirect('/admin/index');
        }

        //商品名の変更
        if (isset($request->update_name)){
            // requestオブジェクトのvalidateメソッドを利用。
            $request->validate([
                'update_name' => 'required', 
            ]);
            $name_id = $request->name_id;
            $ec_item = \App\ec_item::find($name_id);
            $ec_item->name = $request->update_name;
            $ec_item->save();
            //メッセージ
            $message = '商品名を変更しました';
            $request->session()->flash('message', $message);
            // メッセージ一覧ページにリダイレクト
            return redirect('/admin/index');
        }

        //価格の変更
        if (isset($request->update_price)){
            // requestオブジェクトのvalidateメソッドを利用。
            $request->validate([
                'update_price' => 'required|integer', 
            ]);
            $price_id = $request->price_id;
            $ec_item = \App\ec_item::find($price_id);
            $ec_item->price = $request->update_price;
            $ec_item->save();
            //メッセージ
            $message = '価格を変更しました';
            $request->session()->flash('message', $message);
            // メッセージ一覧ページにリダイレクト
            return redirect('/admin/index');
        }

        //在庫数の変更
        if (isset($request->update_stock)){
            // requestオブジェクトのvalidateメソッドを利用。
            $request->validate([
                'update_stock' => 'required|integer', 
            ]);
            $stock_id = $request->stock_id;
            $ec_item = \App\ec_item::find($stock_id);
            $ec_item->stock = $request->update_stock;
            $ec_item->save();
            //メッセージ
            $message = '在庫数を変更しました';
            $request->session()->flash('message', $message);
            // メッセージ一覧ページにリダイレクト
            return redirect('/admin/index');
        }

        //ステータスの変更
        if (isset($request->update_status)){
            // requestオブジェクトのvalidateメソッドを利用。
            if ($request->update_status !=1){
                $request->update_status =1;
            }else if ($request->update_status != 0){
                $request->update_status =0;
            }
            $request->validate([
                'update_status' => 'required|integer', 
            ]);
            $status_id = $request->status_id;
            $ec_item = \App\ec_item::find($status_id);
            $ec_item->status = $request->update_status;
            $ec_item->save();
            //メッセージ
            $message = 'ステータスを変更しました';
            $request->session()->flash('message', $message);
            // メッセージ一覧ページにリダイレクト
            return redirect('/admin/index');
        }

        //カテゴリーの変更
        if (isset($request->update_categories)){
            // requestオブジェクトのvalidateメソッドを利用。
            $request->validate([
                'update_categories' => 'required', 
            ]);
            $categories_id = $request->categories_id;
            $ec_item = \App\ec_item::find($categories_id);
            $ec_item->categories = $request->update_categories;
            $ec_item->save();
            //メッセージ
            $message = 'カテゴリーを変更しました';
            $request->session()->flash('message', $message);
            // メッセージ一覧ページにリダイレクト
            return redirect('/admin/index');
        }

        //詳細を変更
        if (isset($request->update_detail)){
            // requestオブジェクトのvalidateメソッドを利用。
            $request->validate([
                'update_detail' => 'required', 
            ]);
            $detail_id = $request->detail_id;
            $ec_item = \App\ec_item::find($detail_id);
            $ec_item->detail = $request->update_detail;
            $ec_item->save();
            //メッセージ
            $message = '詳細を変更しました';
            $request->session()->flash('message', $message);
            // メッセージ一覧ページにリダイレクト
            return redirect('/admin/index');
        }

        //商品の削除
        if (isset($request->delete_id)){
            $delete_id = $request->delete_id;
            if($request->image != ''){
                $image = $request->image;
                unlink('./storage/photos/'."$image");
            }
            $ec_item = \App\ec_item::find($delete_id);
            $ec_item->delete();
            //メッセージ
            $message = '商品を削除しました';
            $request->session()->flash('message', $message);
            return redirect('/admin/index');
        }
    }
}