<?php
  require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
$fun      =$_POST['funcion'];
$id       =$_POST['id'];
//$producto =$_POST['producto'];
//$proveedor =$_POST['proveedor'];
//$cantidad =$_POST['cantidad'];
//$preciuni =$_POST['preciuni'];
//$total =$_POST['total'];
//echo "llegue";
if ($fun==1){
	
	$proveedor =$_POST['idproveedor'];
	$cantidad =$_POST['cantidad'];
	
	$total =$_POST['total'];
	//INSERTAR
	$insert="INSERT INTO empp_tb_compra (id_proveedor,cantidad_total,fecha,precio_total) VALUES('$proveedor','$cantidad',NOW(),'$total') ; ";
	//echo $insert;die();
	$ejec=mysqli_query($con,$insert);
	//Prueba
	$cot=mysqli_query($con,"SELECT MAX(id) as id  from empp_tb_compra");
	$ids= mysqli_fetch_array($cot);
	$id=$ids['id'];
	$cant=$_POST['cantidad'];
	$total=$_POST['total'];
	$total=$_POST['preciuni'];
	$codigo=$_POST['codigodetalle'];
	$cont=0;
	while ($cont < count($cant)) {
		$canti=$cant[$cont];
		$prec=$preciouni[$cont];
		$tot=$total[$cont];
		$id=$codigo[$cont];
		$texto=number_format($tot, 2, '.', ',');
	
		$prod=mysqli_query($con,"SELECT *  from empp_tb_productos where codigo_producto='$cod'");
		$idprod= mysqli_fetch_array($prod);
		$producto=$idprod['id_produc'];
		
		$insertdet="INSERT INTO empp_tb_detalle_compra(id_compra,id_producto,precio,cantidad,total_subproducto,fecha)
		VALUES('$id','$producto','$prec','$canti','$tot',NOW())";
		$ejecdet=mysqli_query($con,$insertdet);
		$cont=$cont+1;
		}	



	//finPrueba
	 if (mysqli_affected_rows($con)!=0) {
	 echo "1";
	 }else{
	 	echo "2";
	 }

}else if ($fun==2) {
	// buscar
	//echo "23";
	$return_arr = array();
	$buscar= mysqli_query($con,"SELECT id_produc,codigo_producto,id_categoria,id_sub_categoria,nombre,estado,espesor,alto,ancho,precio_compra,precio_venta FROM empp_tb_productos WHERE estado='1' and id_produc='$id'");
    	while ($row = mysqli_fetch_array($buscar)) {
		$row_array['idp']=$row['id_produc'];
		$row_array['codigo']=$row['codigo_producto'];
		$row_array['nombres']=$row['nombre'];
		$row_array['precio_unidad']=$row['precio_venta'];
		array_push($return_arr,$row_array);
    }
   echo json_encode($return_arr);
}else if ($fun==3) {
	// EDITAR
	try {
	$ed="UPDATE empp_tb_productos SET codigo_producto='$id',nombre='$producto',id_categoria='$categoria',id_sub_categoria='$subcat',espesor='$espesor',alto='$alto',ancho='$ancho',precio_venta='$precio',precio_compra='$compra' WHERE id_produc='$id'";
	$exec= mysqli_query($con,$ed);
	//echo $exec;
	 if (mysqli_affected_rows($con)!=0) {
	 echo "1";
	 }else{
	 	echo "2";
	 }
	} catch (Exception $e) {
        echo "2";		
	}
}else if ($fun==4) {
	// ELIMINAR
	try {
	$ed="UPDATE empp_tb_productos SET estado='0' WHERE id_produc='$id'";
	$exec= mysqli_query($con,$ed);
	 if (mysqli_affected_rows($con)!=0) {
	 echo "1";
	 }else{
	 	echo "2";
	 }
	} catch (Exception $e) {
        echo "2";		
	}
}else if ($fun==5) {
	
	$return_arr = array();
	$buscar= mysqli_query($con,"SELECT * from  empp_tb_proveedores WHERE id_proveedores='$id'");
    	while ($row = mysqli_fetch_array($buscar)) {
		$row_array['id']=$row['id_proveedores'];
		$row_array['razon_social']=$row['razon_social'];
		$row_array['direccion']=$row['direccion'];
		$row_array['ruc']=$row['ruc'];
		array_push($return_arr,$row_array);
    }
   echo json_encode($return_arr);
}
?>