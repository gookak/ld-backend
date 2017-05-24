<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  {{-- <meta charset="utf-8" /> --}}
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>{{ config('app.name') }}</title>

  <!-- bootstrap & fontawesome -->
  <link rel="stylesheet" href="{{ asset('themes/ace-master/assets/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('themes/ace-master/assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

  <!-- bootstrapValidator -->
  <link rel="stylesheet" href="{{ asset('themes/ace-master/assets/css/bootstrapValidator/bootstrapValidator.min.css') }}" />

  <!-- page specific plugin styles -->
  <link rel="stylesheet" href="{{ asset('themes/ace-master/assets/css/colorbox.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('themes/ace-master/assets/css/bootstrap-datetimepicker.min.css') }}" />

  <!-- text fonts -->
  <link rel="stylesheet" href="{{ asset('themes/ace-master/assets/css/fonts.googleapis.com.css') }}" />

  <!-- ace styles -->
  <link rel="stylesheet" href="{{ asset('themes/ace-master/assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

  <link rel="stylesheet" href="{{ asset('themes/ace-master/assets/css/ace-skins.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('themes/ace-master/assets/css/ace-rtl.min.css') }}" />

  <!-- my styles -->
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />

  <!-- ace settings handler -->
  <script src="{{ asset('themes/ace-master/assets/js/ace-extra.min.js') }}"></script>

  @yield('tag-header')

</head>

<body class="no-skin">
  <div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
      <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
        <span class="sr-only">Toggle sidebar</span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>
      </button>

      <div class="navbar-header pull-left">
        <a href="/" class="navbar-brand">
          <small>
            <i class="fa fa-leaf"></i>
            {{ config('app.name') }}
          </small>
        </a>
      </div>

      <div class="navbar-buttons navbar-header pull-right" role="navigation">
        <ul class="nav ace-nav">

          <li class="light-blue dropdown-modal">

            <!-- Authentication Links -->
            @if (Auth::guest())
            <li><a href="{{ route('login') }}">Login</a></li>
            {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}
            @else
            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
              {{-- <img class="nav-user-photo" src="{{ asset('themes/ace-master/assets/images/avatars/user.jpg') }}" alt="Jason's Photo" /> --}}
              <span class="user-info">
                {{-- <small>Welcome,</small> --}}
                ชื่อ : {{ Auth::user()->name }} <br/>
                สิทธิ์ : {{ Auth::user()->role->name }}
              </span>

              <i class="ace-icon fa fa-caret-down"></i>
            </a>
            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
              {{-- <li>
                <a href="#">
                  <i class="ace-icon fa fa-cog"></i>
                  Settings
                </a>
              </li>

              <li>
                <a href="profile.html">
                  <i class="ace-icon fa fa-user"></i>
                  Profile
                </a>
              </li>

              <li class="divider"></li> --}}

              <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="ace-icon fa fa-power-off"></i>
                  Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
            </ul>
            @endif
          </li>
        </ul>
      </div>

    </div><!-- /.navbar-container -->
  </div>

  <div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
      try{ace.settings.loadState('main-container')}catch(e){}
    </script>

    <div id="sidebar" class="sidebar responsive ace-save-state">
      <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
      </script>

      {{-- @include('layouts.sidebar-shortcuts') --}}

      <ul class="nav nav-list">
        <li class="">
          <a href="/dashboard">
            <i class="menu-icon fa fa-tachometer"></i>
            <span class="menu-text"> หน้าแรก </span>
          </a>

          <b class="arrow"></b>
        </li>
        <li class="">
          <a href="/adminuser">
            <i class="menu-icon fa fa-user"></i>
            <span class="menu-text"> ข้อมูลผู้ใช้งาน </span>
          </a>

          <b class="arrow"></b>
        </li>
        <li class="">
          <a href="/category">
            <i class="menu-icon fa fa-list"></i>
            <span class="menu-text"> ประเภทสินค้า </span>
          </a>

          <b class="arrow"></b>
        </li>
        <li class="">
          <a href="/fileupload">
            <i class="menu-icon fa fa-picture-o"></i>
            <span class="menu-text"> อัพโหลดรูปสินค้า </span>
          </a>

          <b class="arrow"></b>
        </li>
        <li class="">
          <a href="/product">
            <i class="menu-icon fa fa-desktop"></i>
            <span class="menu-text"> ข้อมูลสินค้า </span>
          </a>

          <b class="arrow"></b>
        </li>
        <li class="">
          <a href="/order">
            <i class="menu-icon fa fa-book"></i>
            <span class="menu-text"> ข้อมูลรายการสั่งซื้อ </span>
          </a>

          <b class="arrow"></b>
        </li>
        <li class="">
          <a href="/user">
            <i class="menu-icon fa fa-users"></i>
            <span class="menu-text"> ข้อมูลลูกค้า </span>
          </a>

          <b class="arrow"></b>
        </li>
       {{--  <li class="">
          <a href="/report">
            <i class="menu-icon fa fa-tachometer"></i>
            <span class="menu-text"> รายงาน </span>
          </a>

          <b class="arrow"></b>
        </li> --}}

        {{-- <li class="">
          <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-list"></i>
            <span class="menu-text"> Admin </span>

            <b class="arrow fa fa-angle-down"></b>
          </a>

          <b class="arrow"></b>

          <ul class="submenu">
            <li class="">
              <a href="/adminuser">
                <i class="menu-icon fa fa-caret-right"></i>
                ข้อมูลผู้ใช้งาน
              </a>

              <b class="arrow"></b>
            </li>

            <li class="">
              <a href="jqgrid.html">
                <i class="menu-icon fa fa-caret-right"></i>
                logfile
              </a>

              <b class="arrow"></b>
            </li>
          </ul>
        </li> --}}

      </ul><!-- /.nav-list -->

      <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
      </div>
    </div>

    <div class="main-content">
      <div class="main-content-inner">

        {{-- @include('layouts.breadcrumbs') --}}

        <div class="page-content">
          <div class="row">
            <div class="col-xs-12">
              <!-- PAGE CONTENT BEGINS -->

              @yield('content')

              <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.page-content -->
      </div>
    </div><!-- /.main-content -->

    <div class="footer">
      <div class="footer-inner">
        <div class="footer-content">
          <span class="bigger-120">
            <span class="blue bolder">L&D Commerce</span>
            Application &copy; 2017
          </span>

          {{-- &nbsp; &nbsp;
          <span class="action-buttons">
            <a href="#">
              <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
            </a>

            <a href="#">
              <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
            </a>

            <a href="#">
              <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
            </a>
          </span> --}}
        </div>
      </div>
    </div>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
      <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
  </div><!-- /.main-container -->

  <!-- basic scripts -->

  <!--[if !IE]> -->
  <script src="{{ asset('themes/ace-master/assets/js/jquery-2.1.4.min.js') }}"></script>

  <!-- <![endif]-->

    <!--[if IE]>
