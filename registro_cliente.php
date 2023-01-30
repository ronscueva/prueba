<?php
  $page_title = 'Lista de productos';
  require_once 'includes/load.php';
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $products = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Agregar Clientes</a>
           <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="post" action="#">
        <div class="row">
          <div class="col-md-3">
            <a>Nro de RUC</a>
         <input class="form-control" type="number" id="ruc" name="" placeholder="Ingrese Nro RUC" required>   
          </div>
          <div class="col-md-9">
            <label>Razon Social</label>
         <input class="form-control" type="text" id="nombre"  name="" placeholder="Ingrese Nombres" required>   
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label>Telefono</label>
         <input class="form-control" type="text" id="telefono"   name="" placeholder="Ingrese Telefono">
          </div>
          <div class="col-md-9">
            <label>Direccion</label>
         <input class="form-control" type="text" id="direccion"   name="" placeholder="Ingrese Direccion" required>
          </div>
        </div>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button onclick="grabarcliente();" type="button" class="btn btn-primary">Grabar</button>
      </div>
    </div>
  </div>
</div>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" style="width: 10%;"> RUC </th>
                <th class="text-center" style="width: 10%;"> NOMBRES </th>
                <th class="text-center" style="width: 10%;">DIRECCION </th>
                <th class="text-center" style="width: 10%;"> AGREGADO </th>
                <th class="text-center" style="width: 100px;"> ACCIONES </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
                </td>
                <td> <?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src="js/clientes.js"></script>
  <?php include_once('layouts/footer.php'); ?>