function buscarfac(){
	var fac=$("#factura").val();
	$.ajax({
		type:'POST',
		url:'crud_guias.php',
		data:'funcion='+1+'&id='+fac,
		success:function(data){
			$("#dettable").append(data);
			//alert(data);
			console.log(data);
		}
	})
}
function genguia(){
	var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 5000 });
var factura      =$("#factura").val();
var partida      =$("#partida").val();
var llegada      =$("#llegada").val();
var fechasalih   =$("#fechasalih").val();
var fechasali    =$("#fechasali").val();
var ructranspor  =$("#ructranspor").val();
var transportista=$("#transportista").val();
var umedida      =$("#umedida").val();
var pesob        =$("#pesob").val();
var chofer       =$("#chofer").val();
var placa        =$("#placa").val();
var dni          =$("#dni").val();
var bevete       =$("#bevete").val();

if(factura==""){
Toast.fire({ icon:'error',title:'Debe de Ingresar el Nro de Factura'})
	return;
}
if(partida==""){
Toast.fire({ icon:'error',title:'Debe de Ingresar la Partida de Salida'})
	return;
}
if(llegada==""){
Toast.fire({ icon:'error',title:'Debe de Ingresar la LLegada'})
	return;
}
if(fechasalih==""){
Toast.fire({ icon:'error',title:'Debe de Ingresar la fecha y hora'})
	return;
}
if(fechasali==""){
Toast.fire({ icon:'error',title:'Debe de Ingresar la fecha '})
	return;
}
if(ructranspor==""){
Toast.fire({ icon:'error',title:'Debe de Ingresar el Ruc del Transportista'})
	return;
}
if(transportista==""){
Toast.fire({ icon:'error',title:'Debe de Ingresar el Transportista'})
	return;
}
if(umedida==""){
Toast.fire({ icon:'error',title:'Debe de Ingresar la Unidad de Medida'})
	return;
}
if(pesob==""){
Toast.fire({ icon:'error',title:'Debe de Ingresar el peso bruto'})
	return;
}
if(chofer==""){
Toast.fire({ icon:'error',title:'Debe de Ingresar el Nombre Completo del Chofer'})
	return;
}
if(placa==""){
Toast.fire({ icon:'error',title:'Debe de Ingresar la Placa del Vehiculo'})
	return;
}
if(dni==""){
Toast.fire({ icon:'error',title:'Debe de Ingresar el DNI del Chofer'})
	return;
}

if(bevete==""){
Toast.fire({ icon:'error',title:'Debe de Ingresar el Brevete del Chofer'})
	return;
}
	$.ajax({
		type: 'POST',
		url: 'crud_guias_det.php',
		data: $('#formguias').serialize(),
		// async: false,
		// contentType: false,
		// processData: false,
		success: function (respuesta) {
			//return;
			console.log(respuesta);
			var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 5000 });
			if (respuesta==1){
				Toast.fire({ icon: 'success', title: 'Se realizo la Cotizacion con Exito!!!, Gracias' })
				location.reload();
			}
			if (respuesta == '100') {
				Toast.fire({ icon: 'error', title: 'El Descuento no puede mayor que el total de la Cotizacion!!!.' })
			}
		}
	})
}

	function eliminar(index) {
		//alert(index);
		$("#fila" + index).remove();
	}