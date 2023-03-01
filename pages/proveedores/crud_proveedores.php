<?php
  require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
$fun   =$_POST['funcion'];
$id    =$_POST['id'];
$ruc   =$_POST['ruc'];
$social=$_POST['social'];
$dir   =$_POST['dir'];
$telef =$_POST['telef'];
//echo "$ruc";
if ($fun==1){
	//INSERTAR
	$insert="INSERT INTO empp_tb_proveedores (ruc,razon_social,telefono,direccion,fecha_registro,estado) VALUES('$ruc','$social','$telef','$dir',NOW(),'1')";
	$ejec=mysqli_query($con,$insert);
    //echo "$insert";
    //die;
	 if (mysqli_affected_rows($con)!=0) {
	 echo "1";
	 }else{
	 	echo "2";
	 }

}else if ($fun==2) {
	// buscar
	//echo "1995";
	$return_arr = array();
	$buscar= mysqli_query($con,"SELECT id_proveedores,ruc,razon_social,telefono,direccion,fecha_registro,estado FROM empp_tb_proveedores WHERE estado='1' and id_proveedores='$id'");
   	
    while ($row = mysqli_fetch_array($buscar)) {
		$row_array['id']=$row['id_proveedores'];
		$row_array['ruc']=$row['ruc'];
		$row_array['razon_social']=$row['razon_social'];
		$row_array['dir']=$row['direccion'];
		$row_array['telef']=$row['telefono'];
		array_push($return_arr,$row_array);
        //echo "$row";
    }
   // echo $row_array['telef'];
   echo json_encode($return_arr);
}else if ($fun==3) {
	// EDITAR
	try {
	$ed="UPDATE empp_tb_proveedores SET ruc='$ruc',razon_social='$social',direccion='$dir',telefono='$telef' WHERE id_proveedores='$id'";
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
	$ed="UPDATE empp_tb_proveedores SET estado='0' WHERE id_proveedor='$id'";
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
?>