<!DOCTYPE html>
<html>

<head>
    <!-- <meta charset="utf-8"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <style type="text/css">
        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .mytemplate {
            border: 1px solid #efefef;
            width: 800px;
            margin: 20px auto;
            border-radius: 8px;
            background: white;
            overflow: hidden;
            font-family: 'arial', sans-serif;
        }

        .template-title {
            background: #00569B;
            padding: 20px 0;
        }

        .template-title img {
            width: 70px;
        }

        .template-title h2 {
            font-family: 'arial', sans-serif;
            font-weight: bold;
            color: white;
        }

        p,
        li {
            font-size: 16px;
        }
    </style>
</head>

<body style="background: #efefef; padding: 20px 0;">
    <div style="" class="mytemplate" style="">
        <div class="logo" style="width: 100%; display:flex; justify-content:center; align-items:center;">
            <img src="{{ asset('user/img/bds.png') }}" style="margin:20px auto; width: 150px;">
        </div>

        <div class="template-title" style="width:100%;">
            <img src="{{ asset('user/img/email.png') }}" style="display:inherit; margin: 10px auto;">
            <h2 style="text-align: center; width: 100%; color:#FAD300;">Welcome to Bds Education</h2>
        </div>
        <div class="template-content" style="padding:20px;">
            <p>Dear <b>{{ $userData['name'] }}</b>,</p>
            <p>Greetings!</p>
            <p>You recently requested to reset your password for bdseducation.in account. Use the button below to reset
                it.</p>
            <div style="display:flex; justify-content:center; align-items:center;">
                <a href="{{ $url }}"
                    style="padding:10px 25px; background: #f4a51c; color:black; text-decoration:none;">Reset
                    Password</a>
            </div>
        </div>
        <div class="footer" style="background: #00569B; padding:20px;">
            <h3 style="color: white; text-align: center; margin-bottom:0">Connect With Us On</h3>
            <div class="temaplate-line" style="width:40px; height: 3px; background: white; margin:10px auto;"></div>
            <div class="social-icons" style="text-align: center;">
                <a href="#" style="margin-right: 8px;"><img src="{{ asset('user/img/facebook.png') }}"
                        style="width: 30px;"></a>
                <a href="#" style="margin-right: 8px;"><img src="{{ asset('user/img/instagram.png') }}"
                        style="width: 30px;"></a>
                <a href="#" style="margin-right: 8px;"><img src="{{ asset('user/img/twitter.png') }}"
                        style="width: 30px;"></a>
                <a href="#"><img src="{{ asset('user/img/linkedin.png') }}" style="width: 30px;"></a>
            </div>
            <p style="color:white; text-align: center;">&copy; Copyright and All Right Reserved By BDS Education</p>
        </div>
    </div>
</body>

</html>
