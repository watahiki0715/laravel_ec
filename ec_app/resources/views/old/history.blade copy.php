@extends('layouts.default')

@section('title', $title)

@section('content')
<div class="container-fluid">
    <h1>{{ $title }}</h1>
    <a href="{{ url('/index') }}">商品一覧へ</a><br>
    <a href="{{ url('/cart') }}">カートへ</a>
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

    <table class="table table-bordered">
        @if(count($ec_histories)>0)
        <thead class="thead-light">
            <tr>
                <th>注文番号</th>
                <th>購入日時</th>
                <th>合計金額</th>
                <th>購入明細</th>
            </tr>
        </thead>
        @endif

        @forelse($ec_histories as $ec_history)
        <tr>
            <td>{{ $ec_history->id }}</td>
            <td>{{ $ec_history->created_at }}</td>
            <td class="w-25">{{ number_format($ec_history->total) }}円</td>
            <td>
                <form method="get" action="{{ url('/history_detail') }}">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $ec_history->id }}" name="history_id">
                    <input type="hidden" value="{{ $ec_history->created_at }}" name="datetime">
                    <input type="hidden" value="{{ $ec_history->total }}" name="total"> 
                    <button type="submit">確認</button>
                </form>
            </td>
        </tr>
        @empty
            <li>購入履歴はありません。</li>
        @endforelse
    </table>
</div>
@endsection