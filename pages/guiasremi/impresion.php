<?php
require('pdf/fpdf.php');
//require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
//require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
session_start();
$users=$_SESSION['user'];
$id=$_REQUEST['id'];
$con=mysqli_connect("a2plcpnl0863.prod.iad2.secureserver.net","bd_sistema","%Sistemas0rb1n3t@","siscontrol");
$consul="SELECT b.n_documento as factura,a.partida,a.llegada,a.fec_emision,a.fec_salida,a.ruc,a.transportista,a.medida,a.peso
,a.chofer,a.placa,a.dni,a.licencia,a.n_documento as guia,c.normalizado,c.unidad,c.cantidad,d.codigo_producto,e.n_doc,e.nombres,d.nombre as producto FROM empp_tb_guias_cab a
INNER JOIN empp_tb_factura_cab b on b.id_reg=a.id_factura
INNER JOIN empp_tb_guias_det c on c.id_cab=a.id_reg
INNER JOIN empp_tb_productos d on d.id_produc=c.codigo
INNER JOIN empp_tb_cliente e on e.id_reg=b.id_cliente
WHERE a.id_reg='$id'";
//var_dump($consul);die();
$lista= mysqli_query($con,$consul);
$listado=mysqli_fetch_array($lista);
//var_dump($listado);die();
$vendedor= mysqli_query($con,"SELECT * FROM empp_tb_users where username='$users'");
$venbd=mysqli_fetch_array($vendedor);
$venta=$venbd['name'];
$coti         =$listado['guia'];
$factura      =$listado['factura'];
$partida      =$listado['partida'];
$llegada      =$listado['llegada'];
$fec_emision  =$listado['fec_emision'];
$ncoti        =$listado['fec_salida'];
$ruc          =$listado['ruc'];
$transportista=$listado['transportista'];
$medida       =$listado['medida'];
$peso         =$listado['peso'];
$chofer       =$listado['chofer'];
$placa        =$listado['placa'];
$dni          =$listado['dni'];
$licencia     =$listado['licencia'];
$ruc_cli     =$listado['n_doc'];
$cliente     =$listado['nombres'];
$producto     =$listado['producto'];

