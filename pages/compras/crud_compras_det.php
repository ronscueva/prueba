<?php 
session_start();
  require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
//$users=$_SESSION['user'];
$proveedor =$_POST['id_prove'];
$cantidad =$_POST['cantif'];
$total =$_POST['totalf'];
$contador =$_POST['contadorf'];
$numfactura =$_POST['numfactura'];
$fecha_compra =$_POST['fecha_compra'];
$pesof =$_POST['pesof'];

$insert="INSERT INTO empp_tb_compra (id_proveedor,num_factura,peso_total,cantidad_total,fecha,precio_total) VALUES('$proveedor','$numfactura','$pesof','$cantidad','$fecha_compra','$total') ; ";
//echo $insert;die();
$ejec=mysqli_query($con,$insert);

$cot=mysqli_query($con,"SELECT MAX(id) as id  from empp_tb_compra");
$ids= mysqli_fetch_array($cot);

$idcompra=$ids['id'];
$productogrid=$_POST['productogrid'];
$totalgrid=$_POST['totalgrid'];
$preciunigrid=$_POST['preciunigrid'];
$ventaunigrid=$_POST['ventaunigrid'];
$cantidadgrid=$_POST['cantidadgrid'];
$pesogrid=$_POST['pesogrid'];
//
$descripciongrid=$_POST['descripciongrid'];
$dimensionesgrid=$_POST['dimensionesgrid'];
$epesorgrid=$_POST['epesorgrid'];
$largogrid=$_POST['largogrid'];
$anchogrid=$_POST['anchogrid'];

//$cant=$_POST['conteo'];
var_dump($largogrid);
$cont=0;
while ($cont < $contador) {
	$cantgrid=$cantidadgrid[$cont];
	$precigrid=$preciunigrid[$cont];
  $pesofgrid=$pesogrid[$cont];
  $ventafgrid=$ventaunigrid[$cont];
  //
  $dimensiongrid=$dimensionesgrid[$cont];
  $epesogrid=$epesorgrid[$cont];
  $larggrid=$largogrid[$cont];
  $anchgrid=$anchogrid[$cont];
  $descripgrid=$descripciongrid[$cont];
  //
	$togrid=$totalgrid[$cont];
	$prgrid=$productogrid[$cont];
// INSERT CABEBECERA


$insertmateria="INSERT INTO empp_tb_materia(id_compra,descripcion,     codigo,       dimensiones,    espesor,    ancho,    largo,   peso_cant,  v_unitario,  p_unitario,  v_total)
                                  VALUES('$idcompra','$descripgrid','$prgrid','$dimensiongrid',$epesogrid,$anchgrid,$larggrid,$pesofgrid,'$ventafgrid','$precigrid','$togrid')";	
                                       echo $insertmateria;die();						
$ejecdet=mysqli_query($con,$insertmateria);


$insertdet="INSERT INTO empp_tb_detalle_compra(id_compra,id_producto,peso,precio_unidad,venta_unidad,cantidad,total_subproducto,fecha)
                                        VALUES('$idcompra','$prgrid','$pesofgrid',$precigrid,$ventafgrid,$cantgrid,$togrid,NOW())";			
                                      //  echo $insertdet;die();						
$ejecdet=mysqli_query($con,$insertdet);
// UPDATE SELECT PARA EL ULTIMO VALOR DE CABECERA

$kar=mysqli_query($con,"SELECT id_produc, stock , fecha_mof from empp_tb_inventario where id_produc = $prgrid ");
$idss= mysqli_fetch_array($kar);
$stock=$idss['stock'];
$stock= $stock + $cantgrid;		
// UPDATE A LA TABLA INVENTARIO
$act="UPDATE empp_tb_inventario SET stock='$stock'  where id_produc='$prgrid' ";
$idses= mysqli_query($con,$act);

// INSERT A LA TABLA KARDEX
$insertkardex="INSERT INTO empp_tb_kardex(id_almacen,id_producto,fecha,cantidad,tipo,saldo)
                                        VALUES('1','$prgrid',NOW(),$cantgrid,'Ingreso', $stock)";									
$ejecdet=mysqli_query($con,$insertkardex);


$cont=$cont+1;


}

?>