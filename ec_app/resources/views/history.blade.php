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
            
            <div class="row mx-2">
                <table class="table table-bordered text-center">
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
            <div class="row justify-content-center">
                {{ $ec_histories->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</main>

@endsection