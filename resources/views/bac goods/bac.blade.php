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
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <script src=" https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
              <button class="btn btn-danger btn-sm btn-lg" style="width:100%"><i class="fa fa-power-off" href="{{ route('logout')}}"></i> Logout</button>
            </a>

            <div class="dropdown-divider"></div>
          </div>
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
            <li class="nav-item has-treeview menu-open">
              <a href="bacgoods" class="nav-link active">
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
              <a href=" " class="nav-link">
                <i class="nav-icon fas fa-palette"></i>
                <p>
                  Goods & Services
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
                  <a href="bidding" class="nav-link">
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
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
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
          <!-- <div class="row">
                <div class="col-lg-6 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                    <h3><i class="fa fa-users"></i></h3>
                    <p></p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer"></a>
                </div>
                </div>
                <div class="col-lg-6 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                    <h3><i class="fa fa-shopping-cart"></i></h3>
                    <p></p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer"></a>
                </div>
                </div>
                <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                    <h3><i class="fa fa-cart-plus"></i></h3>
                    <p></p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer"></a>
                </div>
                </div>
                <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                    <h3><i class="fa fa-palette"></i></h3>
                    <p></p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer"></a>
                </div>
                </div>
            </div> -->

          <div class="d-flex justify-content-end mt-1 p-2" id="">
            <select class="js-example-basic-single" id="select2" style="width: 100%" onchange="ppmp(this.value)">
              <option value="bacgoodsDashboard,CSA" {{ $department == 'CSA' ? 'selected' : '' }}>CSA</option>
              <option value="bacgoodsDashboard,CBET" {{ $department == 'CBET' ? 'selected' : '' }}>CBET</option>
              <option value="bacgoodsDashboard,CED" {{ $department == 'CED' ? 'selected' : '' }}>CED</option>
              <option value="bacgoodsDashboard,CAS" {{ $department == 'CAS' ? 'selected' : '' }}>CAS</option>
              <option value="bacgoodsDashboard,IPE" {{ $department == 'IPE' ? 'selected' : '' }}>IPE</option>
              <option value="bacgoodsDashboard,CEAT" {{ $department == 'CEAT' ? 'selected' : '' }}>CEAT</option>
              <option value="bacgoodsDashboard,MIC" {{ $department == 'MIC' ? 'selected' : '' }}>MIC</option>
              <option value="bacgoodsDashboard,DRRMO" {{ $department == 'DRRMO' ? 'selected' : '' }}>DRRMO</option>
              <option value="bacgoodsDashboard,GCSC" {{ $department == 'GCSC' ? 'selected' : '' }}>GCSC</option>
              <option value="bacgoodsDashboard,OVP" {{ $department == 'OVP' ? 'selected' : '' }}>OVP</option>
              <option value="bacgoodsDashboard,SGO" {{ $department == 'SGO' ? 'selected' : '' }}>SGO</option>
              <option value="bacgoodsDashboard,SRAC" {{ $department == 'SRAC' ? 'selected' : '' }}>SRAC</option>
              <option value="bacgoodsDashboard,HRDC" {{ $department == 'HRDC' ? 'selected' : '' }}>HRDC</option>
              <option value="bacgoodsDashboard,Supply" {{ $department == 'Supply' ? 'selected' : '' }}>Supply Office</option>
              <option value="bacgoodsDashboard,Finance" {{ $department == 'Finance' ? 'selected' : '' }}>Finance Office</option>
              <option value="bacgoodsDashboard,President" {{ $department == 'President' ? 'selected' : '' }}>Office of the President</option>
              <option value="bacgoodsDashboard,BAC" {{ $department == 'BAC' ? 'selected' : '' }}>BAC Office</option>
            </select>
          </div>

          <!-- row -->
          <div class="row">
            <div class="col-12">
              <!-- jQuery Knob -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Quarterly Progress</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-6 col-md-3 text-center">
                      <input type="text" id="q1" class="knob" value="0" data-width="90" data-height="90" data-fgColor="#3c8dbc" readonly>

                      <div class="knob-label">Quarter 1</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-6 col-md-3 text-center">
                      <input type="text" id="q2" class="knob" value="0" data-width="90" data-height="90" data-fgColor="#f56954" readonly>

                      <div class="knob-label">Quarter 2</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-6 col-md-3 text-center">
                      <input type="text" id="q3" class="knob" value="0" data-width="90" data-height="90" data-fgColor="#00a65a" readonly>

                      <div class="knob-label">Quarter 3</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-6 col-md-3 text-center">
                      <input type="text" id="q4" class="knob" value="0" data-width="90" data-height="90" data-fgColor="#00c0ef" readonly>

                      <div class="knob-label">Quarter 4</div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- BAR CHART -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Procurement Chart</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
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
  <!-- Select2 -->
  <script src="{{ asset('/bower_components/admin-lte/plugins/select2/js/select2.min.js') }}"></script>
