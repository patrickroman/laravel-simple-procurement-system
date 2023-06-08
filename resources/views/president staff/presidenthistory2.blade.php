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
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!--  Autocomplete CSS -->
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/jquery-ui/jquery-ui.css') }}">
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
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
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
            <a href="{{ route('logout')}}" class="dropdown-item">
              <button class="btn btn-danger btn-sm btn-lg" style="width:100%" href="{{ route('logout')}}"><i class="fa fa-power-off"></i> Logout</button>
            </a>
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
            <a href="#" class="d-block">Office of the President Home Page</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="presidentdashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="presidentproplan" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>Procurement Plan</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href=" " class="nav-link active">
                <i class="nav-icon fas fa-users"></i>
                <p>Request Item<i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="presidentrequest" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Active Request</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="presidentrequest2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Closed Request</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="presidenttrash" class="nav-link">
                <i class="nav-icon fa fa-trash"></i>
                <p>Trash</p>
              </a>
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
              <h1 class="m-0 text-dark">Purchase Request</h1>

            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Details</li>

              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Details</h3>
                </div>
                <div class="card-body table-responsive">
                  <div class="row mb-4">
                    <p class="col-6"><b>Control No: {{ $requesthistory[0] -> control_no }}</b></p>
                    <p class="col-6"><b>Date Created: {{ $requesthistory[0] -> created_at }}</b></p>
                  </div>

                  <p><b>Requested Item/s:</b></p>
                  <table class="table table-bordered " id="item-list">
                    <colgroup>
                      <col width="10%">
                      <col width="20%">
                      <col width="35%">
                      <col width="20%">
                      <col width="10%">
                    </colgroup>
                    <thead>
                      <tr class="bg-secondary">
                        <th class="px-1 py-1 text-center">Quantity</th>
                        <th class="px-1 py-1 text-center">Unit</th>
                        <th class="px-1 py-1 text-center">Description of Articles</th>
                        <th class="px-1 py-1 text-center">Price</th>
                        <th class="px-1 py-1 text-center">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($order_data as $index => $values)
                      <tr class="po-item text-center" data-id="">
                        <td class="align-middle p-1">{{ $values -> quantity }}</td>
                        <td class="align-middle p-1">{{ $values -> unit }}</td>
                        <td class="align-middle p-1">{{ $item_data[$index][0] -> ItemDet }}</td>
                        <td class="align-middle p-1">{{ $values -> unit_price }}</td>
                        <td class="align-middle p-1">{{ number_format($values -> quantity * $values -> unit_price, 2) }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr class="">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                    </tfoot>
                  </table><br>

                  <div class="row mb-4">
                    <p class="col-6"><b>Total No. of Requested Item/s: {{ $requesthistory[0] -> item_count }}</b></p>
                    <p class="col-6"><b>Total Amount: {{ number_format($requesthistory[0] -> total_price, 2) }}</b></p>
                  </div>

                  <p><b>Approved Item/s:</b></p>
                  <table class="table table-bordered table-responsive" id="item-list">
                    <colgroup>
                      <col width="10%">
                      <col width="20%">
                      <col width="35%">
                      <col width="20%">
                      <col width="10%">
                    </colgroup>
                    <thead>
                      <tr class="bg-secondary">
                        <th class="px-1 py-1 text-center">Quantity</th>
                        <th class="px-1 py-1 text-center">Unit</th>
                        <th class="px-1 py-1 text-center">Description of Articles</th>
                        <th class="px-1 py-1 text-center">Price</th>
                        <th class="px-1 py-1 text-center">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($approve_order as $index => $values)
                      <tr class="po-item text-center" data-id="">
                        <td class="align-middle p-1">{{ $values -> quantity }}</td>
                        <td class="align-middle p-1">{{ $values -> unit }}</td>
                        <td class="align-middle p-1">{{ $approve_item[$index][0] -> ItemDet }}</td>
                        <td class="align-middle p-1">{{ $values -> unit_price }}</td>
                        <td class="align-middle p-1">{{ number_format($values -> quantity * $values -> unit_price, 2) }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr class="">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                    </tfoot>
                  </table><br>

                  <div class="row mb-4">
                    <p class="col-6"><b>Total No. of Approved Item/s: {{ $requesthistory[0] -> approved_item_count }}</b></p>
                    <p class="col-6"><b>Total Amount: {{ number_format($requesthistory[0] -> approved_total_price, 2) }}</b></p>
                  </div>

                  <div class="row mb-4">
                    <p class="col-6"><b>Last Updated By: @foreach($user_data as $user_data) {{ $user_data -> Firstname}} @endforeach</b></p>
                    <p class="col-4"><b>Date Updated: {{ $requesthistory[0] -> updated_at }}</b></p>
                  </div>

                  <div class="row mb-4">
                    <p class="col-6"><b>Requested By: @foreach($requestor_data as $requestor_data) {{ $requestor_data -> Firstname }} {{ $requestor_data -> Lastname }} @endforeach</b></p>
                    <p class="col-6"><b>Delivered To: {{ $requesthistory[0] -> delivered_to }}</b></p>
                  </div>

                  <div class="row mb-4">
                    <p class="col-6"><b>Status:</b>
                      <?php
                      switch ($requesthistory[0]->request_status) {
                        case '1':
                          echo '<span class="badge badge-warning">PENDING</span>';
                          break;
                        case '2':
                          echo '<span class="badge badge-warning">PROCESSING</span>';
                          break;
                        case '3':
                          echo '<span class="badge badge-success">APPROVED</span>';
                          break;
                        case '4':
                          echo '<span class="badge badge-primary">CLOSED</span>';
                          break;
                        case '5':
                          echo '<span class="badge badge-danger">DENIED</span>';
                          break;
                        default:
                          echo '<span class="badge badge-secondary">DRAFT</span>';
                          break;
                      }
                      ?>
                    </p>
                    <p class="col-6"><b>Remarks: {{ $requesthistory[0] -> remarks }}</b></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <a href="presidentrequest" class="btn btn-danger" role="button"><span aria-hidden="true">Close</span></a>
            </div>
          </div>
        </div>
      </section>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright © 2022 - 2023<a href="http://adminlte.io"></a></strong>


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
  <script type="text/javascript" src="{{ asset('/bower_components/admin-lte/plugins/jquery/jquery.autocomplete.js') }}"></script>
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
  <!-- Select2 -->
  <script src="{{ asset('/bower_components/admin-lte/node_modules/select2/dist/js/select2.full.min.js') }}"></script>

  <script>

  </script>
</body>

</html>