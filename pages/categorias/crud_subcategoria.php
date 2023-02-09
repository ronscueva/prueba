<?php
  require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
$fun   =$_POST['funcion'];
$id    =$_POST['id'];
$nombre=$_POST['nombre'];
//echo "llegue";
if ($fun==1){
	//INSERTAR
	$insert="INSERT INTO empp_tb_categoria (nombre_categoria,fecha_creacion,estado) VALUES('$nombre',NOW(),'1')";
	$ejec=mysqli_query($con,$insert);
	 if (mysqli_affected_rows($con)!=0) {
	 echo "1";
	 }else{
	 	echo "2";
	 }

}else if ($fun==2) {
	// buscar
	//echo "23";
	$return_arr = array();
	$buscar= mysqli_query($con,"SELECT id,nombre_categoria,fecha_creacion,estado FROM empp_tb_categoria WHERE estado='1' and id='$id'");
    	while ($row = mysqli_fetch_array($buscar)) {
		$row_array['id']=$row['id'];
		$row_array['nombres']=$row['nombre_categoria'];
		array_push($return_arr,$row_array);
    }
   echo json_encode($return_arr);
}else if ($fun==3) {
	// EDITAR
	try {
	$ed="UPDATE empp_tb_categoria SET nombre_categoria='$nombre', fecha_modificacion = NOW() WHERE id='$id'";
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
	$ed="UPDATE empp_tb_cliente SET estado='0' WHERE id_reg='$id'";
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