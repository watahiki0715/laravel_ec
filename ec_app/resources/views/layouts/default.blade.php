<!DOCTYPE html>
<html lang="ja">
<head>
    <!--ブートストラップ-->
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body style="background-color:#FFFFCC;">
    <header class="sticky-top">
        <!--ナビゲーションバー-->
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#FF5F17">
            <!--サブコンポーネント-->
            <div class="container">
                <!--ブランド-->
                <a class="navbar-brand" href="index"><h3>SUSHI EC SITE</h3></a>
                <!--切り替えボタン-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false"aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- /サブコンポーネント -->
                <!-- ナビゲーション -->
                <div class="collapse navbar-collapse" id="navbar-content">
                    <!-- ナビゲーションメニュー -->
                    <!-- 左側メニュー：トップページの各コンテンツへのリンク -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index">ホーム</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart">カート</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="history">購入履歴</a>
                        </li>
                    </ul>
                    <!--検索-->
                    <ul class="navbar-nav">
                        <li class="nav-item countainer">
                            <form action="{{ url('/logout') }}" method="post" class="row justify-content-lg-around py-2">
                                {{ csrf_field() }}
                                <span class="text-white mr-1 ml-3 mt-2">ようこそ {{ Auth::user()->name }} さん</span>
                                <button type="submit" class="my-2 ml-3">ログアウト</button>
                            </form>

                            <form method="get" action="{{ url('/index') }}">
                            {{ csrf_field() }}
                                <select name="search_categories" style="height:30px" class="mb-2">
                                    @if($categories != '')
                                        <option value="{{ $categories }}">{{ $categories }}</option>
                                    @else
                                        <option value="">すべて</option>
                                    @endif
                                    @if($categories != '')
                                        <option value="">すべて</option>
                                    @endif
                                    @if($categories != '寿司')
                                        <option value="寿司">寿司</option>
                                    @endif
                                    @if($categories != 'ちらし・丼')
                                        <option value="ちらし・丼">ちらし・丼</option>
                                    @endif
                                    @if($categories != '刺身')
                                        <option value="刺身">刺身</option>
                                    @endif
                                    @if($categories != 'サイドメニュー')
                                        <option value="サイドメニュー">サイドメニュー</option>
                                    @endif
                                    @if($categories != '飲み物')
                                        <option value="飲み物">飲み物</option>
                                    @endif
                                    @if($categories != 'デザート')
                                        <option value="デザート">デザート</option>
                                    @endif
                                    @if($categories != 'その他')
                                        <option value="その他">その他</option>
                                    @endif
                                </select>
                                <select name="sort" style="height:30px" class="mb-2">
                                    @if($sort != '')
                                        <option value="{{ $sort }}">{{ $sort }}</option>
                                    @else
                                        <option value="">登録順</option>
                                    @endif
                                    @if($sort != '')
                                        <option value="">登録順</option>
                                    @endif
                                    @if($sort != '価格が高い順')
                                        <option value="価格が高い順">価格が高い順</option>
                                    @endif
                                    @if($sort != '価格が低い順')
                                        <option value="価格が低い順">価格が低い順</option>
                                    @endif
                                </select>
                                <div class="d-md-none"></div>
                                <input type="text" value="{{ $text }}" name="search_text" class="mb-2">
                                <button type="submit">検索</button>
                            </form>
                        </li>
                    </ul>
                    <!-- /ナビゲーションメニュー -->
                </div>
                <!-- /サブコンポーネント -->
            </div>
        </nav>
        <!-- /ナビゲーションバー -->
    </header>
    @yield('content')
</body>
</html>