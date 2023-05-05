<?php 
  require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
  $fun=$_POST['funcion'];
  $id=$_POST['id'];

  if ($fun==1) {
  		// buscar cliente
	$return_arr = array();
	$buscar= mysqli_query($con,"SELECT id_reg,n_doc,nombres,estado,direccion,telefono FROM empp_tb_cliente WHERE estado='1' and n_doc='$id'");
    	while ($row = mysqli_fetch_array($buscar)) {
		$row_array['id']=$row['id_reg'];
		$row_array['nombres']=$row['nombres'];
		$row_array['doc']=$row['n_doc'];
		$row_array['dir']=$row['direccion'];
		$row_array['telef']=$row['telefono'];
		array_push($return_arr,$row_array);
    }
   echo json_encode($return_arr);
  }else if ($fun==2) {
  		// buscar productos
	$return_arr = array();
	$buscar= mysqli_query($con,"SELECT a.id_produc,a.codigo_producto,a.id_categoria,a.id_sub_categoria,a.nombre,a.estado,a.espesor,a.alto,a.ancho,a.precio_compra,a.precio_venta, CASE WHEN b.stock is NULL then '0' WHEN b.stock='' then '0' else b.stock end stock,a.peso FROM empp_tb_productos a left join empp_tb_inventario b on b.id_produc=a.id_produc WHERE a.estado='1' and a.codigo_producto='$id'");
    	while ($row = mysqli_fetch_array($buscar)) {
		$row_array['id']=$row['id_produc'];
		$row_array['codigo']=$row['codigo_producto'];
		$row_array['nombres']=$row['nombre'];
		$row_array['cat']=$row['id_categoria'];
		$row_array['scat']=$row['id_sub_categoria'];
		$row_array['estado']=$row['estado'];
		$row_array['espesor']=$row['espesor'];
		$row_array['alto']=$row['alto'];
		$row_array['ancho']=$row['ancho'];
		$row_array['compra']=$row['precio_compra'];
		$row_array['venta']=$row['precio_venta'];
		$row_array['stock']=$row['stock'];
        $row_array['peso']=$row['peso'];
		array_push($return_arr,$row_array);
    }
   echo json_encode($return_arr);
  }else if ($fun==3) {
  		// INSERTAR FACTURA Y DETALLE
  	//--CAB
  	$usrs=mysqli_query($con,"SELECT id  from empp_tb_users where username='admin'");
  	$vend= mysqli_fetch_array($usrs);
  	$ids=$vend['id'];
  	$corre=mysqli_query($con,"SELECT numero  from empp_tb_correlativo where usuario='admin' and documento='Factura'");
  	$num= mysqli_fetch_array($corre);
  	$nro=intval($num['numero'])+intval(1);
  	$docu="FV0".$ids."-".str_pad($nro, 8, "0", STR_PAD_LEFT);
  	//INICIO INSERT CABECERA
  	$cab="INSERT INTO empp_tb_factura_cab (tipo_doc,fecha_reg,id_cliente,monto,n_documento,descuento,observacion,id_usuario,precio_texto,estado,id_coti,igv_valor,total_valor,moneda_cambio) 
  	SELECT tipo_doc,NOW(),id_cliente,monto,'$docu',descuento,observacion,id_usuario,precio_texto,estado,'$id',((precio_texto*18)/100) as igv,
  	 (((precio_texto*18)/100)+ precio_texto) as totalfin,moneda_cambio from empp_tb_cotizacion WHERE id_reg='$id'";
  	$ejeccab=mysqli_query($con,$cab);

  	//--DET
  	$facts=mysqli_query($con,"SELECT MAX(id_reg) as ids  from empp_tb_factura_cab");
  	$factsx= mysqli_fetch_array($facts);
  	$idsx=$factsx['ids'];
  	$det="INSERT INTO empp_tb_factura_det (id_regcab,id_producto,cantidad,precio,total,fecha_reg,descuento,precio_texto,estado) SELECT '$idsx',id_producto,cantidad,precio,total,NOW(),descuento,precio_texto,estado from empp_tb_cotizacion_det WHERE id_regcab='$id'";
  	//var_dump($det);die();
  	$ejecdet=mysqli_query($con,$det);
  	//ACT ESTADO COTIZACION
  	$upd="UPDATE empp_tb_cotizacion set estado='3' where id_reg='$id'";
  	$ejecupd=mysqli_query($con,$upd);
  	$upd="UPDATE empp_tb_correlativo set numero='$nro' where usuario='admin' and documento='Factura'";
  	$ejecupd=mysqli_query($con,$upd);
  	 if (mysqli_affected_rows($con)!=0) {

  	 	$detalles="SELECT c.codigo_producto,c.nombre,b.cantidad,b.precio,b.total,a.precio_texto,a.igv_valor,a.total_valor,a.descuento,d.nombres,d.n_doc,b.precio_texto as precio_detalle FROM empp_tb_factura_cab a
  	 	INNER JOIN empp_tb_factura_det b on b.id_regcab=a.id_reg
  	 	INNER JOIN empp_tb_productos c on c.id_produc=b.id_producto
  	 	INNER JOIN empp_tb_cliente d on d.id_reg=a.id_cliente
  	 	WHERE a.id_coti='$id'";
  	 	$exec_det=mysqli_query($con,$detalles);
  	 	$dets=mysqli_fetch_array($exec_det);

  	 	$cliente=$dets['nombres'];
  	 	$ruclis=$dets['n_doc'];
  	 	$tipoc="6";
  	 	$codfiscal="013";


  	 	$subtotalcab=$dets['precio_texto'];
  	 	$igvcab=$dets['igv_valor'];
  	 	$descuento= $dets['descuento'];
  	 	$totalcab= $dets['total_valor'];

  	 	$doct='01';
  	 	$P="|";
      $codigodigito = "1000";
      $textoigv = "IGV";
      $codigoigv = "10";
      $vat = "VAT";
  	 	$nombre_archivo= "20550633621-".$doct."-".$docu;
  	 	$ruta_servidor = "C:\SFS_v1.3.4.2\sunat_archivos\sfs\DATA\\";
  	 	$ruta_archivo['info'][1]['ruta'] =$ruta_servidor.$nombre_archivo.".det";
  	 	$ruta_archivo['info'][1]['data'] = "";

  	 	foreach ($exec_det as $values) {
  	 	$cantidad=$values['cantidad'];
  	 	$subtotaldet=$values['total']; // precio unitario con descuento incluido
        $prec=$values['precio_detalle']; // precio unitario * cantidad sin igv
  	 	$igvsbtotaldet=((floatval($subtotaldet)*18)/100); // igv unitario
  	 	$totaldet= floatval($subtotaldet)+ floatval($igvsbtotaldet); // precio total unitario con igv

  	 	$subtotalparafe=number_format($values['total'],2,'.','');
            $subtotal = number_format($values['total'],2,'.','');
		    $igv = (($subtotal * 18 ) / 100) * $cantidad;	
			$igv = number_format($igv,2,'.','');
            $precigv=(floatval($subtotaldet)+floatval($igvsbtotaldet));


  	 	$ruta_archivo['info'][1]['data'] .=
        "NIU".$P. //Unidad de medida
	    $values['cantidad'].$P. // Cantidad
	    "cod01".$P. // Codigo Producto 
	    "-".$P. // Codigo Producto Sunat --
	    trim($values['nombre']).$P. // Descripcion
	    $subtotaldet.$P. // Valor Unitario (Sin IGV) pero multiplicado por la cantidad
	    $igv.$P. // Sumatorio Tributo  9+16+26
	    $codigodigito.$P. //Codigo Tipo Triburo Catalogo N° 5
	    $igv.$P. // Monto Total IGV por item 
	    $prec.$P. // Tributo: Base Imponible IGV por Item
	    $textoigv.$P. // Nombre Tributo Catalogo N° 5
	    $vat.$P. // Codigo Tributo Catalogo N° 5
	    $codigoigv.$P. // Catalogo N° 7 
	    "18".$P. // 
	    "-".$P. // Codigo Tipo ISC Catalogo N° 5 (si no es afecto "-") y valores vacios
	    "".$P. // Monto de ISC por ítem
	    "".$P. // Monto de ISC por ítem
	    "".$P. // Nombre de tributo por item Catalogo N° 5
	    "".$P. // Código de tipo de tributo por Item Catalogo N° 5
	    "".$P. // Tipo de sistema ISC Catalogo N° 8
	    "".$P. // Porcentaje de ISC por Item (normalmente 15.00)
	    "-".$P. // Codigo Tipo Otros Catalogo N° 5 (si no es afecto "-") y valores vacios
	    "".$P. // Monto de tributo OTRO por iItem
	    "".$P. // Base Imponible de tributo OTRO por Item
	    "".$P. // Nombre de tributo OTRO por item Catalogo N° 5
	    "".$P. // Código de tipo de tributo OTRO por Item Catalogo N° 5
	    "".$P. // Porcentaje de tributo OTRO por Item (normalmente 15.00)
      "-".$P. // ICBPER
      "".$P. // ICBPER
      "".$P. // ICBPER
      "".$P. // ICBPER
      "".$P. // ICBPER
      "".$P. // ICBPER
	    $precigv.$P. // Precio unitario (incluye IGV-ISC-OTROS)
	    $prec.$P.//number_format($total,2,'.','').$P. // Precio unitario por item * Cantidad (sin igv)
	    "0.00".$P."\n"; //Valor REFERENCIAL unitario (gratuitos)
	  }
	  $ruta_archivo['info'][0]['ruta'] =$ruta_servidor.$nombre_archivo.".cab";
	  $ruta_archivo['info'][0]['data'] =
	  "0101".$P. //tipo operacion Catalogo N° 51
	  date("Y-m-d").$P. //Fecha de emision
	  date("H:m:s").$P. //Hora de emision
	  "-".$P. //Fecha de vencimiento (no obligatorio "-")
	  $codfiscal.$P. //codigo de domicilioFiscal
	  $tipoc.$P. //Tipo documento Identidad Catalogo N° 6
	  $ruclis.$P. // Numero de documento
	  $cliente.$P. // Nombre de usuario
	  "PEN".$P. // Tipo moneda Catalogo N° 2
	  $igvcab.$P. //Sumatoria de tributo
	  $subtotalcab.$P. // Total Valor Venta (total sin igv)
	  $totalcab.$P. //TOTAL (incluye IGV)
	  $descuento.$P. // Total descuentos
	  "0".$P. // Sumatoria otros Cargos
	  "0".$P. // Total Anticipos
	  $totalcab.$P. //TOTAL - descuento + Otros cargos - Anticipos
	  "2.1".$P. // Version UBL
	  "2.0".$P; // Customization

	  $resultado = str_replace(",", "", $totalcab);
	  $ruta_archivo['info'][2]['ruta'] =$ruta_servidor.$nombre_archivo.".ley";
	  $ruta_archivo['info'][2]['data'] =
	  "1000".$P. //Código de leyenda
	  numtoletras(number_format($resultado,2,'.','')).$P; //Descripcion de leyenda

   $ruta_archivo['info'][3]['ruta'] =$ruta_servidor.$nombre_archivo.".tri";
   $ruta_archivo['info'][3]['data'] =
   "1000".$P. // Identificador de Tributo Catalogo N° 5
   "IGV".$P. // Nombre de tributo Catalogo N° 5
   "VAT".$P. // Codigo de Tributo Catalogo N°5
   $subtotalcab.$P. // Base Inponible
   $igvcab.$P;// Monto Tributo por Item;


                            foreach ($ruta_archivo['info'] as $key => $value) {
                            if($archivo = fopen($value['ruta'] , "w+")) {
                                fwrite($archivo,"");
                                if(fwrite($archivo, $value['data'])) {
                                    $respo = true;
                                } else {
                                    $respo =false;
                                    break;
                                }
                                fclose($archivo);
                            }  
                        }
	 echo "1";
	 }else{
	 	echo "2";
	 }

  }else if ($fun==4) {
  		// ANULAR COTIZACIONES

  	$upd="UPDATE empp_tb_cotizacion set estado='2' where id_reg='$id'";
  	$ejecupd=mysqli_query($con,$upd);
  	 if (mysqli_affected_rows($con)!=0) {
	 echo "1";
	 }else{
	 	echo "2";
	 }

  }else if ($fun==5) {
  	 		// INSERTAR FACTURA Y DETALLE
  	//--CAB
  	$usrs=mysqli_query($con,"SELECT id  from empp_tb_users where username='admin'");
  	$vend= mysqli_fetch_array($usrs);
  	$ids=$vend['id'];
  	$corre=mysqli_query($con,"SELECT numero  from empp_tb_correlativo where usuario='admin' and documento='OPedido'");
  	$num= mysqli_fetch_array($corre);
  	$nro=intval($num['numero'])+1;
  	$docu="OP0".$ids."-".str_pad($nro, 8, "0", STR_PAD_LEFT);
  	$cab="INSERT INTO empp_tb_ordenpedido_cab (tipo_doc,fecha_reg,id_cliente,monto,n_documento,descuento,observacion,id_usuario,precio_texto,estado,id_coti) SELECT tipo_doc,NOW(),id_cliente,monto,'$docu',descuento,observacion,id_usuario,precio_texto,estado,'$id' from empp_tb_cotizacion WHERE id_reg='$id'";
  	$ejeccab=mysqli_query($con,$cab);
  	//--DET
  	$facts=mysqli_query($con,"SELECT MAX(id_reg) as ids  from empp_tb_ordenpedido_cab");
  	$factsx= mysqli_fetch_array($facts);
  	$idsx=$factsx['ids'];
  	$det="INSERT INTO empp_tb_ordenpedido_det (id_regcab,id_producto,cantidad,precio,total,fecha_reg,descuento,precio_texto,estado) SELECT '$idsx',id_producto,cantidad,precio,total,NOW(),descuento,precio_texto,estado from empp_tb_cotizacion_det WHERE id_regcab='$id'";
  	$ejecdet=mysqli_query($con,$det);
  	//ACT ESTADO COTIZACION
  	$upd="UPDATE empp_tb_cotizacion set estado='4' where id_reg='$id'";
  	$ejecupd=mysqli_query($con,$upd);
  	 if (mysqli_affected_rows($con)!=0) {
	 echo "1";
	 }else{
	 	echo "2";
	 }
  }

  function numtoletras($xcifra)
    {
        $xarray = array(0 => "Cero",
            1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
            "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
            "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
            100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
        );
    //
        $xcifra = trim($xcifra);
        $xlength = strlen($xcifra);
        $xpos_punto = strpos($xcifra, ".");
        $xaux_int = $xcifra;
        $xdecimales = "00";
        if (!($xpos_punto === false)) {
            if ($xpos_punto == 0) {
                $xcifra = "0" . $xcifra;
                $xpos_punto = strpos($xcifra, ".");
            }
            $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
            $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
        }
        $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
        $xcadena = "";
        for ($xz = 0; $xz < 3; $xz++) {
            $xaux = substr($XAUX, $xz * 6, 6);
            $xi = 0;
            $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
            $xexit = true; // bandera para controlar el ciclo del While
            while ($xexit) {
                if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                    break; // termina el ciclo
                }
                $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
                $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
                for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                    switch ($xy) {
                        case 1: // checa las centenas
                            if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                                
                            } else {
                                $key = (int) substr($xaux, 0, 3);
                                if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                    $xseek = $xarray[$key];
                                    $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                    if (substr($xaux, 0, 3) == 100)
                                        $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                    else
                                        $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                    $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                                }
                                else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                    $key = (int) substr($xaux, 0, 1) * 100;
                                    $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                } // ENDIF ($xseek)
                            } // ENDIF (substr($xaux, 0, 3) < 100)
                            break;
                        case 2: // checa las decenas (con la misma lógica que las centenas)
                            if (substr($xaux, 1, 2) < 10) {
                                
                            } else {
                                $key = (int) substr($xaux, 1, 2);
                                if (TRUE === array_key_exists($key, $xarray)) {
                                    $xseek = $xarray[$key];
                                    $xsub = subfijo($xaux);
                                    if (substr($xaux, 1, 2) == 20)
                                        $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                    else
                                        $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                    $xy = 3;
                                }
                                else {
                                    $key = (int) substr($xaux, 1, 1) * 10;
                                    $xseek = $xarray[$key];
                                    if (20 == substr($xaux, 1, 1) * 10)
                                        $xcadena = " " . $xcadena . " " . $xseek;
                                    else
                                        $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                                } // ENDIF ($xseek)
                            } // ENDIF (substr($xaux, 1, 2) < 10)
                            break;
                        case 3: // checa las unidades
                            if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                                
                            } else {
                                $key = (int) substr($xaux, 2, 1);
                                $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                                $xsub = subfijo($xaux);
                                $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                            } // ENDIF (substr($xaux, 2, 1) < 1)
                            break;
                    } // END SWITCH
                } // END FOR
                $xi = $xi + 3;
            } // ENDDO
            if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
                $xcadena.= " DE";
            if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
                $xcadena.= " DE";
            // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
            if (trim($xaux) != "") {
                switch ($xz) {
                    case 0:
                        if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                            $xcadena.= "UN BILLON ";
                        else
                            $xcadena.= " BILLONES ";
                        break;
                    case 1:
                        if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                            $xcadena.= "UN MILLON ";
                        else
                            $xcadena.= " MILLONES ";
                        break;
                    case 2:
                        if ($xcifra < 1) {
                            $xcadena = "CERO CON $xdecimales/100 SOLES";
                        }
                        if ($xcifra >= 1 && $xcifra < 2) {
                            $xcadena = "UNO CON $xdecimales/100 SOLES";
                        }
                        if ($xcifra >= 2) {
                            $xcadena.= "CON $xdecimales/100 SOLES"; //
                        }
                        break;
                } // endswitch ($xz)
            } // ENDIF (trim($xaux) != "")
            // ------------------      en este caso, para México se usa esta leyenda     ----------------
            $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
            $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
            $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
            $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
            $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
            $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
            $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
        } // ENDFOR ($xz)
        return trim($xcadena);
    }

    function subfijo($xx)
    { // esta función regresa un subfijo para la cifra
        $xx = trim($xx);
        $xstrlen = strlen($xx);
        if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
            $xsub = "";
        //
        if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
            $xsub = "MIL";
        //
        return $xsub;
    }
?>