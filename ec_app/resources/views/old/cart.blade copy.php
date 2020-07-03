@extends('layouts.default')

@section('title', $title)

@section('content')
<div class="container-fluid mx-5">
    <h1>{{ $title }}</h1>
    <a href="{{ url('/index') }}">商品一覧へ</a><br>
    <a href="{{ url('/history') }}">購入履歴へ</a>
    {{-- 以下を追記 --}}
    <p>現在のユーザー名: {{ Auth::user()->name }} </p>
    <form action="{{ url('/logout') }}" method="post">
        {{ csrf_field() }}
        <button type="submit">ログアウト</button>
    </form><br>

    {{-- エラーメッセージを出力 --}}
    @foreach($errors->all() as $error)
    <p class="error">{{ $error }}</p>
    @endforeach

    {{-- エラーメッセージを出力 --}}
    @if(session('message'))
    <p class="error">{{ session('message') }}</p>
    @endif

    <table class="table table-bordered text-center" style="width:1300px;">
        @if(count($ec_carts)>0)
        <thead class="thead-light">
            <tr>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>数量</th>
                <th>小計</th>
                <th>操作</th>
            </tr>
        </thead>
        @endif
        <?php $total = 0; ?>
        @forelse($ec_carts as $ec_cart)
        <tr>
            <td class="align-middle"><img src="{{ asset('storage/photos/' . $ec_cart->image) }}" style="width:100px; height:80px;"></td>
            <td class="align-middle">{{ $ec_cart->name }}</td>
            <td class="align-middle">{{ number_format($ec_cart->price) }}円</td>
            <td class="align-middle">
                <form method="post" action="{{ url('/cart') }}">
                    {{ csrf_field() }}
                    <input type="text" value="{{ $ec_cart->amount }}" name="amount">個
                    <input type="hidden" value="{{ $ec_cart->carts_id }}" name="amount_id">
                    <button type="submit">変更する</button>
                </form>
            <td class="align-middle">
                <?php $subtotal = $ec_cart->price * $ec_cart->amount;
                    $total = $total + $subtotal;?>
                {{ number_format($subtotal) }}円
            </td>
            <td class="align-middle">
                <form method="post" action="{{ url('/cart') }}">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $ec_cart->carts_id }}" name="delete_id">
                    <button type="submit">削除する</button>
                </form>
            </td>
        </tr>
        @empty
            <li>商品はありません。</li>
        @endforelse
    </table>
    @if(count($ec_carts)>0)
        <p>合計：{{ number_format($total) }}円</p>
        <form method="post" action="{{ url('/cart') }}">
            {{ csrf_field() }}
            <button type="submit" name="buy" value="buy">購入する</button>
        </form>
    @endif
</div>
@endsection