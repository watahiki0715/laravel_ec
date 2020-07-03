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
                <div class="col-12 text-center my-2">
                    @if(count($ec_carts)>0)
                        <h1>ご購入ありがとうございます!</h1>
                    @endif
                </div>
                <table class="table table-bordered text-center">
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
                            <td class="align-middle">{{ $ec_cart->name }}</td>
                            <td class="align-middle">{{ number_format($ec_cart->price) }}円</td>
                            <td class="w-25 align-middle">{{ $ec_cart->amount }}個</td>
                            <td class="align-middle">
                                <?php $subtotal = $ec_cart->price * $ec_cart->amount;
                                    $total = $total + $subtotal;?>
                                {{ number_format($subtotal) }}円
                            </td>
                        </tr>
                    @empty
                        <li>商品はありません。</li>
                    @endforelse
                </table>
            </div>
            @if(count($ec_carts)>0)
                <div class="mx-2">
                    <p class="row justify-content-end mr-1">合計：{{ number_format($total) }}円</p>
                </div>
            @endif
        </div>
    </div>
</main>

@endsection