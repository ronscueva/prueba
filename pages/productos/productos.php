<?php 
  require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos

  $lista= mysqli_query($con,"SELECT * FROM empp_tb_productos where estado='1'");
  $listado=mysqli_fetch_array($lista);

    $cate= mysqli_query($con,"SELECT * FROM empp_tb_categoria");
    $scate= mysqli_query($con,"SELECT * FROM empp_tb_sub_categoria");

    $tipo= mysqli_query($con,"SELECT * FROM empp_tb_tipo_producto");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Productos</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
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
            <h1>Productos</h1>
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
                <h3 class="card-title">Listado de Productos Registrados</h3>

                 <!-- <a style="margin-left: 80px;" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModalCenter"><spam class="glyphicon glyphicon-plus"></spam>Nuevo Producto</a> -->
                  <!-- REGISTRO DE PRODUCTOS -->
<!-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Registrar Productos Nuevo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Codigo:</label>
        <input type="text" class="form-control" id="dirx" placeholder="Ingrese el codigo...">
        <label>Nombre:</label>
        <input type="text" class="form-control" id="rucx" placeholder="Ingrese el nombre...">
        <label>Descripcion:</label>
        <input type="text" class="form-control" id="socialx" placeholder="Ingrese la descripcion...">
        <label>Cantidad:</label>
        <input type="text" class="form-control" id="telx" placeholder="Ingrese Cantidad...">
        <label>Categoria:</label>
        <input type="text" class="form-control" id="dirx" placeholder="Ingrese la cateogira...">
        <label>Tipo Calidad:</label>
        <input type="text" class="form-control" id="dirx" placeholder="Ingrese la calidad...">
        <label>Espesor:</label>
        <input type="text" class="form-control" id="dirx" placeholder="Ingrese Espesor...">
        <label>Alto:</label>
        <input type="text" class="form-control" id="dirx" placeholder="Ingrese alto...">
        <label>Ancho:</label>
        <input type="text" class="form-control" id="dirx" placeholder="Ingrese ancho...">
        <label>Precio compra:</label>
        <input type="text" class="form-control" id="dirx" placeholder="Ingrese precio compra...">
        <label>Precio venta:</label>
        <input type="text" class="form-control" id="dirx" placeholder="Ingrese precio venta...">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button onclick="registrarcli();" type="button" class="btn btn-primary">Grabar</button>
      </div>
    </div>
  </div>
</div> -->
  <!-- FIN REGISTRO DE PRODUCTOS -->
 
              </div>
        
              <!-- /.card-header -->
              <div class="card-body">
                    <div class="row">
                <div class="col-md-4">
                  <fieldset style=" border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;">
                    <legend style="font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;">REGISTRO DE PRODUCTOS</legend>
                    <form>
                    <div class="row">
                      <div class="col-md-4">
                        <label>Codigo:</label>
                        <input type="text" id="codigo" name="codigo" hidden="true">
                        <input type="text" class="form-control" id="dirx" placeholder="Ingrese el codigo...">
                      </div>
                      <div class="col-md-8">
                        <label>Producto:</label>
                        <input type="text" class="form-control" id="producto" placeholder="Ingrese el Prodcuto...">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <label>Categoria:</label>
                        <select class="form-control" id="categoria">
                          <option>Seleccione</option>
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
                        <label>Tipo Calidad:</label>
                         <select class="form-control" id="subcat">
                          <option>Seleccione</option>
                          <?php
                          foreach ($tipo as $value){
                            ?>
                          <option value="<?php echo $value['constante']; ?>"><?php echo $value['tipo_producto']  ?></option>
                            <?php
                          }
                           ?>
                           
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <label>Espesor:</label>
                        <input type="text" class="form-control" id="espesor" placeholder="Ingrese Espesor...">
                      </div>
                      <div class="col-md-4">
                        <label>Largo:</label>
                        <input type="text" class="form-control" id="alto" placeholder="Ingrese Largo...">
                      </div>
                      <div class="col-md-4">
                        <label>Ancho:</label>
                        <input type="text" class="form-control" id="ancho" placeholder="Ingrese ancho...">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <br>
                        <a onclick="calculopeso();" class="btn btn-danger">calcular Peso</a>
                      </div>
                      <div class="col-md-4">
                        <br>
                        <a onclick="calculoprecio();" class="btn btn-danger">calcular Precio</a>
                      </div>
                      <div class="col-md-4">
                        <label>Peso:</label>
                        <input type="text" class="form-control" id="peso" placeholder="Ingrese Espesor...">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <label>Precio compra:</label>
                        <input type="text" class="form-control" id="precioc" placeholder="Ingrese precio compra...">
                      </div>
                      <div class="col-md-4">
                        <label>Precio venta:</label>
                        <input type="text" class="form-control" id="preciov" placeholder="Ingrese precio venta...">
                      </div>
                      <div class="col-md-4">
                        <label></label>
                        <div id="reg">
                        <button onclick="registrarpro();" type="button" class="btn btn-success form-control">Grabar</button>
                        </div>
                        <div id="edi" hidden="true">
                        <button onclick="editarprod();" type="button" class="btn btn-danger form-control">Editar</button>
                        </div>
                      </div>
                    </div>
                  </form>
                  </fieldset>
                  
                </div>
                <div class="col-md-8">
                    <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width:5%">#</th>
                    <th style="width:11%">Codigo</th>
                    <th>Nombre</th>
                    <th style="width:10%">espesor</th>
                    <th style="width:10%">Largo</th>
                    <th style="width:10%">Ancho</th>
                    <th style="width:10%">Peso</th>
                    <th style="width:17%">Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $cont=0;
                    foreach ($lista as $value) {

                      ?>
                      <tr>
                    <td><?php echo $cont++; ?></td>
                    <td><?php echo $value['codigo_producto']; ?></td>
                    <td><?php echo $value['nombre']; ?></td>
                    <td><?php echo $value['espesor']; ?></td> 
                    <td><?php echo $value['alto']; ?></td>
                    <td><?php echo $value['ancho']; ?></td>
                    <td><?php echo $value['peso']; ?></td>
                    <td><a  onclick="editarpro(<?php echo $value['id_produc']; ?>)" class="btn btn-warning">Editar</a>
                        <a data-toggle="modal" data-target=".bd-example-modal-sm" onclick="eliminarprod(<?php echo $value['id_produc']; ?>)" class="btn btn-danger">Eliminar</a></td>
                  </tr>
                    <?php
                  }
                     ?>
                  
                  </tbody>              
                </table>
                </div>
              </div>
              </div>
              <!-- edicion cliente -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edicion Productos</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                       <form>
                        <input type="text" class="form-control" placeholder="" hidden="true" id="ids">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" placeholder="" id="rucs">
                        <label>Descripcion:</label>
                        <input type="text" class="form-control" placeholder="" id="nomb">
                        <label>Telefono:</label>
                        <input type="text" class="form-control" placeholder="" id="tef">
                        <label>Direccion:</label>
                        <input type="text" class="form-control" placeholder="" id="dire">
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button onclick="edicioncli();" type="button" class="btn btn-primary">Grabar</button>
                    </div>
                  </div>
                </div>
              </div>
              <!--FIN  edicion cliente -->

              <!--  ELIMINAR cliente -->

              <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Alerta!!!</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <input type="text" id="idsx" hidden="true">
                      <a>Esta usted Seguro de Eliminar el Producto?</a>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button onclick="eliminarproduc();" type="button" class="btn btn-danger">eliminar</button>
                    </div>
    </div>
  </div>
</div>
  <!--FIN  ELIMINAR cliente -->




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
<script src="../../js/productos.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
</body>
</html>