//var_dump($llegada);die();


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
	global $coti;
  global $factura;
  global $partida;
  global $llegada;
  global $fec_emision;
  global $ncoti;
  global $ruc;
  global $transportista;
  global $medida;
  global $peso;
  global $chofer;
  global $placa;
  global $dni;
  global $licencia;
  global $ruc_cli;
  global $cliente;
    // Logo
    $this->Image('logo_acerperu.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->SetX(147);
      $this->SetFillColor(139,0,0);
    $this->SetTextColor(0,0,0);
    $this->SetX(147);
    $this->Cell(57,10,'GUIA DE REMISION',0,1,'L');
    $this->SetTextColor(255,255,255);
    $this->SetX(147);
    $this->Cell(57,10,'RUC: 20609324369',1,1,'L',TRUE);
    $this->SetTextColor(0,0,0);
    $this->SetX(147);
    $this->Cell(57,10,$coti,1,1,'L');

    //$this->Cell(30,10,'Cliente'.$cli,0,1,'C');
    //$this->Ln(-8);    
    $this->SetXY(50,25);
    $this->SetFont('Arial','BI',15);
    $this->MultiCell(60,6,'ACEROS Y PERFILES PERUANOS S.A.C',0,'C');
    $this->SetFont('Arial','B',9);
    $this->Ln(2);
    $this->SetX(51);
    $this->MultiCell(100,3,utf8_decode('Dirección: Mz C Lote 35 Asoc Los Rosales de Chillon - Carabayllo - Lima - Lima'),0,'L');
    //$this->Ln(-10);
    $this->SetX(148);
    $this->Cell(30,3,'Celular: 955-188-891',0,1,'C');
    $this->SetX(160);
    $this->Cell(30,10,'Correo :alberto.apaza97@gmail.com',0,1,'C');
    $this->SetFont('Arial','BI',10);
    $this->Ln(-12);
    $this->SetX(51);
    $this->Cell(30,10,utf8_decode('"ACERPERU Tu aliado para la construcción"'),0,1,'L');
    $this->Cell(30,10,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",0,1,'C');
    $this->SetX(10);
    $this->Cell(30,5,utf8_decode('Punto de Partida:  '),0,0,'L');
    $this->SetX(42);
    $this->MultiCell(130,5,utf8_decode($partida),0,'L');
    $this->SetX(10);
    $this->Cell(30,5,utf8_decode('Punto de LLegada:  '),0,0,'L');
    $this->SetX(42);
    $this->MultiCell(130,5,utf8_decode($llegada),0,'L');
    $this->SetXY(10,65);
    $this->Cell(193,22,'',1,1,'L');
    //$this->Ln(60);
    //$this->SetX(10);
    $this->Cell(30,5,utf8_decode('DATOS DEL DESTINATARIO'),0,1,'L');
    $this->Cell(30,5,'Razon Social :',0,0,'L');
    $this->MultiCell(70,5,utf8_decode($cliente),0,'L');
    $this->Cell(30,5,'RUC :',0,0,'L');
    $this->Cell(30,5,$ruc_cli,0,1,'L');
    $this->SetXY(10,88);
    $this->Cell(100,20,'',1,1,'L');
    $this->SetXY(113,88);
    $this->Cell(90,8,'Numero de Comprobante de Pago : '.$factura,1,1,'L');
    $this->SetXY(113,98);
    $this->Cell(30,5,'DATOS DEL TRANSPORTISTA',0,1,'L');
    $this->SetXY(113,102);
    $this->Cell(30,5,utf8_decode('Razon Social:'),0,0,'L');
    $this->MultiCell(50,5,utf8_decode($transportista),0,'L');
    $this->SetX(113);
    $this->Cell(30,5,utf8_decode('RUC:'),0,0,'L');
    $this->Cell(30,5,$ruc,0,1,'L');
    $this->SetX(113);
    $this->Cell(40,5,utf8_decode('Licencia de Conducir:'),0,0,'L');
    $this->Cell(30,5,utf8_decode($licencia),0,1,'L');
    $this->SetX(113);
    $this->Cell(40,5,utf8_decode('Placa de Vehiculo:'),0,0,'L');
    $this->Cell(30,5,utf8_decode($placa),0,1,'L');
    $this->SetX(113);
    $this->Cell(30,5,utf8_decode('Chofer:'),0,0,'L');
    $this->MultiCell(70,5,utf8_decode($chofer),0,'L');
    //$this->Cell(30,5,utf8_decode('Cert. de Inscripcion:'),0,0,'L');
    $this->SetXY(10,111);
    $this->Cell(30,5,utf8_decode('MOTIVO DE TRASLADO'),0,1,'L');
    $this->Cell(30,5,utf8_decode('1. Venta'),0,0,'L');
    $this->Cell(5,5,utf8_decode('X'),1,1,'C');
    $this->Cell(30,5,utf8_decode('2. Compra'),0,0,'L');
    $this->Cell(5,5,utf8_decode(''),1,1,'C');
    $this->Cell(30,5,utf8_decode('3. Otros'),0,0,'L');
    $this->Cell(5,5,utf8_decode(''),1,0,'C');
    $this->SetXY(10,110);
    $this->Cell(100,25,'',1,0,'L');
    $this->SetXY(113,98);
    $this->Cell(90,37,'',1,1,'L');
    //$this->Ln(12);
    //$this->SetX(10);
    //$this->Cell(30,5,utf8_decode('Ejecutivo de Ventas:'),0,0,'L');
    //$this->SetX(145);
    //$this->Cell(30,5,utf8_decode('Forma de Pago:'),0,0,'L');
    //$this->Cell(30,5,utf8_decode('Contado'),0,1,'L');
    $this->Cell(30,10,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",0,1,'C');
    $this->SetFont('Arial','BI',9);
    $this->SetFillColor(139,0,0);
    $this->SetTextColor(255,255,255);
    $this->Cell(10,10,utf8_decode('ITEM'),1,0,'L',true);
    $this->Cell(30,10,utf8_decode('CODIGO'),1,0,'L',true);
    $this->Cell(20,10,utf8_decode('CANTIDAD'),1,0,'L',true);
    $this->Cell(25,10,utf8_decode('UNIDAD'),1,0,'L',true);
    $this->Cell(93,10,utf8_decode('DESCRIPCIÓN'),1,0,'L',true);
    $this->Cell(15,10,utf8_decode('PESO'),1,1,'L',true);
    $this->SetTextColor(0,0,0);
    // Salto de línea
    $this->Ln(5);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    // $this->SetFont('Arial','',9);
    // $this->SetY(210);
    // $this->Cell(40,4,utf8_decode('Condiciones Comerciales'),0,1,'L');
    // $this->Cell(40,4,utf8_decode('1.Validez de la oferta 1 día.'),0,1,'L');
    // $this->Cell(40,4,utf8_decode('2.LA MERCADERIA VIAJA POR CUENTA Y RIESGO DEL COMPRADOR.'),0,1,'L');
    // $this->Cell(40,4,utf8_decode('3.Los pesos indicados son aproximados.'),0,1,'L');
    // $this->Cell(40,4,utf8_decode('4.La cotización esta sujeta a variación sin previo aviso.'),0,1,'L');
    // $this->Cell(40,4,utf8_decode('5.Fabricación de medida especial, el pago se hará al contado adelantado.'),0,1,'L');
    // $this->Cell(40,4,utf8_decode('6.Despacho minimo 5 toneladas.'),0,1,'L');
    // $this->Cell(40,4,utf8_decode('7.El pago en soles se hará de acuerdo al tipo de cambio comercial del dia del depósito.'),0,1,'L');
    // $this->Cell(40,4,utf8_decode('8.No se aceptan devoluciones pasados 2 días de entrega al cliente.'),0,1,'L');
    // $this->Cell(40,4,utf8_decode('9.Los despachos son sólo en lima metropolitana.'),0,1,'L');
    // $this->Cell(40,4,utf8_decode('10.Tiempo de espera en agencia sólo una hora. En caso de no ser atendido se cobrará el flete al cliente.'),0,1,'L');
    // $this->Ln(3);
    // $this->SetFillColor(64,98,163);
    // $this->SetTextColor(255,255,255);
    // $this->SetFont('Arial','BI',9);
    // $this->Cell(85,4,utf8_decode('Cuentas Bancarias'),1,1,'C',true);
    // $this->SetTextColor(0,0,0);
    // $this->Cell(40,4,utf8_decode('BCP SOLES'),1,0,'L');
    // $this->Cell(45,4,utf8_decode('193-2681454-0-92'),1,1,'L');
    // $this->Cell(40,4,utf8_decode('CCI BCP SOLES'),1,0,'L');
    // $this->Cell(45,4,utf8_decode('002-193-00-2681454-0-9213'),1,1,'L');
    // $this->Ln(3);
    // $this->Cell(40,4,utf8_decode('BCP DOLARES'),1,0,'L');
    // $this->Cell(45,4,utf8_decode('193-2669329-1-27'),1,1,'L');
    // $this->Cell(40,4,utf8_decode('CCI BCP DOLARES'),1,0,'L');
    // $this->Cell(45,4,utf8_decode('002-193-00-2669329-1-2715'),1,1,'L');
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',8);
$cont=1;
$conta=1;
foreach ($lista as $values) {
$cont++;

$pdf->Cell(10,5,$conta++,0,0,'L');
$pdf->Cell(30,10,utf8_decode(''),0,0,'L');
$pdf->Cell(20,5,utf8_decode($values['cantidad']),0,0,'L');
$pdf->Cell(25,5,utf8_decode($values['unidad']),0,0,'L');
$pdf->Cell(93,5,utf8_decode($values['producto']),0,0,'L');
$pdf->Cell(15,10,utf8_decode($values['peso']),0,1,'L');

//$pdf->Cell(15,5,utf8_decode($values['normalizado']),0,0,'L');
//$pdf->Cell(18,5,utf8_decode($values['precio']),0,0,'L');
$pdf->setX(10);
$pdf->Cell(30,1,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",0,1,'L');
if($cont>15) {
    $pdf->AddPage();
    $cont=1;
}
}
// $pdf->SetFont('Times','B',8);
// $pdf->SetFillColor(64,98,163);
// $pdf->SetTextColor(255,255,255);
// $pdf->Cell(10,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(20,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(15,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(69,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(12,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(15,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(15,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(18,5,utf8_decode('Sub Total'),1,0,'L',true);
// $pdf->SetTextColor(0,0,0);
// $pdf->Cell(18,5,$subtotal,1,1,'R');
// $pdf->Cell(10,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(20,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(15,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(69,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(12,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(15,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(15,5,utf8_decode(''),0,0,'L');
// $pdf->SetTextColor(255,255,255);
// $pdf->Cell(18,5,utf8_decode('IGV'),1,0,'L',true);
// $pdf->SetTextColor(0,0,0);
// $pdf->Cell(18,5,number_format($igv,2,',',''),1,1,'R');
// $pdf->Cell(10,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(20,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(15,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(69,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(12,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(15,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(15,5,utf8_decode(''),0,0,'L');
// $pdf->SetTextColor(255,255,255);
// $pdf->Cell(18,5,utf8_decode('Total $$'),1,0,'L',true);
// $pdf->SetTextColor(0,0,0);
// //$pdf->Cell(18,5,number_format($totdolar,2,',',''),1,1,'R');
// $pdf->Cell(10,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(20,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(15,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(69,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(12,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(15,5,utf8_decode(''),0,0,'L');
// $pdf->Cell(15,5,utf8_decode(''),0,0,'L');
// $pdf->SetTextColor(255,255,255);
// $pdf->Cell(18,5,utf8_decode('Total S/.'),1,0,'L',true);
// $pdf->SetTextColor(0,0,0);
// $pdf->Cell(18,5,number_format($totalf,2,',',''),1,1,'R');
$pdf->Output();
?>