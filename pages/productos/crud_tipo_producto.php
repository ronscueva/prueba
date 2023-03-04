<?php
  require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
$fun      =$_POST['funcion'];
$id       =$_POST['id'];
//$producto =$_POST['producto'];

if ($fun==1){
	
	$tipo_producto =$_POST['tipo_producto'];
	$constante =$_POST['constante'];	


	$insert="INSERT INTO empp_tb_tipo_producto (tipo_producto,constante,fecha,estado) VALUES('$tipo_producto','$constante',NOW(),'1')";
	
	$ejec=mysqli_query($con,$insert);
    //echo $insert;die();

	//finPrueba
	 if (mysqli_affected_rows($con)!=0) {
	 echo "1";
	 }else{
	 	echo "2";
	 }

}
if ($fun==2){
	
	$tipo_producto =$_POST['tipo_productox'];
	$constante =$_POST['constantex'];	


	$insert="update empp_tb_tipo_producto (tipo_producto,constante,fecha,estado) VALUES('$tipo_producto','$constante',NOW(),'1')";
	
	$ejec=mysqli_query($con,$insert);
    //echo $insert;die();

	//finPrueba
	 if (mysqli_affected_rows($con)!=0) {
	 echo "1";
	 }else{
	 	echo "2";
	 }

}
?>