<!DOCTYPE html>
<html lang="ja">
<head>
    <!--ブートストラップ-->
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact｜カフェ Mr. M COFFEE（ミスターエムコーヒー）</title>

</head>
<body>
    <!--ヘッダー-->
    <header class="py-4">
        <div class="container text-center">
            <h1><a href="bs"><img src="/storage/photos/bs-img/logo.png" alt="カフェMr.MCOFFEE"></a></h1>
        </div>
    </header>
    <!--/ヘッダー-->
    
    <!--ナビゲーションバー-->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
        <!--サブコンポーネント-->
        <div class="container">
            <!--ブランド-->
            <a class="navbar-brand" href="bs">Mr. M COFFEE</a>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="bs">Top <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bs#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bs#menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bs#coupon">Coupon</a>
                    </li>
                    <!-- ドロップダウン -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Information </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="bs#shop">Shop</a>
                            <a class="dropdown-item" href="bs#access">Access</a>
                        </div>
                    </li>
                </ul>
                <!-- 右側メニュー：Contactページへのリンク -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="bs-2" class="nav-link btn btn-info">Contact</a>
                    </li>
                </ul>
                <!-- /ナビゲーションメニュー -->
            </div>
            <!-- /サブコンポーネント -->
        </div>
    </nav>
    <!-- /ナビゲーションバー -->

    <!-- パンくずリスト -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb container">
            <li class="breadcrumb-item">
                <a href="bs">Top</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Contact
            </li>
        </ol>
    </nav>
<!-- /パンくずリスト -->

    <!--メイン-->
    <main>
        <div class="container">
            <h2>Contact</h2>
            <p>カフェ Mr. M COFFEE（ミスターエムコーヒー）への お問合せは、こちらのフォームをご利用ください。</p>
        </div>
        <!-- お問合せフォーム -->
        <div class="py-3">
            <div class="container">
                <h3 class="mb-3">お問合せフォーム</h3>
                <!-- フォーム -->
                <form>
                    <!-- お名前 -->
                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label">
                            お名前 <span class="badge badge-warning">必須</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="name" required>
                        </div>
                    </div>
                    <!-- メールアドレス -->
                    <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label">
                            メールアドレス <span class="badge badge-warning">必須</span>
                        </label>
                        <div class="col-md-9">
                            <input type="email" class="form-control" id="email" required>
                        </div>
                    </div>
                    <!-- きっかけ -->
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-md-3">
                                Mr. M COFFEEを知ったきっかけ
                            </legend>
                            <div class="col-md-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="questionnaire" id="radio1" value="answer1">
                                    <label class="form-check-label" for="radio1">口コミ</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="questionnaire" id="radio2" value="answer2">
                                    <label class="form-check-label" for="radio2">検索エンジン</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="questionnaire" id="radio3" value="answer3">
                                    <label class="form-check-label" for="radio3">検索エンジン</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <!-- 種類 -->
                    <div class="form-group row">
                        <label for="category" class="col-md-3 col-form-label">
                            お問合せ種類 <span class="badge badge-warning">必須</span>
                        </label>
                        <div class="col-md-9">
                            <select class="form-control" id="category" name="category">
                                <option value="category1">ご予約について</option>
                                <option value="category2">委託販売について</option>
                                <option value="category3">その他のお問合せ</option>
                            </select>
                        </div>
                    </div>
                    <!-- 内容 -->
                    <div class="form-group row">
                        <label for="message" class="col-md-3 col-form-label">
                            お問合せ内容 <span class="badge badge-warning">必須</span>
                        </label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="message" rows="8" name="message"></textarea>
                        </div>
                    </div>
                    <!-- 確認ボタン -->
                    <div class="form-group row justify-content-end">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary">確認する</button>
                        </div>
                    </div>
                </form>
                <!-- /フォーム -->
            </div>
        </div>
        <!-- / お問合せフォーム -->
    </main>
    <!--/メイン-->

    <!-- フッター -->
    <footer class="py-4 bg-dark text-light">
        <div class="container text-center">
            <!-- ナビゲーション -->
            <ul class="nav justify-content-center mb-3">
                <li class="nav-item">
                    <a class="nav-link" href="#">Top</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#news">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#menu">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#coupon">Coupon</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#shop">Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="test/bs-2">Contact</a>
                </li>
            </ul>
            <!-- /ナビゲーション -->
            <p>
                <small>Copyright &copy;2018 Mr. M COFFEE, All Rights Reserved.</small>
            </p>
        </div>
    </footer>
    <!-- /フッター -->
</body>
</html>