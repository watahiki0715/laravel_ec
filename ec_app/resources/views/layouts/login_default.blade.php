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
        <nav class="navbar navbar-expand-md navbar-dark" style="background-color:#FF5F17">
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
                            <a class="nav-link" href="http://localhost/login">ログイン</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/register">登録</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/admin/login">管理者</a>
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