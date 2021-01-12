<DOCTYPE HTML>
<html lang="ja">
<head>
@yield('head')
</head>
<body>
@yield('header')
<div class="contents">
    <!-- コンテンツ -->
    <div class="main">
        @yield('content')
    </div>
</div>
 
@yield('footer')

