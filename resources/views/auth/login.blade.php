<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ config('app.name', 'Dr') }}</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ url('/')}}/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ url('/')}}/assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ url('/')}}/assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ url('/')}}/assets/css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box js-animating-object">
        <div class="logo">
            <a href="javascript:void(0);"><b>{{ config('app.name', 'Dr') }}</b></a>
         
        </div>
        <div class="card ">
            <div class="body">
                <form id="sign_in" role="form" method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Id" required autofocus>
                            @if ($errors->has('email'))
                             <span class="help-block">
                             <strong>{{ $errors->first('email') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line ">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                            @if ($errors->has('password'))
                             <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                             </span>
                           @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                          <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="{{ url('/')}}/assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ url('/')}}/assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ url('/')}}/assets/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="{{ url('/')}}/assets/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="{{ url('/')}}/assets/js/admin.js"></script>
    <script src="{{ url('/')}}/assets/js/pages/examples/sign-in.js"></script>
    <script type="text/javascript">
    
    $(document).ready(function(){

        var animation = "bounceIn";
        $('.js-animating-object').animateCss(animation);
    });


//Copied from https://github.com/daneden/animate.css
$.fn.extend({
    animateCss: function (animationName) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        $(this).addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
        });
    }
});
    </script>
</body>

</html>