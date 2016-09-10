<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Simple POINT OF SALES, POS, Laravel, Vue" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Styles -->
    <link href="/css/all.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
</head>
<body>
    <div class="login">
        <h1><a href="/">Minimal </a></h1>
        <div class="login-bottom">
            <h2>Login</h2>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
            <div class="col-md-6">
                <div class="login-mail{{ $errors->has('email') ? ' has-error' : '' }}" >
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                    <i class="fa fa-envelope"></i>
                    @if ($errors->has('email'))
                    <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="login-mail{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" name="password" placeholder="Password" value="{{ old('email') }}" required autofocus>
                    <i class="fa fa-lock"></i>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                   <a class="news-letter " href="#">
                         <input type="checkbox" name="remember"> Remember Me
                       </a>

            
            </div>
            <div class="col-md-6 login-do">
                <label class="hvr-shutter-in-horizontal login-sub">
                    <input type="submit" value="login">
                    </label>
                <p>Forgot Your Password?</p>
                <a class="hvr-shutter-in-horizontal" href="{{ url('/password/reset') }}">Reset Password</a>
            </div>
            
            <div class="clearfix"> </div>
            </form>
        </div>
    </div>
        <!---->
<div class="copy-right">
            <p> &copy; 2016 Minimal. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>     </div>  
<!---->
<!-- Scripts -->
<script src="/js/all.js"></script>
<script src="/js/custom.js"></script>
<script src="/js/scripts.js"></script>
</body>
</html>
