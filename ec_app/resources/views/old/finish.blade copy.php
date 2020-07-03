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

    @if(count($ec_carts)>0)
        <p>ご購入ありがとうございます!</p>
    @endif

    {{-- エラーメッセージを出力 --}}
    @if(session('message'))
    <p class="error">{{ session('message') }}</p>
    @endif

    <table class="table table-bordered">
        @if(count($ec_carts)>0)
        <thead class="thead-light">
            <tr>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>数量</th>
                <th>小計</th>
            </tr>
        </thead>
        @endif
        <?php $total = 0; ?>
        @forelse($ec_carts as $ec_cart)
        <tr>
            <td class="w-25"><img src="{{ asset('storage/photos/' . $ec_cart->image) }}" style="width:100px; height:80px;"></td>
            <td>{{ $ec_cart->name }}</td>
            <td>{{ number_format($ec_cart->price) }}円</td>
            <td class="w-25">{{ $ec_cart->amount }}個</td>
            <td>
                <?php $subtotal = $ec_cart->price * $ec_cart->amount;
                    $total = $total + $subtotal;?>
                {{ number_format($subtotal) }}円
            </td>
        </tr>
        @empty
            <li>商品はありません。</li>
        @endforelse
    </table>
    @if(count($ec_carts)>0)
        <p>合計：{{ number_format($total) }}円</p>
    @endif
</div>
@endsection