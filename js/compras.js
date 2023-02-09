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
        url: "crud_compras.php",
        data: "funcion=" + 2 + "&id=" + codigo,
        dataType: "JSON",
        success: function (data) {
            var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 5000 });
            console.log(data);

            //var datos=data[0]['doc'];
            if (data != '') {
                //$("#dirx").val(data[0]['id']);
                $("#codigo").val(data[0]['codigo']);
                $("#producto").val(data[0]['nombres']);
            } else {
                Toast.fire({ icon: 'error', title: 'No se encontro Cliente o No Existe, Verifique en el Modulo de Clientes!!!.' })
            }
        }
    })
}



function agregar() {
    var cont = 0;
    var total = 0;
    var subtotal = [];
   
	var proveedor = $("#prove").val();
	var producto = $("#producto").val();
	var cantidad = $("#cantidad").val();
	var preciouni = $("#preciouni").val();
	var oper = parseFloat(preciouni) * parseInt(cantidad);
	var total = oper;
	console.log(proveedor);
    var fin = 0
    if (proveedor == "") {
        fin = 0 + parseFloat(total);
    } else {
        fin = parseFloat(proveedor) + parseFloat(total);
    }


    if (cantidad != "" && cantidad > 0) {
        subtotal[cont] = '';
        total = total + subtotal[cont];
        var fila = "<tr class='selected' id='fila" + cont + "'><td><button style='color:white' class='btn btn-warning' onclick='eliminar(" + cont + ");'>X</button></td><td><input type='hidden'name='codigodetalle[]' value='" + 
                                                    producto + "'>" + producto + "</td><td><input type='text' hidden='true' name='espesordetalle[]' value='" +
                                                    proveedor + "'>" + proveedor + "</td><td><input hidden='true' name='cantidaddetalle[]' value='" + 
                                                    cantidad + "'>" + cantidad + "</td><td><input hidden='true' name='totaldetalle[]' value='" + 
                                                    preciouni + "'>" + preciouni + "</td><td><input hidden='true' name='totaldetalle[]' value='" + 
                                                    total + "'>" + total + "</td></tr>";
                                                    cont++;
        //limpiar();
        console.log(fin);
        $("#totalf").val(fin);
        //evaluar();
        $("#detalles").append(fila);
        $("#prove").val('');
        $("#producto").val('');
        $("#preciouni").val('');
        $("#cantidad").val('');
        $("#total").val('');

    } else {
        alert("Error al ingresar el detalle del ingreso, revise los datos del articulo");
    }
}
function eliminar(index) {
    $("#fila" + index).remove();
}