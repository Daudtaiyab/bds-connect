<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>Bds Frontend | Login</title>
    @include('users.inc.head')
    @yield('head')
</head>
<body>
<div class="menu-panel">
	@include('users.inc.sidebar')
    @yield('sidebar')
</div>
<div class="menu-overlay"></div>
<div class="rightbar">
    <div class="top-nav">
       @include('users.inc.navbar')
     @yield('navbar')
    </div>
    @yield('content')
</div>
@include('users.inc.footer')
@yield('footer')
</body>
</html>