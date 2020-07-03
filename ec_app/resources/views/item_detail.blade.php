@extends('layouts.default')

@section('title', $title)

@section('content')

<main>
    <div class="py-4">
        <div class="container">
            {{-- エラーメッセージを出力 --}}
            @foreach($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
            @endforeach

            {{-- エラーメッセージを出力 --}}
            @if(session('message'))
                <p class="alert alert-secondary">{{ session('message') }}</p>
            @endif 
        </div>

        <div class="container bg-white border pt-2 pb-4">
            <div class="row justify-content-center rounded-circle my-3 mx-2" style="background-color:#FF8856; color:white"> 
                <h1>{{ $title }}</h1>
            </div>
            <div class="row mx-2">
                <table class="table table-bordered text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>商品画像</th>
                            <th>商品名</th>
                            <th>価格</th>
                            <th>在庫数</th>
                            <th>詳細</th>
                        </tr>
                    </thead>
                    <tr>
                        <td class="w-25"><img src="{{ asset('storage/photos/' . $ec_item->image) }}" style="width:100px; height:80px;"></td>
                        <td class="align-middle">{{ $ec_item->name }}</td>
                        <td class="align-middle">{{ number_format($ec_item->price) }}円</td>
                        <td class="align-middle">{{ $ec_item->stock }}</td>
                        <td class="align-middle">{{ $ec_item->detail }}</td>
                    </tr>
                </table>
            </div>
            <div class="mx-2">
                <form method="post" action="{{ url('/item_detail') }}">
                   {{ csrf_field() }}
                   <input type="hidden" name="cart_id" value="{{ $ec_item->id }}">
                   <button type="submit" class="w-100">カートに入れる</button>
                </form>
            </div>
        </div>
    </div>

    <div class="py-4">
        <div class="container bg-white border pt-2 pb-4">
            <div class="row justify-content-center rounded-circle my-3 mx-2" style="background-color:#FF8856; color:white"> 
                <h1>{{ $title2 }}</h1>
            </div>
            <div class="mx-2">
                <form method="post" action="{{ url('/item_detail') }}" class="mb-5">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="item_id" value="{{ $ec_item->id }}">
                    <textarea class="w-100" name="text" style="height:80px" required></textarea><br>
                    <button type="submit" class="w-100">書き込む</button>
                </form>
            </div>
            <div class="row mx-2">
                @if(count($reviews)>0)
                <table class="table table-bordered text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>投稿日時</th>
                            <th>ユーザー名</th>
                            <th class="w-50">レビュー</th>
                            <th>編集</th>
                            <th>削除</th>
                        </tr>
                    </thead>
                    @forelse($reviews as $review)
                    <tr>
                        <td class="align-middle">{{ $review->created_at }}</td>
                        <td class="align-middle">{{ $review->name }}</td>
                        <td class="align-middle">{{ $review->review }}</td>
                        <td class="align-middle">
                            @if(Auth::user()->email === $review->email)
                                <form method="get" action="{{ url('/review_edit') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="edit_id" value="{{ $review->id }}">
                                    <input type="hidden" name="item_id" value="{{ $ec_item->id }}">
                                    <button type="submit">編集</button>
                                </form>
                            @else
                                <p>-</p>
                            @endif
                        </td>
                        <td class="align-middle">
                            @if(Auth::user()->email === $review->email)
                                <form method="post" action="{{ url('/item_detail') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="delete_id" value="{{ $review->id }}">
                                    <button type="submit">削除</button>
                                </form>
                            @else
                                <p>-</p>
                            @endif
                        </td>
                    </tr>
                    @empty
                        <li>レビューの取得に失敗しました</li>
                    @endforelse  
                </table>
            </div>
            @else
                <p>レビューはありません</p>
            @endif
        </div>
    </div>
</main>
@endsection