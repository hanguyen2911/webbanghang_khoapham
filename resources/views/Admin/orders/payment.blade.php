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
              <h1 class="page-header">Payment
              </h1>
            </div>
            <br>

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
                  <th>VNP_code</th>
                  <th>Code bank</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($payment as $item)

                <tr class="odd gradeX" align="center">
                  <td>{{ $item['id'] }}</td>
                  <td>{{ $item['order_id'] }}</td>
                  <td>{{ $item['thanh_vien'] }}</td>
                  <td>{{ $item['money'] }}</td>
                  <td>{{ $item['note'] }}</td>
                  <td>{{ $item['VPN_response_code'] }}</td>
                  <td>{{ $item['code_vnpay'] }}</td>
                  <td>{{ $item['code_bank'] }}</td>




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
