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
            <div class="mx-2">
                <form method="post" action="{{ url('/review_edit') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="edit_id" value="{{ $review->id }}">
                    <textarea class="w-100" name="text" style="height:80px" required>{{ $review->review }}</textarea><br>
                    <button type="submit" class="w-100">編集する</button>
                </form>
                <a href="{{ $back }}" class="d-block text-right mt-3">戻る</a>
            </div>
        </div>
    </div>
</main>
@endsection