</body>

<script>
  $(document).ready(function() {
    $('.js-example-basic-single').select2({
      width: "80px",
      theme: 'classic'
    });
  });

  function ppmp(value) {
    var values = value.split(',');
    var url = values[0];
    var specificValue = values[1];
    window.location = url + "?department=" + specificValue;
  }
</script>

<script>
  var itemJson = JSON.parse('{!! $itemJson !!}');
  var january = 0;
  var february = 0;
  var march = 0;
  var april = 0;
  var may = 0;
  var june = 0;
  var july = 0;
  var august = 0;
  var september = 0;
  var october = 0;
  var november = 0;
  var december = 0;

  var totalQ1 = 0;
  var totalQ2 = 0;
  var totalQ3 = 0;
  var totalQ4 = 0;

  for (var i = 0; i < itemJson.length; i++) {
    var jan = parseInt(itemJson[i].Jan);
    var feb = parseInt(itemJson[i].Feb);
    var mar = parseInt(itemJson[i].Mar);
    var apr = parseInt(itemJson[i].Apr);
    var may = parseInt(itemJson[i].May);
    var jun = parseInt(itemJson[i].June);
    var jul = parseInt(itemJson[i].July);
    var aug = parseInt(itemJson[i].Aug);
    var sep = parseInt(itemJson[i].Sept);
    var oct = parseInt(itemJson[i].Oct);
    var nov = parseInt(itemJson[i].Nov);
    var dec = parseInt(itemJson[i].Dec);

    var q1 = parseInt(itemJson[i].Q1);
    var q2 = parseInt(itemJson[i].Q2);
    var q3 = parseInt(itemJson[i].Q3);
    var q4 = parseInt(itemJson[i].Q4);

    january += jan;
    february += feb;
    march += mar;
    april += apr;
    may += may;
    june += jun;
    july += jul;
    august += aug;
    september += sep;
    october += oct;
    november += nov;
    december += dec;

    totalQ1 += q1;
    totalQ2 += q2;
    totalQ3 += q3;
    totalQ4 += q4;
  }

  var totalQuarter1 = january + february + march;
  var totalQuarter2 = april + may + june;
  var totalQuarter3 = july + august + september;
  var totalQuarter4 = october + november + december;

  var percentQ1 = (totalQuarter1 / totalQ1) * 100;
  var percentQ2 = (totalQuarter2 / totalQ2) * 100;
  var percentQ3 = (totalQuarter3 / totalQ3) * 100;
  var percentQ4 = (totalQuarter4 / totalQ4) * 100;

  var knobQ1 = document.getElementById('q1');
  knobQ1.value = percentQ1;

  var knobQ2 = document.getElementById('q2');
  knobQ2.value = percentQ2;

  var knobQ3 = document.getElementById('q3');
  knobQ3.value = percentQ3;

  var knobQ4 = document.getElementById('q4');
  knobQ4.value = percentQ4;

  $(".knob").knob({
    'format': function(value) {
      return Math.round(value) + '%';
    }
  });

  $(function() {

    var areaChartData = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [{
        label: 'Procured Items',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [january, february, march, april, may, june, july, august, september, october, november, december]
      }, ]
    }

    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    barChartData.datasets[0] = temp0

    var barChartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      datasetFill: false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })
  });
</script>

</html>