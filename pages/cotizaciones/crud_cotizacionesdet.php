<?php 
session_start();
  require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
$users=$_SESSION['user'];
$ruc=$_POST['ruc'];
$totalf=$_POST['totalf'];
$descuento=$_POST['descuento'];
$dolar=$_POST['dolar'];
// if ($totalf<$descuento) {
// 	echo "100";die();
// }
$totf=floatval($totalf)-floatval($descuento);

$totaldolar=floatval($totalf)/floatval($dolar);

$to=number_format($totf, 2, '.', ',');
$empresa=mysqli_query($con,"SELECT *  from empp_tb_cliente where n_doc='$ruc'");
$id= mysqli_fetch_array($empresa);

$corre=mysqli_query($con,"SELECT numero  from empp_tb_correlativo where usuario='admin' and documento='Cotizaciones'");
$num= mysqli_fetch_array($corre);
$nro=intval($num['numero'])+1;
$docu="COT-".str_pad($nro, 8, "0", STR_PAD_LEFT);
$cliente=$id['id_reg'];
$insert="INSERT INTO empp_tb_cotizacion(tipo_doc,fecha_reg,id_cliente,monto,n_documento,descuento,observacion,id_usuario,precio_texto,estado,dolar,moneda_cambio)
VALUES('1',NOW(),'$cliente','$totalf','$docu','$descuento','NINGUNO','$users','$totalf','1','$totaldolar','$dolar')";
$ejec=mysqli_query($con,$insert);

$cot=mysqli_query($con,"SELECT MAX(id_reg) as id  from empp_tb_cotizacion");
$ids= mysqli_fetch_array($cot);
$idcot=$ids['id'];

$codigo =$_POST['codigodetalle'];
$cant   =$_POST['cantidaddetalle'];
$precio =$_POST['preciovdetalle'];
$dsctos =$_POST['dsctodetalle'];
$preciof=$_POST['preciofdetalle'];
$total  =$_POST['totaldetalle'];
$cont=0;

while ($cont < count($cant)) {
	$canti=$cant[$cont]; //cantidad
	$prec=$precio[$cont]; //precio inicial
	$tot=$total[$cont];  //precio totalizado
	$cod=$codigo[$cont]; //codigo
	$dsct=$dsctos[$cont]; //codigo
	$precfin=$preciof[$cont]; //codigo
	//$texto=number_format($tot, 2, '.', ',');

	$prod=mysqli_query($con,"SELECT *  from empp_tb_productos where codigo_producto='$cod'");
$idprod= mysqli_fetch_array($prod);
$producto=$idprod['id_produc'];

$insertdet="INSERT INTO empp_tb_cotizacion_det(id_regcab,id_producto,cantidad,precio,total,fecha_reg,descuento,precio_texto,estado)
VALUES('$idcot','$producto',$canti,$prec,$precfin,NOW(),'$dsct','$tot','1')";
$ejecdet=mysqli_query($con,$insertdet);
$cont=$cont+1;
}
$act="UPDATE empp_tb_correlativo SET numero='$nro' where usuario='admin' and documento='Cotizaciones'";
$actx= mysqli_query($con,$act);

 if (mysqli_affected_rows($con)!=0) {
	 echo "1";
	 }else{
	 	echo "2";
	 }
?>