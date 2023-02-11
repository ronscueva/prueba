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
                $("#id").val(data[0]['id']);
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
   
	var proveedor = $("#razon_social").val();
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
function registrarCompra(){
    var id      =$("#dirx").val();
    var producto=$("#producto").val();
    var cat     =$("#categoria").val();
    var scat    =$("#subcat").val();
    var espesor =$("#espesor").val();
    var alto    =$("#alto").val();
    var ancho   =$("#ancho").val();
    var compra  =$("#precioc").val();
    var venta   =$("#preciov").val();

        var Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000});
        if (id==""){
                    Toast.fire({icon: 'error',title: 'Debe de Ingresar el Codigo.'})
                    return;
        }else if (producto==""){
                    Toast.fire({icon: 'error',title: 'Debe de Ingresar el Nombre del producto.'})
                    return;
        }else if (cat==""){
                   Toast.fire({icon: 'error',title: 'Debe de Ingresar la Categoria'})
                   return;
        }else if (scat==""){
                    Toast.fire({icon: 'error',title: 'Debe de Ingresar la Sub Categoria'})
                    return;
        }else if (venta==""){
                    Toast.fire({icon: 'error',title: 'Debe de Ingresar el Precio Venra'})
                    return;
        }
        $.ajax({
            type:"post",
            url:"crud_productos.php",
            data:"funcion="+1+"&id="+id+"&producto="+producto+"&categoria="+cat+"&subcat="+scat+"&espesor="+espesor+"&alto="+alto+"&ancho="+ancho+"&precio="+venta+"&compra="+compra,
            success:function(data){
                console.log(data);
                if (data==1){
                    var Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000});
                    Toast.fire({icon: 'success',title: 'Se Registro al Vendedor con Exito.'})
                    location.reload();
                }else
                {
                    $(document).Toasts('create', 
                    {
                    class: 'bg-maroon',
                    title: 'ERROR !!!',
                    subtitle: 'Alerta',
                    body: 'Ocurrio un Error al Registrar al Vendedor!!!.'
                    })
                   // location.reload();
                }
            }
        })
    }