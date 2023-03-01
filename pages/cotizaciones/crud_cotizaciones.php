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
	$buscar= mysqli_query($con,"SELECT a.id_produc,a.codigo_producto,a.id_categoria,a.id_sub_categoria,a.nombre,a.estado,a.espesor,a.alto,a.ancho,a.precio_compra,a.precio_venta, CASE WHEN b.stock is NULL then '0' WHEN b.stock='' then '0' else b.stock end stock FROM empp_tb_productos a left join empp_tb_inventario b on b.id_produc=a.id_produc WHERE a.estado='1' and a.codigo_producto='$id'");
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
		$row_array['stock']=$row['stock'];
		array_push($return_arr,$row_array);
    }
   echo json_encode($return_arr);
  }else if ($fun==3) {
  		// INSERTAR FACTURA Y DETALLE
  	//--CAB
  	$usrs=mysqli_query($con,"SELECT id  from empp_tb_users where username='admin'");
  	$vend= mysqli_fetch_array($usrs);
  	$ids=$vend['id'];
  	$corre=mysqli_query($con,"SELECT numero  from empp_tb_correlativo where usuario='admin' and documento='Factura'");
  	$num= mysqli_fetch_array($corre);
  	$nro=intval($num['numero'])+intval(1);
  	$docu="FV".$ids."-".str_pad($nro, 8, "0", STR_PAD_LEFT);
  	$cab="INSERT INTO empp_tb_factura_cab (tipo_doc,fecha_reg,id_cliente,monto,n_documento,descuento,observacion,id_usuario,precio_texto,estado,id_coti) SELECT tipo_doc,fecha_reg,id_cliente,monto,'$docu',descuento,observacion,id_usuario,precio_texto,estado,'$id' from empp_tb_cotizacion WHERE id_reg='$id'";
  	$ejeccab=mysqli_query($con,$cab);
  	//--DET
  	$facts=mysqli_query($con,"SELECT MAX(id_reg) as ids  from empp_tb_factura_cab");
  	$factsx= mysqli_fetch_array($facts);
  	$idsx=$factsx['ids'];
  	$det="INSERT INTO empp_tb_factura_det (id_regcab,id_producto,cantidad,precio,total,fecha_reg,descuento,precio_texto,estado) SELECT '$idsx',id_producto,cantidad,precio,total,fecha_reg,descuento,precio_texto,estado from empp_tb_cotizacion_det WHERE id_regcab='$id'";
  	//var_dump($det);die();
  	$ejecdet=mysqli_query($con,$det);
  	//ACT ESTADO COTIZACION
  	$upd="UPDATE empp_tb_cotizacion set estado='3' where id_reg='$id'";
  	$ejecupd=mysqli_query($con,$upd);
  	$upd="UPDATE empp_tb_correlativo set numero='$nro' where usuario='admin' and documento='Factura'";
  	$ejecupd=mysqli_query($con,$upd);
  	 if (mysqli_affected_rows($con)!=0) {
	 echo "1";
	 }else{
	 	echo "2";
	 }

  }else if ($fun==4) {
  		// ANULAR COTIZACIONES

  	$upd="UPDATE empp_tb_cotizacion set estado='2' where id_reg='$id'";
  	$ejecupd=mysqli_query($con,$upd);
  	 if (mysqli_affected_rows($con)!=0) {
	 echo "1";
	 }else{
	 	echo "2";
	 }

  }else if ($fun==5) {
  	 		// INSERTAR FACTURA Y DETALLE
  	//--CAB
  	$usrs=mysqli_query($con,"SELECT id  from empp_tb_users where username='admin'");
  	$vend= mysqli_fetch_array($usrs);
  	$ids=$vend['id'];
  	$corre=mysqli_query($con,"SELECT numero  from empp_tb_correlativo where usuario='admin' and documento='OPedido'");
  	$num= mysqli_fetch_array($corre);
  	$nro=intval($num['numero'])+1;
  	$docu="OP".$ids."-".str_pad($nro, 8, "0", STR_PAD_LEFT);
  	$cab="INSERT INTO empp_tb_ordenpedido_cab (tipo_doc,fecha_reg,id_cliente,monto,n_documento,descuento,observacion,id_usuario,precio_texto,estado,id_coti) SELECT tipo_doc,fecha_reg,id_cliente,monto,'$docu',descuento,observacion,id_usuario,precio_texto,estado,'$id' from empp_tb_cotizacion WHERE id_reg='$id'";
  	$ejeccab=mysqli_query($con,$cab);
  	//--DET
  	$facts=mysqli_query($con,"SELECT MAX(id_reg) as ids  from empp_tb_ordenpedido_cab");
  	$factsx= mysqli_fetch_array($facts);
  	$idsx=$factsx['ids'];
  	$det="INSERT INTO empp_tb_ordenpedido_det (id_regcab,id_producto,cantidad,precio,total,fecha_reg,descuento,precio_texto,estado) SELECT '$idsx',id_producto,cantidad,precio,total,fecha_reg,descuento,precio_texto,estado from empp_tb_cotizacion_det WHERE id_regcab='$id'";
  	$ejecdet=mysqli_query($con,$det);
  	//ACT ESTADO COTIZACION
  	$upd="UPDATE empp_tb_cotizacion set estado='4' where id_reg='$id'";
  	$ejecupd=mysqli_query($con,$upd);
  	 if (mysqli_affected_rows($con)!=0) {
	 echo "1";
	 }else{
	 	echo "2";
	 }
  }
?>