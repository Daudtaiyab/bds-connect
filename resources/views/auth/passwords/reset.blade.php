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
                    <h4>Change Password</h4>
                    <div class="line"></div>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                         
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-floating mb-3">
                           <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                          <label for="floatingInput">{{ __('E-Mail Address') }}</label>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-floating mb-3">

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                          <label for="floatingPassword">{{ __('Password') }}</label>
                          @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                         <div class="form-floating mb-3">

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                          <label for="floatingPassword">{{ __('Confirm Password') }}</label>
                          
                        </div>

                       

                        <div class="d-flex justify-content-center align-items-center w-100">
                            <button type="submit" name="submit" class="button">{{ __('Reset Password') }}</button>
                        </div>
                    </form>   
                </div>    
            </div>            
        </div>
    </div>
</body>
</html>