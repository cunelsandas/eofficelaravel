<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('settings.system_title')}}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #575e62;
            font-family: 'Prompt', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            background-image: url("https://images.unsplash.com/photo-1468779036391-52341f60b55d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1521&q=80");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 5px 20px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border: 1px solid #636b6f;
            border-radius: 10px;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ route('admin.dashboard') }}">หน้าแรก</a>
            @else
                <a href="{{ route('login') }}">เข้าสู่ระบบ</a>
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
{{--            {{config('settings.system_title')}}--}}
           <b style="color: #e30742"> ระบบงานสารบรรณอิเล็กทรอนิกส์</b><br>
            <b>(E-Office)</b>
        </div>

        <div class="links">
            <blockquote>
{{--                {{$quotes}}--}}
            </blockquote>
        </div>
    </div>
</div>
</body>
</html>
