function buscarcli() {
    var id = $("#provee").val();
    $.ajax({
        type: "POST",
        url: "crud_compras.php",
        data: "funcion=" + 5 + "&id=" + id,
        dataType: "JSON",
        success: function (data) {
            var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 5000 });
            console.log(data);

            //var datos=data[0]['doc'];
            if (data != '') {
                $("#id_prove").val(data[0]['id']);
                $("#razon_social").val(data[0]['razon_social']);
                $("#direc").val(data[0]['direccion']);
                $("#ruc").val(data[0]['ruc']);
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
                $("#preciouni").val(data[0]['precio_unidad']);
                $("#producto").val(data[0]['codigo']);
                $("#idp").val(data[0]['idp']);
                $("#nombre_producto").val(data[0]['nombres']);
                $("#cantidad").val('1');
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
    var totales = $("#totalf").val();
    
    var contador = $("#contadorf").val();
    var cantidadtotal = $("#cantif").val();
	var descripcion = $("#nombre_producto").val();
	var producto = $("#producto").val();
	var cantidad = $("#cantidad").val();
	var preciouni = $("#preciouni").val();
    var ventauni = $("#ventauni").val();
    var pesouni = $('#peso').val();
    var pesof = $('#pesof').val();
    var idp = $("#idp").val();
	var oper = parseFloat(ventauni) * parseInt(pesouni);
    
	var total = oper;
	//console.log(proveedor);
    
    var fin = 0
    var cfin = 0
   

     contador ++
		
    
     if (pesof == "") {
    
		pesof = 0 + parseFloat(pesouni);
	} else {
       
		pesof = parseFloat(pesof) + parseFloat(pesouni);
	}

    if (totales == "") {
    
		fin = 0 + parseFloat(total);
        cfin = 0 +parseInt(cantidad);
	} else {
       
		fin = parseFloat(totales) + parseFloat(total);
        cfin = parseInt(cantidadtotal) + parseInt(cantidad);
       
	}


    if (cantidad != "" && cantidad > 0) {
        subtotal[cont] = '';
        total = total + subtotal[cont];
        
        var fila = "<tr class='selected' id='fila" + cont +  "'><td><button style='color:white' class='btn btn-warning' onclick='eliminar(" + 
           cont + ");'>X</button></td><td><input type='hidden'name='codigodetallegrid[]' value='" + 
           idp + "'>" + idp + 
           "</td> <td><input type='text' hidden='true' name='productogrid[]' value='" +
           producto + "'>" + producto +
           "</td><td><input hidden='true' name='descripciongrid[]' value='" + 
           descripcion + "'>" + descripcion + 
            "</td><td><input hidden='true' name='cantidadgrid[]' value='" + 
            cantidad + "'>" + cantidad + 
           "</td><td><input hidden='true' name='pesogrid[]' value='" + 
           pesouni + "'>" + pesouni +
           "</td><td><input hidden='true' name='ventaunigrid[]' value='" + 
           ventauni + "'>" + ventauni +
            "</td><td><input hidden='true' name='preciunigrid[]' value='" + 
           preciouni + "'>" + preciouni +
            "</td><td><input hidden='true' name='totalgrid[]' value='" + 
            total + "'>" + total + 
            " <input hidden='true' name='conteo' value='" + cont +  cont + "'></td></tr>";
            
           cont++;
        //limpiar();
        console.log(fin);
        $("#pesof").val(pesof);
        $("#totalf").val(fin);
        $("#cantif").val(cfin);
        $("#contadorf").val(contador);
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
function registrarCompra(){
    //var producto=$("#producto").val();
    //var idproveedor     =$("#id_prove").val();
    //var cantidad    =$("#cantif").val();
    //var total    =$("#totalf").val();
//
    //    var Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000});
    //    if (idproveedor==""){
    //                Toast.fire({icon: 'error',title: 'Debe de Ingresar el Codigo.'})
    //                return;
//
    //    }else if (cantidad==""){
    //                Toast.fire({icon: 'error',title: 'Debe de Ingresar el Precio Venta'})
    //                return;
    //    }
    //    else if (total==""){
    //        Toast.fire({icon: 'error',title: 'Debe de Ingresar el Precio Venta'})
    //        return;
    //    }
        
        $.ajax({
            type:"post",
            url:"crud_compras_det.php",
            data: $('#formcotizar').serialize(),
            success:function(data){
                console.log(data);
                if (data!=0){
                    var Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000});
                    Toast.fire({icon: 'success',title: 'Se Registro al Vendedor con Exito.'})
                   // location.reload();
                }else
                {
                    $(document).Toasts('create', 
                    {
                    class: 'bg-maroon',
                    title: 'ERROR !!!',
                    subtitle: 'Alerta',
                    body: 'Ocurrio un Error al Registrar al Vendedor!!!.'
                    })
                  //  location.reload();
                }
            }
        })
    }