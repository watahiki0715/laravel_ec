@extends('layouts.default')

@section('title', $title)

@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    
    {{-- エラーメッセージを出力 --}}
    @foreach($errors->all() as $error)
    <p class="alert alert-danger">{{ $error }}</p>
    @endforeach

    @if(session('message'))
    <p class="alert alert-primary">{{ session('message') }}</p>
    @endif

    @if($first != $last)
    <p>検索結果：{{ $count }} 件中 {{ $first }} 件目〜{{ $last }} 件目</p>
    @elseif($first != '')
    <p>検索結果：{{ $count }} 件中 {{ $first }} 件目</p>
    @else
    <p>検索結果：{{ $count }} 件</p>
    @endif

    <div class="row flex-wrap pagination">
        @forelse($ec_items as $ec_item)
            <span class="text-center card mx-5 mb-2 page-item disabled" style="width:350px; height:350px;">
                <span>
                    <img src="{{ asset('storage/photos/' . $ec_item->image) }}" style="width:250px; height:200px;">
                </span><br>
                <span>
                    {{ $ec_item->name }}
                </span><br>
                <span>
                    {{ number_format($ec_item->price) }}円
                </span>
                @if($ec_item->stock>0)
                    <form method="post" action="{{ url('/index') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="cart_id" value="{{ $ec_item->id }}">
                        <button type="submit">カートに入れる</button>
                    </form>
                @else
                    <p>売り切れです</p>
                @endif
            </span>
        @empty
            <li>商品はありません。</li>
        @endforelse   
    </div>
    {{ $ec_items->appends(request()->input())->links() }}
</div>
@endsection