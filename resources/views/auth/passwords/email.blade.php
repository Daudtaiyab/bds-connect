<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bds Frontend | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('public/asset/css')}}/bootstrap.min.css" rel="stylesheet">
    <script src="{{asset('public/asset/js')}}/bootstrap.bundle.min.js"></script>
    <link href="{{asset('public/asset/css')}}/style.css" rel="stylesheet">
</head>
<body>
   
    <div class="main-wrapper">
        <div class="white-box">
            <div class="login-form-outer">
                <div class="logo-img">
                    <div class="bds-logo">
                        <img src="{{asset('public/asset/img')}}/bds.png">
                    </div>
                    <div class="aps-logo">
                        <img src="{{asset('public/asset/img')}}/aps.png">
                    </div>
                </div>
                <div class="login-form">
                    <h4>Forgot Password</h4>
                    <div class="line"></div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                         
                        

                        <div class="form-floating mb-3">
                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                          <label for="floatingInput">{{ __('E-Mail Address') }}</label>
                           @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                       
                     <a href="{{route('login')}}">Back to Login</a>

                        <div class="d-flex justify-content-center align-items-center w-100">
                            <button type="submit" name="submit" class="button">{{ __('Send Password Reset Link') }}</button>
                        </div>
                    </form>   
                </div>    
            </div>            
        </div>
    </div>
</body>
</html>