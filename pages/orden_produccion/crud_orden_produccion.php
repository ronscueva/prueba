<?php
  require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
$fun      =$_POST['funcion'];
$id       =$_POST['id'];

//var_dump($id_materia);
if ($fun==1){
$tipo_producto= $_POST['tipo_producto'];
$cantidad  =$_POST['cantidad'];
$espesor  =$_POST['espesor'];
$largo     =$_POST['largo'];
$ancho    =$_POST['ancho'];
$obs    =$_POST['obs'];
    $tipo=mysqli_query($con,"SELECT constante FROM empp_tb_tipo_producto where id_tipo = $tipo_producto ");
	$exec= mysqli_fetch_array($tipo);
	$constante= $exec['constante'];	
	
if ($tipo_producto==1) {
$peso = ($espesor * $ancho * $largo * $constante)/1000000;	
}else{
$peso = ($espesor * $ancho * $largo * $constante)/1000000;	
}
	$insert="INSERT INTO empp_tb_orden_produccion (tipo,cantidad,espesor,largo,ancho,peso,obs,estado) VALUES('$tipo_producto','$cantidad','$espesor','$largo','$ancho','$peso','$obs','1')";
	//echo $insert;die();
	$ejec=mysqli_query($con,$insert);
	

}else if ($fun==2) {
	$codigo    =$_POST['codigo'];
	$idsxcodigobobina    =$_POST['idsxcodigobobina'];
	//echo "23";
	try {
	$ed="UPDATE empp_tb_orden_produccion SET id_materia='$codigo' WHERE id_orden_pedido='$idsxcodigobobina'";
	$exec= mysqli_query($con,$ed);
	//echo $ed;die();
	if (mysqli_affected_rows($con)!=0) {
		echo "1";
		}else{
			echo "2";
		}
	   } catch (Exception $e) {
		   echo "2";		
	   }
	
}else if ($fun==3) {
	$cantidad    =$_POST['cantidad'];
	$espesor    =$_POST['espesor'];
	$largo    =$_POST['largo'];
	$ancho    =$_POST['ancho'];
	$obs    =$_POST['obs'];
	$idsxcodigobobina  =$_POST['idsxcodigobobina'];
	//$peso = $espesor * $ancho * $alto * $constante ; 
	$tipo=mysqli_query($con,"select tp.constante from empp_tb_orden_produccion op inner join empp_tb_tipo_producto tp on tp.id_tipo = op.tipo where op.id_orden_pedido = $idsxcodigobobina ");
	$exec= mysqli_fetch_array($tipo);
	$constante= $exec['constante'];	
	$peso = $espesor * $ancho * $largo * $constante * $cantidad;
	try {
		$insert="INSERT INTO empp_tb_merma (id_orden_produccion,cantidad,espesor,largo,ancho,peso,obs,fecha,estado) VALUES('$idsxcodigobobina','$cantidad','$espesor','$largo','$ancho','$peso','$obs',NOW(),'1')";
		//echo $insert;die();
		$ejec=mysqli_query($con,$insert);
		
		$ed="UPDATE empp_tb_orden_produccion SET estado = 2 WHERE id_orden_pedido='$idsxcodigobobina'";
		$exec= mysqli_query($con,$ed);


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
	$ed="UPDATE empp_tb_orden_produccion SET estado='0' WHERE id_orden_pedido='$id'";
	$exec= mysqli_query($con,$ed);
	 if (mysqli_affected_rows($con)!=0) {
	 echo "1";
	 }else{
	 	echo "2";
	 }
	} catch (Exception $e) {
        echo "2";		
	}
}
else if ($fun==5) {
	$tipo_producto =$_POST['tipo_producto'];
	$constante =$_POST['constante'];	


	$insert="INSERT INTO empp_tb_tipo_producto (tipo_producto,constante,fecha,estado) VALUES('$tipo_producto','$constante',NOW(),'1')";
	//echo $insert;die();
	$ejec=mysqli_query($con,$insert);
	
}
?>