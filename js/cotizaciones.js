function generarfacf(id,tipo){
	window.open("../facturacion/impresion.php?id=" + id+"&tipo="+tipo, "ventana1", "width=600,height=450,scrollbars=NO")
}
function generaropf(id){
	window.open("../ordenpedido/impresiones.php?id=" + id, "ventana1", "width=600,height=450,scrollbars=NO")
}
function imprimircot(id) {

	window.open("impresiones.php?id=" + id, "ventana1", "width=600,height=450,scrollbars=NO")
}
function buscarcli() {
	var ruc = $("#ruc").val();
	$.ajax({
		type: "POST",
		url: "crud_cotizaciones.php",
		data: "funcion=" + 1 + "&id=" + ruc,
		dataType: "JSON",
		success: function (data) {
			var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 5000 });
			console.log(data);

			//var datos=data[0]['doc'];
			if (data != '') {
				$("#ruc").val(data[0]['doc']);
				$("#empresa").val(data[0]['nombres']);
				$("#direc").val(data[0]['dir']);
				$("#telef").val(data[0]['telef']);
			} else {
				Toast.fire({ icon: 'error', title: 'No se encontro Cliente o No Existe, Verifique en el Modulo de Clientes!!!.' })
			}
		}
	})
}
function buscarprod() {
	var codigo = $("#codigo").val();
	$.ajax({
		type: "POST",
		url: "crud_cotizaciones.php",
		data: "funcion=" + 2 + "&id=" + codigo,
		dataType: "JSON",
		success: function (data) {
			var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 5000 });
			console.log(data);

			//var datos=data[0]['doc'];
			if (data != '') {
				//$("#dirx").val(data[0]['id']);
				$("#codigo").val(data[0]['codigo']);
				$("#categoria").val(data[0]['cat']);
				$("#producto").val(data[0]['nombres']);
				// $("#subcat").val(data[0]['scat']);
				$("#espesor").val(data[0]['espesor']);
				$("#alto").val(data[0]['alto']);
				$("#ancho").val(data[0]['ancho']);
				//$("#precioc").val(data[0]['compra']);
				$("#preciov").val(data[0]['venta']);
				$("#telef").val(data[0]['telef']);
				$("#stock").val(data[0]['stock']);
			} else {
				Toast.fire({ icon: 'error', title: 'No se encontro Cliente o No Existe, Verifique en el Modulo de Clientes!!!.' })
			}
		}
	})
}

// function calcular(){
// 	var preciov   =$("#preciov").val();
// 	var cantidad  =$("#cantidad").val();
// 	var oper =parseFloat(preciov)*parseInt(cantidad);
// 	$("#total").val(oper);
// }

