<?php 
  require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
  $fun=$_POST['funcion'];
  $id=$_POST['id'];

  if ($fun==1) {
  		// buscar cliente
	$return_arr = array();
	$buscar= mysqli_query($con,"SELECT id_reg,n_doc,nombres,estado,direccion,telefono FROM empp_tb_cliente WHERE estado='1' and n_doc='$id'");
    	while ($row = mysqli_fetch_array($buscar)) {
		$row_array['id']=$row['id_reg'];
		$row_array['nombres']=$row['nombres'];
		$row_array['doc']=$row['n_doc'];
		$row_array['dir']=$row['direccion'];
		$row_array['telef']=$row['telefono'];
		array_push($return_arr,$row_array);
    }
   echo json_encode($return_arr);
  }else if ($fun==2) {
  		// buscar productos
	$return_arr = array();
	$buscar= mysqli_query($con,"SELECT id_produc,codigo_producto,id_categoria,id_sub_categoria,nombre,estado,espesor,alto,ancho,precio_compra,precio_venta FROM empp_tb_productos WHERE estado='1' and codigo_producto='$id'");
    	while ($row = mysqli_fetch_array($buscar)) {
		$row_array['id']=$row['id_produc'];
		$row_array['codigo']=$row['codigo_producto'];
		$row_array['nombres']=$row['nombre'];
		$row_array['cat']=$row['id_categoria'];
		$row_array['scat']=$row['id_sub_categoria'];
		$row_array['estado']=$row['estado'];
		$row_array['espesor']=$row['espesor'];
		$row_array['alto']=$row['alto'];
		$row_array['ancho']=$row['ancho'];
		$row_array['compra']=$row['precio_compra'];
		$row_array['venta']=$row['precio_venta'];
		array_push($return_arr,$row_array);
    }
   echo json_encode($return_arr);
  }
?>