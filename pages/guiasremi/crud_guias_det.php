<?php 
session_start();
  require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
$users=$_SESSION['user'];
$factura      =$_POST['factura'];
$partida      =$_POST['partida'];
$llegada      =$_POST['llegada'];
//$fechasalih   =$_POST['fechasalih'];
//$fechasali    =$_POST['fechasali'];
$ructranspor  =$_POST['ructranspor'];
$transportista=$_POST['transportista'];
$umedida      =$_POST['umedida'];
$pesob        =$_POST['pesob'];
$chofer       =$_POST['chofer'];
$placa        =$_POST['placa'];
$dni          =$_POST['dni'];
$bevete       =$_POST['bevete'];



$corre =mysqli_query($con,"SELECT numero  from empp_tb_correlativo where usuario='admin' and documento='Guias'");
$num   = mysqli_fetch_array($corre);
$nro   =intval($num['numero'])+1;
$docu  ="GR-07".str_pad($nro, 8, "0", STR_PAD_LEFT);
$insert="INSERT INTO empp_tb_guias_cab(id_factura,partida,llegada,fec_emision,fec_salida,ruc,transportista,medida,peso,chofer,placa,dni,licencia,n_documento)
VALUES('$factura','$partida','$llegada',NOW(),NOW(),'$ructranspor','$transportista','$umedida','$pesob','$chofer','$placa','$dni','$bevete','$docu')";
$ejec=mysqli_query($con,$insert);

$cot  =mysqli_query($con,"SELECT MAX(id_reg) as id  from empp_tb_guias_cab");
$ids  = mysqli_fetch_array($cot);
$idguias=$ids['id'];

$idfactdet  =$_POST['ids'];//det fact
$codprod    =$_POST['cod_prod'];
$nombresprod=$_POST['nombres'];
$canti      =$_POST['cantidades'];

$cont=0;
while ($cont < count($canti)) {
	$cantid=$canti[$cont];
	$iddet=$idfactdet[$cont];
	$codp=$codprod[$cont];
	$nombp=$nombresprod[$cont];

$prod=mysqli_query($con,"SELECT *  from empp_tb_productos where codigo_producto='$codp'");
$idprod= mysqli_fetch_array($prod);
$producto=$idprod['id_produc'];

$insertdet="INSERT INTO empp_tb_guias_det(id_cab,normalizado,codigo,unidad,cantidad)
VALUES('$idguias','NO','$producto','UNIDAD (ZZ)','$cantid')";
$ejecdet=mysqli_query($con,$insertdet);

$actdet="UPDATE empp_tb_factura_det SET estado='2' where id_reg='$iddet'";
$actdetx= mysqli_query($con,$actdet);
$cont=$cont+1;
}
$act="UPDATE empp_tb_correlativo SET numero='$nro' where usuario='admin' and documento='Guias'";
$actx= mysqli_query($con,$act);



 if (mysqli_affected_rows($con)!=0) {
	 echo "1";
	 }else{
	 	echo "2";
	 }
?>