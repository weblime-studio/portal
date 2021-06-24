<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Адмін панель | @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->

  <link rel="stylesheet" href="/admin/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/admin/plugins/summernote/summernote-bs4.min.css">
  <!-- summernote -->

   <link rel="stylesheet" href="/admin/plugins/daterangepicker/daterangepicker.css">


  <link rel="stylesheet" href="/admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="/admin/dist/css/style.css">
</head>
<body class="hold-transition dark-mode2 sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!--<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="/images/logo.png" alt="AdminLTELogo" height="60">
  </div>-->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/myadmin" class="nav-link">Головна</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('user/profile') }}" class="nav-link">Профіль</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
 

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/admin/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/admin/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/admin/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex flex-m">
        <div class="image cover flex">
          @if ( Auth::user()->profile_photo_path )
            <img src="/storage/{{ Auth::user()->profile_photo_path }}" class="img-circle elevation-2" alt="User Image">
          @else
            <img src="/images/user-default.png" alt="">
          @endif
        </div>
        <div class="info">
          <a href="/user/profile" class="d-block ">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
     
          <li class="nav-item {{ strpos($_SERVER['REQUEST_URI'], '/course') > 0 ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link" style="color: #fff;">
                <i class="fas fa-folder-open"></i>
                <p>Курси <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">                
              <li class="nav-item">
                  <a href="{{ route('course.index') }}" class="nav-link">
                  <i class="fas fa-folder"></i>
                  <p>Всі курси</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('course.create') }}" class="nav-link">
                  <i class="fa fa-folder-plus"></i>
                  <p>Створити курс</p>
                  </a>
              </li>                
            </ul>
          </li>
          <li class="nav-item {{ strpos($_SERVER['REQUEST_URI'], '/lesson') > 0 ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link" style="color: #fff;">
              <i class="fas fa-graduation-cap"></i>
                <p>Уроки <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="{{ route('lesson.index') }}" class="nav-link">
                    <i class="fas fa-graduation-cap"></i>
                    <p>Всі уроки</p>
                  </a>
              </li>    
              <li class="nav-item">
                  <a href="{{ route('lesson.create') }}" class="nav-link">
                    <i class="fa fa-plus"></i>
                    <p>Створити урок</p>
                  </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ strpos($_SERVER['REQUEST_URI'], '/user') > 0 ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link" style="color: #fff;">
                <i class="fa fa-users"></i>
                <p>Користувачі <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                    <i class="fa fa-users"></i>
                    <p>Всі користувачі</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.create') }}" class="nav-link">
                    <i class="fa fa-user-secret"></i>
                    <p>Не опубліковані</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.create') }}" class="nav-link">
                    <i class="fa fa-user-plus"></i>
                    <p>Додати користувача</p>
                    </a>
                </li>                
            </ul>
          </li>
          <li class="nav-item {{ strpos($_SERVER['REQUEST_URI'], '/subscribe') > 0 ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link" style="color: #fff;">
                <i class="fas fa-envelope-open-text"></i>
                <p>Підписки <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('subscribe.index') }}" class="nav-link">
                    <i class="fas fa-envelope-open-text"></i>
                    <p>Всі підписки</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('subscribe.index') }}?show=new" class="nav-link">
                    <i class="far fa-envelope"></i>
                      <p>Запити на підписку</p>
                    </a>
                </li> 
                <li class="nav-item">
                    <a href="{{ route('subscribe.create') }}" class="nav-link">
                    <i class="fa fa-plus"></i>
                    <p>Додати підписку</p>
                    </a>
                </li>                
            </ul>
          </li>
          <li class="nav-item {{ strpos($_SERVER['REQUEST_URI'], '/category') > 0 ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link" style="color: #fff;">
                <i class="fas fa-folder-open"></i>
                <p>Категорії <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link">
                    <i class="fas fa-envelope-open-text"></i>
                    <p>Всі категорії</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.create') }}" class="nav-link">
                    <i class="fa fa-plus"></i>
                    <p>Додати категорію</p>
                    </a>
                </li>                
            </ul>
          </li>
          <li class="nav-item {{ strpos($_SERVER['REQUEST_URI'], '/post') > 0 ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link" style="color: #fff;">
                <i class="fas fa-envelope-open-text"></i>
                <p>Статті <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('post.index') }}" class="nav-link">
                    <i class="fas fa-envelope-open-text"></i>
                    <p>Всі статті</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('post.create') }}" class="nav-link">
                    <i class="fa fa-plus"></i>
                    <p>Додати статтю</p>
                    </a>
                </li>                
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/admin/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="/admin/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="/admin/plugins/raphael/raphael.min.js"></script>
<script src="/admin/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="/admin/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="/admin/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="/admin/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/admin/dist/js/pages/dashboard2.js"></script>
<script src="/admin/plugins/select2/js/select2.full.min.js"></script>
<script src="/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<script src="/admin/plugins/moment/moment.min.js"></script>
<script src="/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Summernote -->
<script src="/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="/admin/scripts.js"></script>
<!-- Summernote -->



<script>
    jQuery(document).ready(function () {
        $('.select2').select2();

        $('#course-start').daterangepicker({
          singleDatePicker: true,
          format: 'L'
        });

        $('.summernote.short').summernote({
          minHeight: 140
        });
        $('.summernote.full').summernote({
          minHeight: 440
        });
        $("input[data-bootstrap-switch]").each(function(){
          $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
    })
</script>
@yield('pagescripts')
</body>
</html>