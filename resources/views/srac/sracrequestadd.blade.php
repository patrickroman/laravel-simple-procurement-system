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
            <a href="#" class="d-block">SRAC Home Page</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="sracdashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="sracproplan" class="nav-link">
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
                  <a href="sracrequest" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Active Request</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="sracrequest2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Closed Request</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="sractrash" class="nav-link">
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
                <li class="breadcrumb-item active">Request</li>

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
                  <h3 class="card-title">Purchase Request / Add Request</h3>
                </div>

                <div class="card-body table-responsive">
                  <form role="form" action="sracaddrequest" method="post">
                    @csrf

                    <div class="row">
                      <div class="col-md-12">
                        <table class="table table-bordered " id="item-list">
                          <colgroup>
                            <col width="5%">
                            <col width="10%">
                            <col width="20%">
                            <col width="35%">
                            <col width="20%">
                            <col width="10%">
                          </colgroup>
                          <thead>
                            <tr class="bg-navy disabled">
                              <th class="px-1 py-1 text-center"></th>
                              <th class="px-1 py-1 text-center">Quantity</th>
                              <th class="px-1 py-1 text-center">Unit</th>
                              <th class="px-1 py-1 text-center">Description of Articles</th>
                              <th class="px-1 py-1 text-center">Price</th>
                              <th class="px-1 py-1 text-center">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="po-item" data-id="">

                            </tr>
                          </tbody>
                          <tfoot>
                            <tr class="bg-lightblue">
                            <tr>
                              <input type="hidden" name="user_name" value="{{ Session::get('user') }}">
                              <input type="hidden" name="controlno" value="<?php echo "2023-00-" . (sprintf("%'.04d", mt_rand(1, 9999))); ?>">
                              <th class="p-1 text-right" colspan="5"><span><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button></span>Total</th>
                              <th class="p-1 text-right" id="sub_total" name="sub_total" value="0">0</th>
                            </tr>
                            </tr>
                          </tfoot>
                        </table>
                        <div class="row">
                          <div class="col-md-12">
                            <label for="notes" class="control-label">Notes</label>
                            <textarea name="notes" id="notes" cols="10" rows="4" class="form-control rounded-0" required></textarea>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <label for="purpose" class="control-label">Purpose/s</label>
                            <textarea name="purpose" id="purpose" cols="6" rows="1" class="form-control rounded-0" required></textarea>
                          </div>
                          <div class="col-md-6">
                            <label for="source" class="control-label">Budget Source</label>
                            <textarea name="source" id="source" cols="6" rows="1" class="form-control rounded-0" required></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="hidden" name="requestby" id="requestby" value="{{ Session::get('user') }}">
                            <label for="action" class="control-label">Action Taken</label>
                            <textarea name="action" id="action" cols="6" rows="1" class="form-control rounded-0"></textarea>
                          </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <a href="sracrequest" class="btn btn-danger" role="button"><span aria-hidden="true">Close</span></a>
                          <button type="submit" name="save" id="saveBtn" class="btn btn-primary">Save</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <table class="d-none " id="item-clone">
                  <tr class="po-item" data-id="">
                    <td class="align-middle p-1 text-center">
                      <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
                    </td>
                    <td class="align-middle p-0 text-center">
                      <input type="number" class="text-center w-100 border-0" step="any" id="qty" min="1" name="qty[]" />
                    </td>
                    <td class="align-middle p-1">
                      <input type="text" class="text-center w-100 border-0" name="unit[]" readonly />
                    </td>
                    <td class="align-middle p-1">
                      <input type="hidden" name="item_id[]" />
                      <input type="text" class="text-center w-100 border-0 item_id" placeholder="Enter Item Name" required />
                    </td>
                    <td class="align-middle p-1">
                      <input type="number" step="any" class="text-right w-100 border-0" name="unit_price[]" readonly />
                    </td>
                    <td class="align-middle p-1 text-right total_price" name="total_price"></td>
                  </tr>
                </table>

              </div>
            </div>
          </div>
        </div>
      </section>
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
  <script src="../plugins/sparklines/sparkline.js"></script>
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
  <!-- Sweet Alert -->
  <script src="{{ asset('/bower_components/admin-lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('#saveBtn').click(function() {
        $(this).addClass('disabled'); // Disable the button
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...'); // Add the spinner
        // Your save function here
      });
    });
  </script>

  <script>
    const d = new Date();
    let month = d.getMonth();

    function rem_item(_this) {
      _this.closest('tr').remove()
    }

    function autosearch($row) {
      $row.find(".item_id").autocomplete({
        source: function(request, response) {
          $.ajax({
            url: '/sracautocomplete',
            type: 'GET',
            datatype: 'json',
            success: function(data) {
              $aData = $.each(JSON.parse(data), function(value, key) {
                return {
                  id: value.ppmpID,
                  label: value.ItemDet,
                  unit: value.UnitMeas,
                  price: value.Price
                };
              });
              var results = $.ui.autocomplete.filter($aData, request.term);
              response(results);
            }
          })
        },
        select: function(event, ui) {
          console.log(ui.item.id)
          console.log(ui.item.unit)
          console.log(ui.item.price)
          console.log(ui.item.q1)
          console.log(ui.item.q2)
          console.log(ui.item.q3)
          console.log(ui.item.q4)
          console.log(month)
          $row.find('input[name="item_id[]"]').val(ui.item.id);
          $row.find('input[name="unit[]"]').val(ui.item.unit);
          $row.find('input[name="unit_price[]"]').val(ui.item.price);
          if (month == 0 || month == 1 || month == 2) {
            $row.find('input[name="qty[]"]').val(ui.item.q1);
            $row.find('input[name="qty[]"]').prop('max', ui.item.q1);
          } else if (month == 3 || month == 4 || month == 5) {
            $row.find('input[name="qty[]"]').val(ui.item.q2);
            $row.find('input[name="qty[]"]').prop('max', ui.item.q2);
          } else if (month == 6 || month == 7 || month == 8) {
            $row.find('input[name="qty[]"]').val(ui.item.q3);
            $row.find('input[name="qty[]"]').prop('max', ui.item.q3);
          } else {
            $row.find('input[name="qty[]"]').val(ui.item.q4);
            $row.find('input[name="qty[]"]').prop('max', ui.item.q4);
          }

        }
      });
    }

    $(document).ready(function() {
      $table = $('#item-clone');
      var $existRow = $table.find('tr').eq(1);
      autosearch($existRow);
    });

    $(document).ready(function() {
      $('#add_row').click(function() {
        var tr = $('#item-clone tr').clone().removeAttr('id')
        $('#item-list tbody').append(tr)
        autosearch(tr);

      });
    });
  </script>

  <?php
  $message = Session::pull('message');
  ?>

  @if ($message === 'error')
  <script>
    $(function() {
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      Toast.fire({
        icon: 'warning',
        title: 'Invalid Request, Please Add at least one item'
      })
    });
  </script>
  @endif

</body>

</html>