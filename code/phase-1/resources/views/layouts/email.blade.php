<!DOCTYPE html>
<html lang="en">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Email</title>
    <style>
    .email-block {
        background: #273339;
        width: 600px;
        margin: 0 auto;
        padding: 0 0 30px;
        border-bottom: 5px solid #000;
    }
    .email-template {
        margin: 20px 50px;
        background: #fff;
        padding: 25px;
        color: #343434;
        font-size: 14px;
    }
    .logo {
        padding: 50px 0 30px;
        text-align: center;
    }
    .social-icons .fa {
        color: #fff;
        font-size: 24px;
        margin: 0 5px;
    }
    .f-menu {
        color: #fff;
    }
    .f-menu .link-row {
        display: inline-block;
        text-align: center;
        margin: 10px 0;
    }
    .f-menu .link-row a {
        display: inline-block;
        font-size: 14px;
        color: #fff;
        padding: 0 15px;
    }
    .note {
        font-size: 12px;
        font-style: italic;
        color: #989898;
    }
    .email-name {
        font-size: 18px;
        color: #000;
        font-weight: bold;
        margin: 0 0 15px;
    }
    .username {
        font-size: 16px;
        font-weight: bold;
        color: #223144;
        margin: 5px 0 0;
    }
    .username span {
        font-weight: normal;
    }
    .logon-change {
        font-size: 11px;
        color: #343434;
        font-weight: normal;
        font-style: italic;
    }
    .thank {
        color: #000;
        font-weight: bold;
        margin: 20px 0 0;
    }
    .thank span {
        display: block;
        font-weight: normal;
    }
    footer {
        text-align: center;
    }
    </style>
</head>

<body >
    <div class="email-block">
        <div class="logo "> <a id="logo-container" href="#" class="brand-logo"><img src="{!! asset('user/images/logo.png') !!}" /></a> </div>
        
        @yield('content')
        
        <!--  FOOTER  -->
        <footer class="page-footer footer-black">
            <div class="footer-main-content">
                <div class="row">
                    <div class="col l12 s12 text-center">
                        <div class="social-icons"> 
                        		<img src="{!! asset('general/img/fb.png') !!}" />
                            <img src="{!! asset('general/img/tw.png') !!}" />
                            <img src="{!! asset('general/img/g+.png') !!}" />
                        </div>
                        <div class="f-menu">
                            <div class="link-row"><a  href="{!! env('APP_URL', 'http://dev.esportcolosseum.loc') !!}">Home</a></div>
                            |
                            <div class="link-row"><a  href="{!! env('APP_URL', 'http://dev.esportcolosseum.loc') !!}">Games</a></div>
                        </div>
                        <div class="note">You don’t need to reply to this mail as it is an automated mail.</div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>