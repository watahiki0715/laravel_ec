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
        </div>

        <div class="container bg-white border pt-2 pb-4">
            <div class="row justify-content-center rounded-circle my-3 mx-2" style="background-color:#FF8856; color:white"> 
                <h1>{{ $title }}</h1>
            </div>

            <div class="row">
                <ul>
                    <li>注文番号：{{ $number }}</li>
                    <li>購入日時：{{ $datetime }}</li>
                    <li>合計金額：{{ number_format($total) }}円</li>
                </ul>
            </div>

            <div class="row mx-2">
                <table class="table table-bordered text-center">
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
            <a href="{{ $back }}" class="row d-block text-right mt-3 mx-2">戻る</a>
        </div>
    </div>
</main>

@endsection