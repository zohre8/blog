<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>@yield('title', 'داشبورد')</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('css/admin/font-awesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/admin/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/bootstrap3-wysihtml5.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/persian-datepicker.min.css') }}">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{ asset('css/admin/bootstrap-rtl.min.css') }}">
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{ asset('css/admin/custom-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dataTables.bootstrap4.css') }}">


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars" style="color: #4b4b4b !important;"></i></a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">@csrf</form>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #4b4b4b !important;">خروج</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="" class="nav-link"  style="color: #4b4b4b !important;">پروفایل</a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav mr-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown" >
                <a class="nav-link color-black" data-toggle="dropdown" href="#" style=" color: #4b4b4b !important;">
                    <i class="fa fa-comments-o"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{ asset('images/admin/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 ml-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title" style=" color: #4b4b4b !important;">
                                حسام موسوی
                                    <span class="float-left text-sm text-danger"><i class="fa fa-star"></i></span>
                                </h3>
                                <p class="text-sm" style=" color: #899097 !important;">با من تماس بگیر لطفا...</p>
                                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{ asset('images/admin/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle ml-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title" style=" color: #4b4b4b !important;">
                                    پیمان احمدی
                                    <span class="float-left text-sm text-muted"><i class="fa fa-star"></i></span>
                                </h3>
                                <p class="text-sm" style=" color: #899097 !important;">من پیامتو دریافت کردم</p>
                                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{ asset('images/admin/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle ml-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title" style=" color: #4b4b4b !important;">
                                    سارا وکیلی
                                    <span class="float-left text-sm text-warning"><i class="fa fa-star"></i></span>
                                </h3>
                                <p class="text-sm" style=" color: #899097 !important;">پروژه اتون عالی بود مرسی واقعا</p>
                                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i>4 ساعت قبل</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer"  style=" color: #899097 !important;">مشاهده همه پیام‌ها</a>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link color-black" data-toggle="dropdown" href="#" style="color: #4b4b4b !important;">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                    <span class="dropdown-item dropdown-header">15 نوتیفیکیشن</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"  style=" color: #444444FF !important;">
                        <i class="fa fa-envelope ml-2"></i> 4 پیام جدید
                        <span class="float-left text-muted text-sm">3 دقیقه</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"  style=" color: #444444FF !important;">
                        <i class="fa fa-users ml-2"></i> 8 درخواست دوستی
                        <span class="float-left text-muted text-sm">12 ساعت</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"  style=" color: #444444 !important;">
                        <i class="fa fa-file ml-2"></i> 3 گزارش جدید
                        <span class="float-left text-muted text-sm">2 روز</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer"  style=" color: #899097 !important;">مشاهده همه نوتیفیکیشن</a>
                </div>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i--}}
{{--                        class="fa fa-th-large"></i></a>--}}
{{--            </li>--}}
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="{{ asset('images/admin/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">پنل مدیریت</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <div>
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('images/admin/user1-128x128.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{Auth::user()->name}}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{route('dashboard')}}" class="nav-link">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    داشبورد
                                </p>
                            </a>
                        </li>
                        @if(Auth::user()->can('create_users'))
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-user"></i>
                                <p>
                                    مدیریت کاربران
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('user')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p> لیست کاربران</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('role')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p> دسترسی کاربران</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif




                        <li class="nav-item">
                            <a href="pages/calendar.html" class="nav-link">
                                <i class="nav-icon fa fa-calendar"></i>
                                <p>
                                    تقویم
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li>
                        @if(Auth::user()->can('view_reports'))
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fa fa-bar-chart"></i>
                                <p>
                                    گزارش
                                </p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->getAllPermissions()->contains('name','view_setting'))
                        <li class="nav-header">تنظیمات</li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-envelope-o"></i>
                                <p>
                                    تنظیمات سایت
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('setting.about')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>درباره ما</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('setting.contact')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>تماس با ما</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('setting.rules')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>قوانین</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(Auth::user()->getAllPermissions()->contains('name','view_membership'))
                        <li class="nav-item">
                            <a href="pages/calendar.html" class="nav-link">
                                <i class="nav-icon fa fa-user-times"></i>
                                <p>
                                    عضویت
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    <!-- /.content-wrapper -->


    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-sm-none d-md-block">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>CopyLeft &copy; 2018 <a href="http://github.com/hesammousavi/">حسام موسوی</a>.</strong>
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('js/admin/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('js/admin/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/admin/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('js/admin/demo.js') }}"></script>
<script src="{{ asset('js/admin/persian-date.min.js') }}"></script>
<script src="{{ asset('js/admin/persian-datepicker.min.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- SparkLine -->
<script src="{{ asset('js/admin/jquery.sparkline.min.js') }}"></script>
<!-- jVectorMap -->
<script src="{{ asset('js/admin/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('js/admin/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ asset('js/admin/jquery.slimscroll.min.js') }}"></script>
<!-- ChartJS 1.0.2 -->
<script src="{{ asset('js/admin/Chart.min.js') }}"></script>

<!-- PAGE SCRIPTS -->
<script src="{{ asset('js/admin/dashboard2.js') }}"></script>
<script src="{{ asset('js/admin/ckeditor.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('js/admin/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ asset('js/admin/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/admin/dataTables.bootstrap4.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#birth_date').persianDatepicker({
            format: 'YYYY-MM-DD',
            autoClose: true,
            initialValue: false,
            calendar: {
                persian: {
                    locale: 'fa'
                }
            }
        });
    });
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(function (editor) {
                // The editor instance
            })
            .catch(function (error) {
                console.error(error)
            })

        // bootstrap WYSIHTML5 - text editor

        $('.textarea').wysihtml5({
            toolbar: { fa: true }
        })
    })
    $(function () {
        $("#example1").DataTable({
            "language": {
                "paginate": {
                    "next": "بعدی",
                    "previous" : "قبلی"
                }
            },
            "info" : false,
        });
        $('#example2').DataTable({
            "language": {
                "paginate": {
                    "next": "بعدی",
                    "previous" : "قبلی"
                }
            },
            "info" : false,
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "autoWidth": false
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        CKEDITOR.replace('body_description', {
            language: "fa"
        });
    });
</script>
</body>
</html>
