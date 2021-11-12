<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- 加上 可以在送ajax請求時送csrf token:patch put delete會變動到資料庫的請求時 --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>科技大學校園資訊管理系統</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    {{-- 才能讓系統找到這個檔案，因為是在css目錄下 --}}
</head>
<body>

    <div class="container">
        <div class="header w-100">
            {{-- @isset($useTitle) --}}
            {{-- 這邊用-> 取物件(collection)的東西 --}}
            <img src="{{asset('storage/'.$title->img)}}" alt="{{ $title->text }}" class="w-100">
            {{-- @endisset --}}
        </div>
        <div class="main d-flex" style="height: 568px;">
            @yield("main")
        </div>
        <div class="footer w-100">
            <div class="text-center" style="height:100px;line-height:100px;background:yellow;">{{ $bottom }}</div>
        </div>
    </div>
    <div id="modal"></div>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
    {{-- 官网jquery压缩版引用地址: --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>
@yield("script")
