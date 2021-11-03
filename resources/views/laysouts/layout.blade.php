<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>科技大學校園資訊管理系統</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    {{-- 才能讓系統找到這個檔案，因為是在css目錄下 --}}
</head>
<body>

    <div class="container">
        <div class="header w-100">
            <img src="{{asset('img/01B01.jpg')}}" alt="" class="w-100">
        </div>
        <div class="main d-flex" style="height: 568px;">
            @yield("main")
        </div>
        <div class="footer w-100">
            <div class="text-center" style="height:100px;line-height:100px;background:yellow;">頁尾版權</div>
        </div>
    </div>
    <div id="modal"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>
</html>
@yield("script")
