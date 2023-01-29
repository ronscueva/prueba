<?php
  $page_title = 'Lista de sub categorías';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_categories = find_all('sub_categoria');
  $all_categoriaprincipal = find_all('categories')
?>
<?php
 if(isset($_POST['add_cat'])){
   $req_field = array('categorie-name');
   validate_fields($req_field);
   $cat_name = remove_junk($db->escape($_POST['categorie-name']));
   $sub_categoria= remove_junk($db->escape($_POST['product-categorie']));
   $s_date    = make_date();
   if(empty($errors)){
      $sql  = "INSERT INTO sub_categoria (nombre_sub_categoria , id_categories, fecha)";
      $sql .= " VALUES ('{$cat_name}','{$sub_categoria}','{$s_date}' )";
      if($db->query($sql)){
        $session->msg("s", "Sub Categoría agregada exitosamente.");
        redirect('sub_categoria.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
        redirect('sub_categoria.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('sub_categoria.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
  </div>
 <!-- Aca debe iniciar el combo categoria -->
  <form method="post" action="sub_categoria.php">
  
<!-- fin de combo de categoria -->

   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar sub categoría</span>
         </strong>
        </div>
        <div class="panel-body">
             <div class="row">
                    <select class="form-control" name="product-categorie">
                      <option value="">Selecciona una Sub categoría</option>
                    <?php  foreach ($all_categoriaprincipal as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
            
            <div class="form-group">
                <input type="text" class="form-control" name="categorie-name" placeholder="Nombre de la sub categoría" required>
            </div></div>
            <button type="submit" name="add_cat" class="btn btn-primary">Agregar sub categoría</button>
        </form>
        </div>
      </div>
    </div>

    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de sub categorías</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>SubCategorías</th>
                    <th class="text-center" style="width: 100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_categories as $cat):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($cat['nombre_sub_categoria'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
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
  </div>
  <?php include_once('layouts/footer.php'); ?>
