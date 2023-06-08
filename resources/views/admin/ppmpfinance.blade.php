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
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte//plugins/jqvmap/jqvmap.min.css') }}">
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
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <script src=" https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

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
            <a href="{{ route('logout')}}" class="dropdown-item">
              <button class="btn btn-danger btn-sm btn-lg" style="width:100%" href="{{ route('logout')}}"><i class="fa fa-power-off"></i> Logout</button>
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

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-header">
                  <div class="d-flex">
                    <h3 class="card-title p-2">Finance Office Project Procurement Management Plan</h3>
                    <div class="form-group ml-auto mt-1 p-1" id="parent">
                      <select class="js-example-basic-single" id="select2" style="width: 100%" onchange="ppmp(this.value)">
                        <option value="ppmpceat">CEAT</option>
                        <option value="ppmpcbet">CBET</option>
                        <option value="ppmpced">CED</option>
                        <option value="ppmpcas">CAS</option>
                        <option value="ppmpipe">IPE</option>
                        <option value="ppmpcsa">CSA</option>
                        <option value="ppmpmic">MIC</option>
                        <option value="ppmpdrrmo">DRRMO</option>
                        <option value="ppmpgcsc">GCSC</option>
                        <option value="ppmpovp">OVP</option>
                        <option value="ppmpsgo">SGO</option>
                        <option value="ppmpsrac">SRAC</option>
                        <option value="ppmphrdc">HRDC</option>
                        <option value="ppmpsupply">Supply Office</option>
                        <option value="ppmpfinance" selected="selected">Finance Office</option>
                        <option value="ppmppresident">Office of the President</option>
                        <option value="ppmpbac">BAC Office</option>
                      </select>
                    </div>
                    <div class="ml-3 p-2"><a href="financeadd"><button class="btn btn-success btn-sm"><i class="fa fa-plus"> Add Item</i></button></a></div>
                  </div>

                  <!-- /.card-header -->
                  <!-- End Add Container-->

                  <div class="table-responsive">
                    <table id="dtHorizontalVerticalExample" class="table table-striped table-bordered table-m " width="100%">
                      <thead>
                        <tr align="center">
                          <th>#</th>
                          <th>Item Code</th>
                          <th>Item Name</th>
                          <th>Unit of Measure</th>
                          <th>Jan</th>
                          <th>Feb</th>
                          <th>Mar</th>
                          <th>Q1</th>
                          <th>Q1 Amount</th>
                          <th>Apr</th>
                          <th>May</th>
                          <th>June</th>
                          <th>Q2</th>
                          <th>Q2 Amount</th>
                          <th>July</th>
                          <th>Aug</th>
                          <th>Sept</th>
                          <th>Q3</th>
                          <th>Q3 Amount</th>
                          <th>Oct</th>
                          <th>Nov</th>
                          <th>Dec</th>
                          <th>Q4</th>
                          <th>Q4 Amount</th>
                          <th>Total Quantity</th>
                          <th>Price Catalogue</th>
                          <th>Total Amount</th>
                          <th></th>
                        </tr>
                      </thead>

                      <tbody>
                        @foreach($proplandata as $proplandata)
                        <tr>
                          <td></td>
                          <td>{{ $proplandata -> ItemCode }}</td>
                          <td>{{ $proplandata -> ItemDet }}</td>
                          <td>{{ $proplandata -> UnitMeas }}</td>
                          <td>{{ $proplandata -> Jan }}</td>
                          <td>{{ $proplandata -> Feb }}</td>
                          <td>{{ $proplandata -> Mar }}</td>
                          <td>{{ $proplandata -> Q1 }}</td>
                          <td>{{ number_format($proplandata -> Q1Amount, 2) }}</td>
                          <td>{{ $proplandata -> Apr }}</td>
                          <td>{{ $proplandata -> May }}</td>
                          <td>{{ $proplandata -> June }}</td>
                          <td>{{ $proplandata -> Q2 }}</td>
                          <td>{{ number_format($proplandata -> Q2Amount, 2) }}</td>
                          <td>{{ $proplandata -> July }}</td>
                          <td>{{ $proplandata -> Aug }}</td>
                          <td>{{ $proplandata -> Sept }}</td>
                          <td>{{ $proplandata -> Q3 }}</td>
                          <td>{{ number_format($proplandata -> Q3Amount, 2) }}</td>
                          <td>{{ $proplandata -> Oct }}</td>
                          <td>{{ $proplandata -> Nov }}</td>
                          <td>{{ $proplandata -> Dec }}</td>
                          <td>{{ $proplandata -> Q4 }}</td>
                          <td>{{ number_format($proplandata -> Q4Amount, 2) }}</td>
                          <td>{{ $proplandata -> TotalQ }}</td>
                          <td>{{ number_format($proplandata -> Price, 2) }}</td>
                          <td id="totals">{{ number_format($proplandata -> TotalAmount, 2) }}</td>
                          <td align="center">
                            <div class="d-flex mt-2">
                              <form action="financeedit" method="get"><button class="btn btn-primary btn-sm mr-1" type="submit" name="editproplan" value="{{ $proplandata -> ppmpID }}"><i class="fa fa-edit"></i></button></form>
                              <button class="btn btn-danger btn-sm" type="button" id="removeIDButton" value="{{ $proplandata -> ppmpID }}" data-toggle="modal" data-target="#modal-default"><i class="fa fa-times"></i></button>
                            </div>
                          </td>
                        </tr>

                        <div class="modal fade" id="modal-default">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Delete Item</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <p>Are you sure you want to delete this item?</p>
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <form action="financedelete" method="get"><button type="submit" name="removeid" id="removeIDInput" class="btn btn-danger">Delete</button></form>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>

                        @endforeach
                      </tbody>

                      <tfoot>
                        <tr>
                          <th class="text-right" id="val"> SUM</th>
                        </tr>
                      </tfoot>
                    </table>

                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
          <!-- Main row -->

        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Delete User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this data?</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <form action="financedelete" method="get"><button type="submit" name="removeid" value="{{ $proplandata -> ppmpID }}" class="btn btn-danger">Delete</button></form>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

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
  <!-- Select2 -->
  <script src="{{ asset('/bower_components/admin-lte/plugins/select2/js/select2.min.js') }}"></script>
  <!-- Sweet Alert -->
  <script src="{{ asset('/bower_components/admin-lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('.js-example-basic-single').select2({
        width: "80px",
        theme: 'classic'
      });
    });

    function ppmp(src) {
      window.location = src;
    }

    /* $(document).ready(function() {
    $('#dtHorizontalVerticalExample').DataTable({
        "scrollX": true,
        "scrollY": 400,
    });
    $('.dataTables_length').addClass('bs-select');
    }); */
  </script>

  <script>
    $(document).on('click', '#removeIDButton', function() {
      var removeID = $(this).val();
      $('#removeIDInput').val(removeID);
    });
  </script>

  <?php
  $message = Session::pull('message');
  ?>

  @if ($message === 'success')
  <script>
    $(function() {
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      Toast.fire({
        icon: 'success',
        title: 'Successfully Added New Item for Procurement Plan'
      })
    });
  </script>
  @elseif($message === 'update')
  <script>
    $(function() {
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      Toast.fire({
        icon: 'success',
        title: 'Successfully Updated Item for Procurement Plan'
      })
    });
  </script>
  @elseif($message === 'delete item')
  <script>
    $(function() {
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      Toast.fire({
        icon: 'success',
        title: 'Successfully Deleted an Item'
      })
    });
  </script>
  @endif

  <script>
    $(document).ready(function() {
      var t = $('#dtHorizontalVerticalExample').DataTable({
        "scrollX": true,
        "scrollY": 400,
        columnDefs: [{
          searchable: false,
          orderable: false,
          targets: 0,
        }, ],
        order: [
          [1, 'asc']
        ],
        footerCallback: function(row, data, start, end, display) {
          var api = this.api();

          var intVal = function(i) {
            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
          };
          // Total over all pages
          total = api
            .column(26)
            .data()
            .reduce(function(a, b) {
              return intVal(a) + intVal(b);
            }, 0);

          // Total over this page
          pageTotal = api
            .column(26, {
              page: 'current'
            })
            .data()
            .reduce(function(a, b) {
              return intVal(a) + intVal(b);
            }, 0).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');

          // Update footer
          $(api.column(0).footer()).html('Total: ' + pageTotal);
        },
      });
      t.on('order.dt search.dt', function() {
        let i = 1;

        t.cells(null, 0, {
          search: 'applied',
          order: 'applied'
        }).every(function(cell) {
          this.data(i++);
        });
      }).draw();
    });
  </script>
</body>

</html>