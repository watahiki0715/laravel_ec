<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Review_editController extends Controller
{
    //
    public function __construct()
    {
        // authというミドルウェアを設定
        $this->middleware('auth');
    }

    public function index(Request $request){
        $title = 'レビュー編集';
        $edit_id = $request->edit_id;
        $item_id = $request->item_id;
        $categories = '';
        $text = '';
        $sort = '';
        $back = "/item_detail?item_id=$item_id";

        $review = \App\Review::find($edit_id);

        return view('review_edit',[
            'title' => $title,
            'review' => $review,
            'categories' => $categories,
            'text' => $text,
            'sort' => $sort,
            'back' => $back,
        ]);
    }

    public function post(Request $request){
        $url = $_SERVER['HTTP_REFERER'];
        //全角スペースのみ書き込み不可
        if(!ctype_space (mb_convert_kana($request->text, "s"))){ 
            // requestオブジェクトのvalidateメソッドを利用。
            $request->validate([
                    'text' => 'required|max:100', 
                    ],[
                    'text.required' => 'レビューを入力して下さい。',
                    'text.max' => '100文字以内で入力して下さい。',
                    ]);

            $edit_id = $request->edit_id;
            $text_edit = \App\Review::find($edit_id);
            $text_edit->review = $request->text;
            $text_edit->save();

            //メッセージ
            $message = 'レビューを変更しました';
            $request->session()->flash('message', $message);

        }else{
            $message = '文字を入力して下さい。';
            $request->session()->flash('message', $message);
        }
        return redirect($url);
    }
}