function emitir() {
	var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 5000 });
	var ruc = $("#ruc").val();
	var cli = $("#empresa").val();
	var desc = $("#descuento").val();
	var tot = $("#totalf").val();
	//console.log(desc);
	//console.log(tot);
	console.log(ruc.length);
	if (parseFloat(desc) > parseFloat(tot)) {
		Toast.fire({ icon: 'error', title: 'El Descuento no puede ser Mayor que el total de lo Cotizado!!!.' })
		return;
	}
	if (ruc == "") {
		Toast.fire({ icon: 'error', title: 'Debe de Ingresar El Ruc de la Empresa!!!.' })
		return;
	}

	if (ruc.length < 1) {
		Toast.fire({ icon: 'error', title: 'Debe de Ingresar El Ruc Correcto de la Empresa!!!.' })
		return;
	}
	if (cli == "") {
		Toast.fire({ icon: 'error', title: 'El Cliente no Existe o no Ingreso al Cliente, Intente Porfavor!!!.' })
		return;
	}
	$.ajax({
		type: 'POST',
		url: 'crud_cotizacionesdet.php',
		data: $('#formcotizar').serialize(),
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
// function emitir() {
// 	$.ajax({
// 		type: 'POST',
// 		url: 'crud_cotizacionesdet.php',
// 		data: $('#formcotizar').serialize(),
// 		// async: false,
// 		// contentType: false,
// 		// processData: false,
// 		success: function (respuesta) {
// 			console.log(respuesta);
// 			return;
// 			if (respuesta == 'ok') {
// 				alert('enviado');
// 			}
// 			else {
// 				alert('error');
// 			}
// 		}
// 	});
// }

function agregar() 
{
	var cont = 0;
	var total = 0;
	var subtotal = [];

	var totales = $("#totalf").val();
	var codigo = $("#codigo").val();
	var producto = $("#producto").val();
	var espesor = $("#espesor").val();
	var ancho = $("#ancho").val();
	var alto = $("#alto").val();
	var categoria = $("#categoria").val();
	var preciov = $("#preciov").val();
	var cantidad = $("#cantidad").val();
	var stock = $("#stock").val();
	var oper = parseFloat(preciov) * parseInt(cantidad);
	var total = oper;
	console.log(totales);
	var fin = 0;
	var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 5000 });
	if (parseInt(stock) == 0){
		console.log(stock);
		Toast.fire({ icon: 'error', title: 'El Stock del Articulo esta en 0, Intente con Otro Articulo.' })
		return;
	}
	if (totales == "")
	{
		fin = 0 + parseFloat(total);
	} else {
		fin = parseFloat(totales) + parseFloat(total);
	}

	if (codigo != "" && cantidad != "" && cantidad > 0) {
		subtotal[cont] = '';
		total = total + subtotal[cont];
		var fila = "<tr class='selected' id='fila" + cont + "'><td><button style='color:white' class='btn btn-warning' onclick='eliminar(" + cont + ");'>X</button></td><td><input type='hidden'name='codigodetalle[]' value='" + codigo + "'>" + codigo + "</td><td><input type='hidden'name='productodetalle[]' value='" + producto + "'>" + producto + "</td><td><input type='text' hidden='true' name='espesordetalle[]' value='" + espesor + "'>" + espesor + "</td><td><input type='text' name='anchodetalle[]' hidden='true' value='" + ancho + "'>" + ancho + "</td><td><input hidden='true' style='width:50px' type='number' name='altodetalle[]' value='" + alto + "'>" + alto + "</td><td><input name='categoriadetalle[]' hidden='true' value='" + categoria + "'>" + categoria + "</td><td><input hidden='true' name='preciovdetalle[]' value='" + preciov + "'>" + preciov + "</td><td><input hidden='true' name='cantidaddetalle[]' value='" + cantidad + "'>" + cantidad + "</td><td><input hidden='true' name='totaldetalle[]' value='" + total + "'>" + total + "</td></tr>";
		cont++;
		//limpiar();
		console.log(fin);
		$("#totalf").val(fin);
		//evaluar();
		$("#detalles").append(fila);
		$("#codigo").val('');
		$("#producto").val('');
		$("#espesor").val('');
		$("#ancho").val('');
		$("#alto").val('');
		$("#categoria").val('');
		$("#preciov").val('');
		$("#cantidad").val('');
		$("#total").val('');

	} else {
		Toast.fire({ icon: 'error', title: 'Error al ingresar el detalle del ingreso, revise los datos del articulo.' })
		//alert("Error al ingresar el detalle del ingreso, revise los datos del articulo");
	}
}

	function eliminar(index) {
		$("#fila" + index).remove();
	}

	function generarfac(id,tipo) {
		$.ajax({
			type: "POST",
			url: "crud_cotizaciones.php",
			data: "funcion=" + 3 + "&id=" + id,
			//dataType:"JSON",
			success: function (data) {
				var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 5000 });
				console.log(data);

				if (data == 1) {
					Toast.fire({ icon: 'success', title: 'Se genero con Exito la Facturacion!!!.' })
					window.open("../facturacion/impresion.php?id=" + id+"&tipo="+tipo, "ventana1", "width=600,height=450,scrollbars=NO")
					location.reload();
				} else {
					Toast.fire({ icon: 'error', title: 'No se genero con Exito la Facturacion!!!.' })
					return;
				}
			}
		})
	}
	function generarop(id){
		$.ajax({
			type: "POST",
			url: "crud_cotizaciones.php",
			data: "funcion="+5+"&id="+id,
			//dataType:"JSON",
			success: function (data) {
				var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 5000 });
				console.log(data);

				//var datos=data[0]['doc'];
				if (data == 1) {
					Toast.fire({ icon: 'success', title: 'Se genero con Exito la Facturacion!!!.' })
					window.open("../ordenpedido/impresiones.php?id=" + id, "ventana1", "width=600,height=450,scrollbars=NO")
					location.reload();
				} else {
					Toast.fire({ icon: 'error', title: 'No se genero con Exito la Facturacion!!!.' })
					return;
				}
			}
		})
	}
	
	function eliminarcot(id) {
		$("#idsx").val(id);
	}
	function eliminarcoti() {
		var id = $("#idsx").val();
		$.ajax({
			type: "POST",
			url: "crud_cotizaciones.php",
			data: "funcion=" + 4 + "&id=" + id,
			//dataType:"JSON",
			success: function (data) {
				var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 5000 });
				console.log(data);

				//var datos=data[0]['doc'];
				if (data == 1) {
					Toast.fire({ icon: 'success', title: 'Se Elimino con Exito la Cotizacion!!!.' })
					location.reload();
				} else {
					Toast.fire({ icon: 'error', title: 'No se Elimino con Exito la Cotizacion!!!.' })
					return;
				}
			}
		})
	}
