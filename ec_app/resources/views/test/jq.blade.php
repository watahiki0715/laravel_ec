<!DOCTYPE html>
<html lang="ja">
<head>
    <script src="//code.jquery.com/jquery-3.5.1.min.js"></script> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>jqueryテスト</title>

    <script>
        jQuery(function($){
            $("#color_div").css("border","1px solid red");
        });
    </script>

</head>
<body>
    <div id="color_div">ここのDIVの枠線をjQueryで変更します</div>
</body>
</html>