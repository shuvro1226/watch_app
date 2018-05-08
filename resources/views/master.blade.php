<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('templates.head')
</head>
<body>
<header>
    @include('templates.header')
</header>
<div class="container mb-5">
    <div id="main">
        @yield('content')
        @include('templates.modals')
    </div>
</div>
<footer>
    @include('templates.footer')
</footer>
</body>
</html>