<script src="{{ asset('themes/ace-master/assets/js/jquery-1.11.3.min.js') }}"></script>
<![endif]-->
<script type="text/javascript">
  if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset("themes/ace-master/assets/js/jquery.mobile.custom.min.js") }}'>"+"<"+"/script>");
</script>
<script src="{{ asset('themes/ace-master/assets/js/bootstrap.min.js') }}"></script>

<!-- page specific plugin scripts -->
<script src="{{ asset('themes/ace-master/assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('themes/ace-master/assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('themes/ace-master/assets/js/jquery.colorbox.min.js') }}"></script>
<script src="{{ asset('themes/ace-master/assets/js/moment.min.js') }}"></script>
<script src="{{ asset('themes/ace-master/assets/js/moment/locale/th.js') }}"></script>
<script src="{{ asset('themes/ace-master/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

{{-- highcharts--}}
<script src="{{ asset('bower_components/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('bower_components/highcharts/highcharts-3d.js') }}"></script>
<script src="{{ asset('bower_components/highcharts/modules/exporting.js') }}"></script>


{{-- <script src="{{ asset('themes/ace-master/assets/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('themes/ace-master/assets/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('themes/ace-master/assets/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('themes/ace-master/assets/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('themes/ace-master/assets/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('themes/ace-master/assets/js/dataTables.select.min.js') }}"></script> --}}

<!-- bootstrapValidator -->
<script src="{{ asset('themes/ace-master/assets/js/bootstrapValidator/bootstrapValidator.min.js') }}"></script>
<script src="{{ asset('themes/ace-master/assets/js/bootstrapValidator/language/th_TH.js') }}"></script>

<!-- ace scripts -->
<script src="{{ asset('themes/ace-master/assets/js/ace-elements.min.js') }}"></script>
<script src="{{ asset('themes/ace-master/assets/js/ace.min.js') }}"></script>

<!-- jquery-sortable -->
<script src="{{ asset('themes/ace-master/assets/js/jquery-sortable.js') }}"></script>

<!-- my scripts -->
<script src="{{ asset('js/custom.js') }}"></script>

<!-- inline scripts related to this page -->
@yield('tag-footer')


</body>
</html>
