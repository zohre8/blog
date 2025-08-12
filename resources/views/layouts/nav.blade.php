<!doctype html>
<html lang="en">
<head>


    <title>@yield('title', 'My Site')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

{{--    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface&display=swap" rel="stylesheet">--}}
    @vite([
    'public/css/app.css',
    'public/css/open-iconic-bootstrap.min.css',
    'public/css/animate.css',
    'public/css/owl.carousel.min.css',
    'public/css/owl.theme.default.min.css',
    'public/css/magnific-popup.css',
    'public/css/aos.css',
    'public/css/ionicons.min.css',
    'public/css/bootstrap-datepicker.css',
    'public/css/jquery.timepicker.css',
    'public/css/flaticon.css',
    'public/css/icomoon.css',
    'public/css/style.css',
    ])

</head>
<body>
<div id="colorlib-page">
    <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
    <aside id="colorlib-aside" role="complementary" class="js-fullheight img" style="background-image: url(images/sidebar-bg.jpg);">
        <h1 id="colorlib-logo" class="mb-4"><a href="index.html">ionize</a></h1>
        <nav id="colorlib-main-menu" role="navigation">
            <ul>
                <li class="colorlib-active"><a href="">خانه</a></li>
                <li><a href="">دل نوشته ها</a></li>
                <li><a href="">طبیعت</a></li>
                <li><a href="">سبک زندگی</a></li>
                <li><a href="">درباره ما</a></li>
                <li><a href="">تماس با ما</a></li>
            </ul>
        </nav>

        <div class="colorlib-footer">
            <div class="mb-4">
                <h3>برای خبرنامه مشترک شوید</h3>
                <form action="#" class="colorlib-subscribe-form">
                    <div class="form-group d-flex">
                        <div class="icon"><span class="icon-paper-plane"></span></div>
                        <input type="text" class="form-control" placeholder="آدرس ایمیل را وارد کنید">
                    </div>
                </form>
            </div>
            <p class="pfooter"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                حق چاپ &copy;<script>document.write(new Date().getFullYear());</script><br> تمامی حقوق محفوظ است | این قالب با <i class="icon-heart" aria-hidden="true"></i> توسط <a href="https://colorlib.com" target="_blank">وب سایت دل نوشته</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        </div>
    </aside> <!-- END COLORLIB-ASIDE -->
    <div id="colorlib-main">
        @yield('content')
    </div><!-- END COLORLIB-MAIN -->

</div>
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

{{----}}

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/aos.js') }}"></script>
<script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('js/scrollax.min.js') }}"></script>
{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>--}}
<script src="{{ asset('js/google-map.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@livewireScripts

</body>
</html>
