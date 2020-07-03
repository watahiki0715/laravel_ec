@extends('layouts.admin-default')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>

    <form action="{{ url('/admin/logout') }}" method="post">
        {{ csrf_field() }}
        <button type="submit">ログアウト</button>
    </form><br>

    {{-- エラーメッセージを出力 --}}
    @foreach($errors->all() as $error)
    <p class="alert alert-danger">{{ $error }}</p>
    @endforeach

    {{-- エラーメッセージを出力 --}}
    @if(session('message'))
    <p class="alert alert-secondary">{{ session('message') }}</p>
    @endif

    {{-- 以下にフォームを追記します。 --}}
    {{-- enctypeの指定が必要です。 --}}
    <form method="post" action="{{ url("/admin/index") }}" enctype="multipart/form-data">
        {{-- LaravelではCSRF対策のため以下の一行が必須です。 --}}
        {{ csrf_field() }}

        <div>
            <label>
                商品名:
                <input type="text" name="create_name" class="name_field" placeholder="商品名を入力" required autofocus>
            </label>
        </div>

        <div>
            <label>
                価格：
                <input type="text" name="price" class="comment_field" placeholder="価格を入力" required>
                円
            </label>
        </div>

        <div>
            <label>
                画像：
                <input type="file" name="image">
            </label>
        </div>

        <div>
            <label>
                ステータス：
                <select name="status">
                    <option value="0">非公開</option>
                    <option value="1">公開</option>
                </select>
            </label>
        </div>

        <div>
            <label>
                在庫数：
                <input type="text" name="stock" class="comment_field" placeholder="在庫数を入力" required>
            </label>
        </div>

        <div>
            <label>
                詳細：
                <input type="text" name="detail" class="comment_field" placeholder="詳細を入力" required>
            </label>
        </div>

        <div>
        <label>
        カテゴリー：
            <select name="categories">
                <option value="">選択してください</option>
                <option value="寿司">寿司</option>
                <option value="ちらし・丼">ちらし・丼</option>
                <option value="刺身">刺身</option>
                <option value="サイドメニュー">サイドメニュー</option>
                <option value="飲み物">飲み物</option>
                <option value="デザート">デザート</option>
                <option value="その他">その他</option>
            </select>
            </label>
        </div>

        <div>
            <input type="submit" value="追加">
        </div>
    </form><br>

    <table class="table table-bordered">
        @if(count($ec_items)>0)
        <thead class="thead-light">
            <tr>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>ステータス</th>
                <th>カテゴリー</th>
                <th>詳細</th>
                <th>操作</th>
            </tr>
        </thead>
        @endif

        @forelse($ec_items as $ec_item)
        @if($ec_item->status != 1)
        <tr class="bg-secondary">
        @else
        <tr>
        @endif
            <td><img src="{{ asset('storage/photos/' . $ec_item->image) }}" style="width:100px; height:80px;"></td>
            <td>
                <form method="post" action="{{ url('/admin/index') }}">
                    {{ csrf_field() }}
                    <input type="text" value="{{ $ec_item->name }}" name="update_name">
                    <input type="hidden" value="{{ $ec_item->id }}" name="name_id">
                    <button type="submit">変更する</button>
                </form>
            </td>
            <td>
                <form method="post" action="{{ url('/admin/index') }}">
                    {{ csrf_field() }}
                    <input type="text" value="{{ $ec_item->price }}" name="update_price">円
                    <input type="hidden" value="{{ $ec_item->id }}" name="price_id">
                    <button type="submit">変更する</button>
                </form>
            </td>
            <td>
                <form method="post" action="{{ url('/admin/index') }}">
                    {{ csrf_field() }}
                    <input type="text" value="{{ $ec_item->stock }}" name="update_stock">個
                    <input type="hidden" value="{{ $ec_item->id }}" name="stock_id">
                    <button type="submit">変更する</button>
                </form>
            </td>
            <td>
                <form method="post" action="{{ url('/admin/index') }}">
                {{ csrf_field() }}
                    <input type="hidden" value="{{ $ec_item->id }}" name="status_id">
                    <input type="hidden" value="{{ $ec_item->status }}" name="update_status">                       
                    @if($ec_item->status != 1)
                        <input type="submit" value="非公開→公開">
                    @endif
                    @if($ec_item->status != 0)
                        <input type="submit" value="公開→非公開">
                    @endif
                </form>
            </td>
            <td>
                <form method="post" action="{{ url('/admin/index') }}">
                    {{ csrf_field() }}
                <select name="update_categories">
                    <option value="{{ $ec_item->categories }}">{{ $ec_item->categories }}</option>
                    @if($ec_item->categories != '寿司')
                    <option value="寿司">寿司</option>
                    @endif
                    @if($ec_item->categories != 'ちらし・丼')
                    <option value="ちらし・丼">ちらし・丼</option>
                    @endif
                    @if($ec_item->categories != '刺身')
                    <option value="刺身">刺身</option>
                    @endif
                    @if($ec_item->categories != 'サイドメニュー')
                    <option value="サイドメニュー">サイドメニュー</option>
                    @endif
                    @if($ec_item->categories != '飲み物')
                    <option value="飲み物">飲み物</option>
                    @endif
                    @if($ec_item->categories != 'デザート')
                    <option value="デザート">デザート</option>
                    @endif
                    @if($ec_item->categories != 'その他')
                    <option value="その他">その他</option>
                    @endif
                </select>
                    <input type="hidden" value="{{ $ec_item->id }}" name="categories_id">
                    <button type="submit">変更する</button>
                </form>
            </td>
            <td>
                <form method="post" action="{{ url('/admin/index') }}">
                    {{ csrf_field() }}
                    <textarea name="update_detail" value="{{ $ec_item->detail }}">{{ $ec_item->detail }}</textarea>
                    <input type="hidden" value="{{ $ec_item->id }}" name="detail_id">
                    <button type="submit">変更する</button>
                </form>
            </td>
            <td>
                <form method="post" action="{{ url('/admin/index') }}">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $ec_item->id }}" name="delete_id">
                    <input type="hidden" value="{{ $ec_item->image }}" name="image">
                    <button type="submit">削除する</button>
                </form>
            </td>
        </tr>
        @empty
            <li>商品はありません。</li>
        @endforelse
    </table>
    {{ $ec_items->links() }}

@endsection