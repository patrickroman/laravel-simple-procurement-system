<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Procurement System | </title>
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
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-power-off"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header"></span>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout')}}" class=" dropdown-item">
              <button class="btn btn-danger btn-sm btn-lg" style="width:100%" href="{{ route('logout')}}"><i class=" fa fa-power-off"></i> Logout</button>
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
      <a href="" class="brand-link mt-2 mb-1">
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
            <a href="#" class="d-block">Admin Home Page</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item ">
              <a href="admin" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item has-treeview menu-open">
              <a href="ppmpcsa" class="nav-link active"><i class="nav-icon fas fa-table"></i>
                <p>Procurement Plan</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="approvedppmpcsa" class="nav-link">
                <i class="nav-icon fas fa-check-circle"></i>
                <p>Approved Pro Plan</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="usermanagement" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>User Management</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href=" " class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>Request List<i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="adminreqlist" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Active Request</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="adminreqlist2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Closed Request</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="audittrail" class="nav-link">
                <i class="nav-icon fas fa-history"></i>
                <p>Audit Trail</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
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
              <h1 class="m-0 text-dark">Procurement Plan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Procurement Plan</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <form role="form" action="addfinanceitem" method="post">
        @csrf

        <div class="card ml-4" style="width: 96%;">
          <div class="card-body">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Row for Procurement Plan</h3>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-bordered " id="item-list">
                  <colgroup>
                    <col width="5%">
                    <col width="20%">
                    <col width="10%">
                    <col width="7%">
                    <col width="7%">
                    <col width="7%">
                    <col width="7%">
                    <col width="10%">
                  </colgroup>
                  <thead>
                    <tr class="bg-dark">
                      <th class="px-1 py-1 text-center"></th>
                      <th class="px-1 py-1 text-center">Item Name</th>
                      <th class="px-1 py-1 text-center">Unit</th>
                      <th class="px-1 py-1 text-center">Q1</th>
                      <th class="px-1 py-1 text-center">Q2</th>
                      <th class="px-1 py-1 text-center">Q3</th>
                      <th class="px-1 py-1 text-center">Q4</th>
                      <th class="px-1 py-1 text-center">Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="po-item" data-id="">
                      <td class="align-middle p-1 text-center">
                        <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
                      </td>
                      <td class="align-middle p-0 text-center">
                        <input type="hidden" name="user_name" value="{{ Session::get('user') }}">
                        <input type="text" class="text-center w-100 border-0" name="item_name[]">
                      </td>
                      <td class="align-middle p-1">
                        <input type="text" class="text-center w-100 border-0" name="unit[]">
                      </td>
                      <td class="align-middle p-1">
                        <input type="number" class="text-right w-100 border-0" name="q1[]">
                      </td>
                      <td class="align-middle p-1">
                        <input type="number" class="text-right w-100 border-0" name="q2[]">
                      </td>
                      <td class="align-middle p-1">
                        <input type="number" class="text-right w-100 border-0" name="q3[]">
                      </td>
                      <td class="align-middle p-1">
                        <input type="number" class="text-right w-100 border-0" name="q4[]">
                      </td>
                      <td class="align-middle p-1">
                        <input type="number" step="any" class="text-right w-100 border-0" name="price[]">
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr class="bg-lightblue">
                    <tr>
                      <th class="p-1 text-right" colspan="9"><span><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button></span></th>
                    </tr>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class="card-footer bg-white d-flex">
                <a href="ppmpfinance" class="btn btn-danger" role="button"><span aria-hidden="true" class="text-white">Close</span></a>
                <button type="submit" class="btn btn-primary ml-auto" name="save">Save</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <table class="d-none" id="item-clone">
      <tr class="po-item" data-id="">
        <td class="align-middle p-1 text-center">
          <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
        </td>
        <td class="align-middle p-0 text-center">
          <input type="text" class="text-center w-100 border-0" name="item_name[]">
        </td>
        <td class="align-middle p-1">
          <input type="text" class="text-center w-100 border-0" name="unit[]">
        </td>
        <td class="align-middle p-1">
          <input type="number" class="text-right w-100 border-0" name="q1[]">
        </td>
        <td class="align-middle p-1">
          <input type="number" class="text-right w-100 border-0" name="q2[]">
        </td>
        <td class="align-middle p-1">
          <input type="number" class="text-right w-100 border-0" name="q3[]">
        </td>
        <td class="align-middle p-1">
          <input type="number" class="text-right w-100 border-0" name="q4[]">
        </td>
        <td class="align-middle p-1">
          <input type="number" step="any" class="text-right w-100 border-0" name="price[]">
        </td>
      </tr>
    </table>

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright © 2022 - 2023<a href="http://adminlte.io"></a></strong>

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

    function rem_item(_this) {
      _this.closest('tr').remove()
    }

    $(document).ready(function() {
      $('#add_row').click(function() {
        var tr = $('#item-clone tr').clone()
        $('#item-list tbody').append(tr)
      });
    });
  </script>
</body>

</html>
