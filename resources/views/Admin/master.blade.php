<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="">
    <title>Admin - Phạm Anh Tuấn</title>
    <base href="{{ asset('') }}">
    <!-- Bootstrap Core CSS -->
    <link href="admin-layout/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="admin-layout/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="admin-layout/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="admin-layout/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="admin-layout/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css"
      rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="admin-layout/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
  </head>

  <body>
    @yield('master')
    <div id="wrapper">
      <!-- Navigation -->
      <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">Admin Management </a>
        </div>
        <!-- /.navbar-header -->



        <ul class="nav navbar-top-links navbar-right">
          <!-- /.dropdown -->

          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
              <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
              </li>
              <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
              </li>
              <li class="divider"></li>
              <li><a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
              </li>
            </ul>
            <!-- /.dropdown-user -->
          </li>
          <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
              <li class="sidebar-search">
                <div class="input-group custom-search-form">
                  <input type="text" class="form-control" placeholder="Search...">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
                <!-- /input-group -->
              </li>
              <!-- <li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li> -->
              <!-- <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Category<span
                                    class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">List Category</a>
                                </li>
                                <li>
                                    <a href="#">Add Category</a>
                                </li>
                            </ul>
                           
                        </li> -->
              <!-- <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i> Product<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">List Product</a>
                                </li>
                                <li>
                                    <a href="#">Add Product</a>
                                </li>
                            </ul> -->
              <!-- </li> -->
              <!-- <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">List User</a>
                                </li>
                                <li>
                                    <a href="#">Add User</a>
                                </li>
                            </ul>
                        </li>-->
              <li>
                <a href=""><i class="fa fa-cube fa-fw"></i> Payment<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="{{ route('order.payment') }}">Payment</a>
                  </li>
                </ul><a href="{{ route('order.list') }}"><i class="fa fa-cube fa-fw"></i> Đơn Hàng<span
                    class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="{{ route('order.list') }}">Lịch sử đơn hàng</a>
                  </li>

                  <li>
                    <a href="{{ route('order.waiting') }}">Chờ Xác Nhận</a>
                  </li>
                  <li>
                    <a href="{{ route('order.confirmed') }}">Đã Xác Nhận</a>
                  </li>
                  <li>
                    <a href="{{ route('order.cancelled') }}">Đơn hàng bị hủy</a>
                  </li>
                  <li>
                    <a href="{{ route('order.delivering') }}">Đang giao</a>
                  </li>
                  <li>
                    <a href="{{ route('order.delivered') }}">Đã giao</a>
                  </li>

                </ul>
                <!-- /.nav-second-level -->
              </li>
              <li>
                @if (session('flag'))
                <div class="alert alert-{{ Session::get('flag') }}" role="alert">
                  {{ Session::get('notice') }}
                </div>
                @endif
                @if (isset($status_mail))
                <div class="alert alert-{{ $status_mail }}" role="alert">
                  {{ $mes_content }}
                </div>
                @endif
              </li>
            </ul>
          </div>
          <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
      </nav>

      <!-- Page Content -->

      <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


  </body>

</html>
