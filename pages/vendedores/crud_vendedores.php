<?php
  require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
$fun   =$_POST['funcion'];
$id    =$_POST['id'];
$dni   =$_POST['dni'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$dir   =$_POST['dir'];
$telef =$_POST['telef'];
//echo "llegue";
if ($fun==1){
	//INSERTAR
	$insert="INSERT INTO empp_tb_vendedor (dni,nombre_vendedor,apellido_vendedor,telefono,direccion,fecha_registro,estado) VALUES('$dni','$nombre','$apellido','$telef','$dir',NOW(),'1')";
	$ejec=mysqli_query($con,$insert);
	 if (mysqli_affected_rows($con)!=0) {
	 echo "1";
	 }else{
	 	echo "2";
	 }

}else if ($fun==2) {
	// buscar
	$return_arr = array();
	$buscar= mysqli_query($con,"SELECT id_vendedor,dni,nombre_vendedor,apellido_vendedor,telefono,direccion,fecha_registro,estado FROM empp_tb_vendedor WHERE estado='1' and id_vendedor='$id'");
    	while ($row = mysqli_fetch_array($buscar)) {
		$row_array['id']=$row['id_vendedor'];
		$row_array['nombre']=$row['nombre_vendedor'];
		$row_array['apellido']=$row['apellido_vendedor'];
		$row_array['dni']=$row['dni'];
		$row_array['dir']=$row['direccion'];
		$row_array['telef']=$row['telefono'];
		array_push($return_arr,$row_array);
    }
   echo json_encode($return_arr);
}else if ($fun==3) {
	// EDITAR
	try {
	$ed="UPDATE empp_tb_vendedor SET dni='$dni',nombre_vendedor='$nombre',apellido_vendedor='$apellido',direccion='$dir',telefono='$telef' WHERE id_vendedor='$id'";
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
	$ed="UPDATE empp_tb_vendedor SET estado='0' WHERE id_vendedor='$id'";
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