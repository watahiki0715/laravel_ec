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

            @if(session('message'))
                <p class="alert alert-secondary">{{ session('message') }}</p>
            @endif

            <!-- カルーセル外枠 -->
            <div id="main_visual" class="carousel slide" data-ride="carousel">
                <!-- インジケーター -->
                <ol class="carousel-indicators">
                    <li data-target="#main_visual" data-slide-to="0" class="active"></li>
                    <li data-target="#main_visual" data-slide-to="1"></li>
                    <li data-target="#main_visual" data-slide-to="2"></li>
                </ol>
                <!-- / インジケーター -->
                <!-- カルーセル内枠 -->
                <div class="carousel-inner">
                    <!-- スライド01 -->
                    <div class="carousel-item active">
                        <img class="img-fluid" src="/storage/photos/ec/view.jpg" alt="写真1">
                        <div class="carousel-caption d-none d-md-block">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <!-- / スライド01 -->
                    <!-- スライド02 -->
                    <div class="carousel-item">
                        <img class="img-fluid" src="/storage/photos/ec/view2.jpg" alt="写真2">
                        <div class="carousel-caption d-none d-md-block">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <!-- / スライド02 -->
                    <!-- スライド03 -->
                    <div class="carousel-item">
                        <img class="img-fluid" src="/storage/photos/ec/view3.jpg" alt="写真3">
                        <div class="carousel-caption d-none d-md-block">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <!-- / スライド03 -->
                </div>
                <!-- / カルーセル内枠 -->
                <!-- コントローラー -->
                <a class="carousel-control-prev" href="#main_visual" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">前に戻る</span> </a>
                <a class="carousel-control-next" href="#main_visual" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">次に進む</span> </a>
                <!-- / コントローラー -->
            </div>
            <!-- / カルーセル外枠 -->
        </div>
    </div>

    <div class="py-4">
        <div class="container bg-white border">
            <div class="row justify-content-center rounded-circle my-3" style="background-color:#FF8856; color:white">
                <h1>{{ $title }}</h1>
            </div>

            <div class="row justify-content-around card-colums">
                @forelse($ec_items as $ec_item)
                    <div class="card col-3 text-center mx-2 my-4">
                        <form method="get" action="{{ url('/item_detail') }}">
                            <input type="hidden" name="item_id" value="{{ $ec_item->id }}">
                            <input type="image" src="{{ asset('storage/photos/' . $ec_item->image) }}" alt="" class="card-img-top">
                        </form>
                        <div class="card-body">
                            <p class="card-title col-12">{{ $ec_item->name }}</p>
                            <p class="card-text col-12">{{ number_format($ec_item->price) }}円</p>
                            @if($ec_item->stock>0)
                                <form method="post" action="{{ url('/index') }}" class="col-12">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="cart_id" value="{{ $ec_item->id }}">
                                    <button type="submit">カートに入れる</button>
                                </form>
                            @else
                                <p>売り切れです</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <p>商品はありません。</p>
                @endforelse
            </div>
            <div class="row justify-content-center">
                {{ $ec_items->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</main>
@endsection