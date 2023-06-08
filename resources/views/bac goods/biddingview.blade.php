<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Procurement System </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->

      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown ">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-bell"></i>
            <?php
            if ($notifications->count() == 0) {
              echo '<span class=""></span>';
            } else {
              echo '<span class="badge badge-primary">' . $notifications->count() . '</span>';
            }
            ?>
          </a>
          @if ($notifications->isEmpty())
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right ">
            <span href="" class="dropdown-item"> No notifications found.</span>
          </div>
          @else
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right border border-light">
            <a href="markRead" class="dropdown-item text-right border border-light" style="color: blue; text-decoration: underline">Mark as read</a>
            <div class="dropdown-divider"></div>
            @foreach($notifications as $notification)
            <div class="border border-light d-flex">
              <i class="fa fa-exclamation-circle fa-m p-2 mt-3"> </i>
              <p href="" class="dropdown-item">{{ $notification->data['message'] }}</p>
            </div>
            @endforeach
          </div>
          @endif
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-power-off"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header"></span>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout')}}" class="dropdown-item">
              <button class="btn btn-danger btn-sm btn-lg" style="width:100%" href="{{ route('logout')}}"><i class="fa fa-power-off"></i>Logout</button>
            </a>

            <div class="dropdown-divider"></div>
          </div>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="bacgoods" class="brand-link mt-2 mb-1">
        <span class="brand-text font-weight-light">
          <img src="{{ asset('/bower_components/admin-lte/dist/img/PROMS LOGO 2.png') }}" alt="PROMS-logo" style="width:225px;height:40px;">
        </span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('/bower_components/admin-lte/dist/img/rtu-logo.png') }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">BAC Home Page</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
              <a href="bacgoods" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="bacgsppmpcsa" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>Procurement Plan</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href=" " class="nav-link active">
                <i class="nav-icon fas fa-palette"></i>
                <p>Goods & Services
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="svp" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Small Value Procurement</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="shopping" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Shopping</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="canvas" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Canvas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="bidding" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bidding</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview ">
              <a href="{{ route('logout')}}" class="nav-link">
                <i class="nav-icon fa fa-power-off"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Indorsement from BAC</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Indorsement</li>

              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <style>
        @media print {
          .card-header {
            display: none;
          }
        }
      </style>

      <section class="content">
        <div class="card card-outline card-info">
          <div class="card-header">
            <h3 class="card-title">Indorsement / View Indorsement</h3>
            <div class="card-tools">
              <button onclick="window.print()" class="btn btn-primary btn-sm btn-flat btn-success" id="print" type="button"><i class="fa fa-print"></i> Print</button>
              <!-- <a class="btn btn-sm btn-flat btn-primary" href="">Edit</a> -->
              <a class="btn btn-sm btn-flat btn-default" href="bidding">Back</a>
            </div>
          </div>

          <div class="card-body table-responsive" id="out_print">
            <div class="row">
              <div class="col-8 d-flex align-items-center">
                <div>
                  <p class="m-0">RTU-ADM-SPO-F-012</p>
                </div>
              </div>
              <div class="col-4 d-flex align-items-center">
                <div>

                  <p class="m-0">Control No: {{ $requestview -> control_no }}</p>
                </div>
              </div>
            </div>

            <div class="col-12" style="margin-top: 5%; margin-bottom: 5%">
              <h2 class="text-center"><b>INDORSEMENT FROM BAC</b></h2>
            </div>

            <div class="row">
              <div class="col-8 d-flex align-items-center">
                <div>
                  <p class="m-0">Department: {{ $requestview -> department }}</p>
                </div>
              </div>
              <div class="col-4 d-flex align-items-center">
                <div>
                  <p class="m-0">Date : {{ $requestview -> created_at }}</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8 d-flex align-items-center">
                <div>
                  <p class="m-0">Instruction:</p>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <table class="table table-striped table-bordered " id="item-list">
                  <colgroup>
                    <col width="5%">
                    <col width="10%">
                    <col width="20%">
                    <col width="35%">
                    <col width="20%">
                    <col width="10%">
                  </colgroup>
                  <thead>
                    <tr class="table-primary">
                      <th class="px-1 py-1 text-center"></th>
                      <th class="px-1 py-1 text-center">Quantity</th>
                      <th class="px-1 py-1 text-center">Unit</th>
                      <th class="px-1 py-1 text-center">Description of Articles</th>
                      <th class="px-1 py-1 text-center">Price</th>
                      <th class="px-1 py-1 text-center">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($order_data as $index => $values)
                    <tr class="po-item" data-id="">
                      <td class="align-middle p-0 text-center"></td>
                      <td class="align-middle p-1">{{ $values -> updated_quantity }}</td>
                      <td class="align-middle p-1">{{ $values -> unit }}</td>
                      <td class="align-middle p-1">{{ $item_data[$index][0] -> ItemDet }}</td>
                      <td class="align-middle p-1">{{ $values -> unit_price }}</td>
                      <td class="align-middle p-1 text-right">{{ number_format($values -> updated_quantity * $values -> unit_price, 2) }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-lightblue">
                    <tr>
                      <th class="p-1 text-right" colspan="5">Total</th>
                      <th class="p-1 text-right" id="total">{{ number_format($requestview -> approved_total_price,2 ) }}</th>
                    </tr>
                    </tr>
                  </tfoot>
                </table>
                <div class="row">
                  <div class="col-6">
                    <label for="notes" class="control-label">Notes: {{ $requestview -> notes }}</label>
                    <p></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <label for="notes" class="control-label">Purpose/s: {{ $requestview -> purpose }}</label>
                    <p></p>
                  </div>
                  <div class="col-6">
                    <label for="status" class="control-label">Budget Source: {{ $requestview -> budget_source }}</label>
                    <p></p>
                    <br>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <label for="notes" class="control-label">Requested By: @foreach($requestor_data as $requestor_data) {{ $requestor_data -> Firstname }} {{ $requestor_data -> Lastname }} @endforeach</label>
                    <p></p>
                  </div>
                  <div class="col-6">
                    <label for="status" class="control-label">Actoin Taken: {{ $requestview -> action_taken }}</label>
                    <p></p>
                    <br>
                  </div>
                </div>
                <div class="row">
                    <div class="col-12" align="right" class="text-center">
                        <label for="notes" class="control-label border border-dark w-25"></label><br>
                        <label for="status" class="control-label border border-white w-25 text-center">Department Office</label>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>


  </div>

  </section>


  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('/bower_components/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('/bower_components/admin-lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('/bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('/bower_components/admin-lte/plugins/chart.js/Chart.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('/bower_components/admin-lte/plugins/sparklines/sparkline.js') }}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('/bower_components/admin-lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('/bower_components/admin-lte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('/bower_components/admin-lte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('/bower_components/admin-lte/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('/bower_components/admin-lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('/bower_components/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <!-- Summernote -->
  <script src="{{ asset('/bower_components/admin-lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('/bower_components/admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('/bower_components/admin-lte/dist/js/adminlte.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('/bower_components/admin-lte/dist/js/pages/dashboard.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('/bower_components/admin-lte/dist/js/demo.js') }}"></script>
  <script src="{{ asset('/bower_components/admin-lte/plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('/bower_components/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

  <script>
    $(function() {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
    });
  </script>
</body>

</html>
