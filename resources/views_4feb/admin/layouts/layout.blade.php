<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bds Frontend | Login</title>
    @include('admin.inc.head')
    @yield('head')
</head>
<body class="admin-body">
    <div class="">
        <div class="white-box">
           <div class="admin-panel">
                <div class="sidebar-menu">
                    @include('admin.inc.sidebar')
                </div>
            </div>
                <div class="menu-overlay"></div>
                <div class="rightbar">
                    @include('admin.inc.navbar')
                    @yield('content')
                </div>
           </div>                
        </div>
    @include('admin.inc.footer')
    @yield('footer')
</body>
</html>