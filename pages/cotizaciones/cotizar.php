<?php 
  require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
date_default_timezone_set("America/Lima");
  $lista= mysqli_query($con,"SELECT * FROM empp_tb_productos where estado='1'");
  $listado=mysqli_fetch_array($lista);
  $listacli= mysqli_query($con,"SELECT * FROM empp_tb_cliente where estado='1'");
  $listadocli=mysqli_fetch_array($listacli);
  $cate= mysqli_query($con,"SELECT * FROM empp_tb_categoria");
  $scate= mysqli_query($con,"SELECT * FROM empp_tb_sub_categoria");

$token = 'apis-token-1.aTSI1U7KEuT-6bbbCguH-4Y8TI6KS73N';
$fecha = date("Y-m-d");
//var_dump($fecha);die();
// Iniciar llamada a API
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.apis.net.pe/v1/tipo-cambio-sunat?fecha=' . $fecha,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 2,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Referer: https://apis.net.pe/tipo-de-cambio-sunat-api',
    'Authorization: Bearer ' . $token
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// Datos listos para usar
$tipoCambioSunat = json_decode($response);
//var_dump($tipoCambioSunat);die();
$dolar=$tipoCambioSunat->compra;
//echo $dolar;die();


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Cotizaciones</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

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
              <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
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
              <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
              <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
   <?php include ('../menu.php'); ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cotizaciones</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Emitir Cotizaciones</h3>
 
              </div>
        
              <!-- /.card-header -->
              <div class="card-body">
             <form id="formcotizar" method="post" >
                 <fieldset style=" border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;">
                    <legend style="font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;">Datos de Cliente</legend>
                    <div class="row">
                      <div class="col-md-2">
                        <label>Ruc</label>
                        <div class="select2-purple">
                    <select id="ruc" name="ruc" name="empresa" class="select2" multiple="multiple" data-placeholder="Ingrese el Codigo" data-dropdown-css-class="select2-purple" style="width: 100%;">
                      <?php 
                      foreach ($listacli as $valuer) {
                        ?>
                      <option value="<?php echo $valuer['n_doc'] ?>"><?php echo $valuer['n_doc'] ?></option>

                        <?php
                      }
                      ?>
                    </select>
                  </div>
                      </div>
                      <div class="col-md-1">
                        <label></label>
                        <a onclick="buscarcli();" class="btn btn-primary form-control"> Buscar</a>
                      </div>
                      <div class="col-md-1">
                        <label></label>
                        <a onclick="emitir();" class="btn btn-success form-control">Emitir Cotizacion</a>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label>Cliente</label>
                        <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Ingrese Cliente..." readonly>
                      </div>
                      <div class="col-md-3">
                        <label>Direccion</label>
                        <input type="text" class="form-control" id="direc" name="direc" placeholder="Ingrese Direccion..." readonly>
                      </div>
                      <!-- <div class="col-md-2">
                        <label>Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Ingrese Fecha...">
                      </div> -->
                      <div class="col-md-1">
                        <label>Descuento</label>
                        <input type="text" hidden="true" class="form-control" id="telef" name="telef" placeholder="Ingrese Telefono..." readonly>
                        <input class="form-control" type="text" name="descuento" id="descuento" value="0" placeholder="Ingrese Descuento..." readonly>
                      </div>
                      
                      <div class="col-md-1">
                        <label>Total</label>
                        <input type="text" class="form-control" id="totalf" name="totalf" placeholder="Ingrese Total...">
                      </div>
                      <div class="col-md-1">
                        <label>Cambio $</label>
                        <input type="text" class="form-control" id="dolar" name="dolar" placeholder="Ingrese Total..." value="<?php echo number_format($dolar,3,'.','') ?>">
                      </div>
                    </div>
                </fieldset>
                <div class="row">
                  <div class="col-md-5">
                    <fieldset style=" border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;">
                    <legend style="font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;">Datos de Productos</legend>
       <div class="row">
                      <div  class="col-md-10">
                        <label>Codigo Producto</label>
                        <!-- <input class="form-control" id="codigo" type="text" placeholder="Ingrese Codigo..."> -->
                        <div class="select2-purple">
                    <select style="font-size:11px" id="codigo" class="select2 form-control" multiple="multiple" data-placeholder="Ingrese el Codigo" data-dropdown-css-class="select2-purple" >
                      <?php 
                      foreach ($lista as $valuer) {
                        ?>
                      <option style="font-size:11px" value="<?php echo $valuer['codigo_producto'] ?>"><?php echo $valuer['codigo_producto'].' '.
                      substr($valuer['nombre'], 0,22)  ?></option>

                        <?php
                      }
                      ?>
                    </select>
                  </div>
                      </div>
                      <div class="col-md-2">
                        <label></label>
                        <a onclick="buscarprod();" class="btn btn-default form-control"><img style="width: 20px;" src="lupa.png"></a>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10">
                        <label>Producto</label>
                        <input type="text" class="form-control" id="producto" name="" placeholder="Ingrese Producto..." readonly>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-md-4">
                        <label>Categoria</label>
                         <select class="form-control" id="categoria" readonly>
                          <option>Seleccione Categoria</option>
                          <?php
                          foreach ($cate as $value) {
                            ?>
                          <option value="<?php echo $value['id']; ?>"><?php echo $value['nombre_categoria']; ?></option>
                            <?php
                          }
                           ?>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <label>Precio</label>
                        <input type="text" class="form-control" id="preciov" name="" placeholder="Ingrese Precio Venta..." readonly>
                      </div>
                       <div class="col-md-4">
                        <label>Stock</label>
                        <input type="text" class="form-control" id="stock" name="" placeholder="Ingrese Precio Venta..." readonly>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <label>Peso</label>
                        <input type="text" class="form-control" id="peso" name="" placeholder="Ingrese Espesor..." readonly>
                      </div>
                      <div class="col-md-4">
                        <label>Descuento</label>
                        <input type="text" class="form-control" id="descitem" name="" placeholder="Ingrese Descuento..." value="0.00">
                      </div>
                      <div class="col-md-4">
                        <label>Cantidad</label>
                        <input type="text"  class="form-control" id="cantidad" name="" placeholder="Ingrese Cantidad...">
                      </div>
                    </div>
                   
                    <div class="row">
                   <!--<div class="col-md-0">
                        <label>Total</label>
                        <input type="text" class="form-control" id="total" name="" placeholder="Ingrese Precio total..." readonly>
                      </div> -->
                      <div class="col-md-12">
                        <label></label>
                       <a onclick="agregar();" class="btn btn-danger form-control">Agregar</a>
                      </div>
                    </div>
                </fieldset>
                  </div>
                  <div class="col-md-7">
                     <table class="table table-dark">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>peso</th>
                    <th>Precio</th>
                    <th>Descuento</th>
                    <th>Precio Final</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                  </tr>
                  </thead>
                  <tbody id="detalles">
                  </tbody>                    
                  </table>
                  </div>
                </div>
            
            </form>

              </div>
              </div>



            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../js/cotizaciones.js"></script>
<!-- Bootstrap 4 -->
<!-- <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<!-- <script src="../../plugins/jszip/jszip.min.js"></script> -->
<!-- <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script> -->
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../dist/js/demo.js"></script> -->
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script type="text/javascript">
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })
  })
</script>
</body>
</html>
