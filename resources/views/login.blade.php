<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bds Frontend | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('asset/js/bootstrap.bundle.min.js') }}/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
</head>

<body>
    @php
        if (isset($_COOKIE['login_email']) && isset($_COOKIE['login_pass'])) {
            $login_email = $_COOKIE['login_email'];
            $login_pass = $_COOKIE['login_pass'];
            $is_remember = "checked='checked'";
        } else {
            $login_email = '';
            $login_pass = '';
            $is_remember = '';
        }
    @endphp
    @if (Auth::check() && Auth::user()->user_role_id == '1')
        <script>
            window.location = '{{ route('home') }}';
        </script>
    @elseif(Auth::check() && Auth::user()->user_role_id == '2')
        <script>
            window.location = '{{ route('deviceForm') }}';
        </script>
    @endif
    <div class="main-wrapper">
        <div class="white-box">
            <div class="login-form-outer">
                <div class="container">
                    <div class="row d-flex justify-content-center align-items-center w-100">
                        <div class="col-md-9">
                            <div class="connect-design">
                                <div class="row w-100 g-0">
                                    <div class="col-md-7">
                                        <div class="logo-img">
                                            <div class="bds-logo">
                                                <img src="{{ asset('asset/img/bds.png') }}">
                                            </div>
                                            <h3><span>Coding</span> is the new <span>english</span> of
                                                <span>tomorrow</span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-md-5 p-4">
                                        <div class="login-form">
                                            <h4>Login</h4>
                                            @include('layouts.noftification')
                                            <div class="line"></div>
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf

                                                <div class="form-floating mb-3">
                                                    <select class="form-control" name="user_role_id" id="user_role_id"
                                                        required="">
                                                        <option value="">--Select User Type--</option>
                                                        <option value="2">User</option>
                                                        <option value="1">Admin</option>
                                                    </select>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input id="email" type="text"
                                                        class="form-control @error('username') is-invalid @enderror"
                                                        name="email" value="{{ old('email') ?? $login_email }}"
                                                        required autocomplete="email" autofocus>
                                                    <label for="floatingInput">Username</label>
                                                    @error('username')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-floating mb-3">

                                                    <input id="password" type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" required autocomplete="current-password"
                                                        value="{{ $login_pass }}">
                                                    <label for="floatingPassword">Password</label>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center w-100">
                                                    <label class="text-white">
                                                        <input type="checkbox" name="rememberme" {{ $is_remember }}>
                                                        Remember me </label>
                                                    <a href="{{ route('password.request') }}"
                                                        class="fr rememberme">Forget Password</a>
                                                </div>

                                                <div class="d-flex justify-content-center align-items-center w-100">
                                                    <button type="submit" name="submit" class="button">Login
                                                        Now</button>&nbsp;
                                                    <!--<a href="{{ route('userregister') }}"><button type="button" name="submit" class="button">Register</button></a>-->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>
