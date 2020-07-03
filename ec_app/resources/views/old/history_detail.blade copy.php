@extends('layouts.default')

@section('title', $title)

@section('content')
<div class="container-fluid">
    <h1>{{ $title }}</h1>
    <a href="{{ url('/index') }}">商品一覧へ</a><br>
    <a href="{{ url('/cart') }}">カートへ</a><br>
    <a href="{{ url('/history') }}">購入履歴へ</a>
    {{-- 以下を追記 --}}
    <p>現在のユーザー名: {{ Auth::user()->name }} </p>
    <form action="{{ url('/logout') }}" method="post">
        {{ csrf_field() }}
        <button type="submit">ログアウト</button>
    </form>

    {{-- エラーメッセージを出力 --}}
    @foreach($errors->all() as $error)
    <p class="error">{{ $error }}</p>
    @endforeach
    
    <br><p>注文番号：{{ $number }}</p>
    <p>購入日時：{{ $datetime }}</p>
    <p>合計金額：{{ number_format($total) }}円</p>
    
    <table class="table table-bordered">
        @if(count($ec_details)>0)
        <thead class="thead-light">
            <tr>
                <th>商品名</th>
                <th>価格</th>
                <th>購入数</th>
                <th>小計</th>
            </tr>
        </thead>
        @endif

        @forelse($ec_details as $ec_detail)
        <tr>
            <td>{{ $ec_detail->name }}</td>
            <td>{{ number_format($ec_detail->price) }}円</td>
            <td class="w-25">{{ number_format($ec_detail->amount) }}個</td>
            <td>{{ number_format($ec_detail->subtotal) }}円</td>
        </tr>
        @empty
            <li>購入詳細の取得に失敗しました</li>
        @endforelse   
    </table>
</div>
@endsection