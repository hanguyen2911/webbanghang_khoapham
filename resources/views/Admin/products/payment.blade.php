<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="">
    <title>Admin </title>
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

    <div id="wrapper">

      <!-- Navigation -->

      @include('Admin.master')
      <!-- Page Content -->
      <div id="page-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">Order
                <small>
                  {{ $status }}
                </small>
              </h1>
            </div>
            <br>
            @if (isset($status_mail))
            <div class="alert alert-{{ $status_mail }}" role="alert">
              {{ $mes_content }}
            </div>
            @endif
            <br>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr align="center">
                  <th>ID</th>
                  <th>Order_ID</th>
                  <th>Member</th>
                  <th>Money</th>
                  <th>Note</th>
                  <th>VPN_response_code</th>
                  <th>VNP CODE</th>
                  <th>CODE bank</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($vnpay_Data as $item)

                <tr class="odd gradeX" align="center">
                  <td>{{ $item['id'] }}</td>
                  @foreach ($listCustomer as $cus)
                  @if ($cus['id'] == $item['id_customer'])
                  <td>{{ $cus['name'] }}</td>
                  @endif
                  @endforeach
                  {{-- <td>{{ $item['id_customer'] }}</td> --}}
                  <td>{{ $item['date_order'] }}</td>
                  <td>{{ $item['total'] }}</td>
                  <td>{{ $item['payment'] }}</td>
                  <td>{{ $item['note'] }}</td>
                  <td class="text-primary"> <strong>{{ $item['status'] }}</strong></td>

                  {{-- @if ($status_code == 1)
                                
                                @else
                                    
                                @endif --}}

                  @switch($status_code)
                  @case(1)
                  <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                      href="{{ route('order.setConfirmed', $item['id']) }}">Confirm</a>
                  </td>
                  @break
                  @case(2)
                  <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                      href="{{ route('order.setDelivering', $item['id']) }}">Confirm</a>
                  </td>
                  @break
                  @case(3)
                  <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                      href="{{ route('order.setDelivered', $item['id']) }}">Confirm</a>
                  </td>
                  @break
                  {{-- @case(4)
                                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                                    href="{{ route('order.confirmed', $item['id']) }}">Confirm</a>
                  </td>
                  @break --}}

                  @endswitch
                  @if ($status_code == 5)
                  <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                      href="{{ route('order.return', $item['id']) }}">return</a>
                  </td>
                  <td class="center text-danger"> <strong><i class="fa fa-trash-o  fa-fw"></i> <a class="text-danger"
                        href="{{ route('order.return', $item['id']) }}">delete</a></strong>
                  </td>

                  @elseif(($status_code == 0))
                  <td class="text-warning">Hiện đang trong danh sách xem!</td>
                  @else
                  <td class="center text-danger"><i class="fa fa-trash-o  fa-fw"></i>
                    <a href="{{ route('order.setCancelled', $item['id']) }}"> Cancel</a>
                  </td>
                  @endif


                </tr>

                @endforeach

              </tbody>
            </table>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="admin-layout/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin-layout/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="admin-layout/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="admin-layout/dist/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="admin-layout/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="admin-layout/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js">
    </script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
      $('#dataTables-example').DataTable({
        responsive: true
      });
    });
    </script>
  </body>

</html>
