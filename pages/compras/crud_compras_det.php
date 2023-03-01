<?php 
session_start();
  require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
//$users=$_SESSION['user'];
$proveedor =$_POST['id_prove'];
$cantidad =$_POST['cantif'];
$total =$_POST['totalf'];
$contador =$_POST['contadorf'];

$insert="INSERT INTO empp_tb_compra (id_proveedor,cantidad_total,fecha,precio_total) VALUES('$proveedor','$cantidad',NOW(),'$total') ; ";
$ejec=mysqli_query($con,$insert);

$cot=mysqli_query($con,"SELECT MAX(id) as id  from empp_tb_compra");
$ids= mysqli_fetch_array($cot);

$idcompra=$ids['id'];
$productogrid=$_POST['codigodetallegrid'];
$totalgrid=$_POST['totalgrid'];
$preciunigrid=$_POST['preciunigrid'];
$cantidadgrid=$_POST['cantidadgrid'];
//$cant=$_POST['conteo'];
//var_dump($idcompra);
$cont=0;
while ($cont < $contador) {
	$cantgrid=$cantidadgrid[$cont];
	$precigrid=$preciunigrid[$cont];
	$togrid=$totalgrid[$cont];
	$prgrid=$productogrid[$cont];

$insertdet="INSERT INTO empp_tb_detalle_compra(id_compra,id_producto,precio,cantidad,total_subproducto,fecha)
                                        VALUES('$idcompra','$prgrid',$precigrid,$cantgrid,$togrid,NOW())";									
$ejecdet=mysqli_query($con,$insertdet);
// UPDATE SELECT

$kar=mysqli_query($con,"SELECT id_produc, stock , fecha_mof from empp_tb_inventario where id_produc = $prgrid ");
$idss= mysqli_fetch_array($kar);
$stock=$idss['stock'];
$stock= $stock + $cantgrid;		
// UPDATE 
$act="UPDATE empp_tb_inventario SET stock='$stock'  where id_produc='$prgrid' ";
$idses= mysqli_query($con,$act);


$cont=$cont+1;


}

?>