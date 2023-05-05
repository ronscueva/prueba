function editarcli(id) {
    console.log("LLEgo");
    $("#ids").val('');
    $("#rucs").val('');
    $("#nomb").val('');
    $("#tef").val('');
    $("#dire").val('');
    $.ajax({
        type: "post",
        url: "crud_proveedores.php",
        data: "funcion=" + 2 + "&id=" + id + "&ruc=" + 0 + "&social=" + 0 + "&telef=" + 0 + "&dir=" + 0,
        dataType: "JSON",
        success: function (data) {
            $("#ids").val(data[0]['id']);
            $("#rucs").val(data[0]['ruc']);
            $("#nomb").val(data[0]['razon_social']);
            $("#tef").val(data[0]['telef']);
            $("#dire").val(data[0]['dir']);
            console.log(data[0]['razon_social']);
        }
    })
}
function edicioncli() {
    var id = $("#ids").val();
    var ruc = $("#rucs").val();
    var nombre = $("#nomb").val();
    var telf = $("#tef").val();
    var dir = $("#dire").val();
    $.ajax({
        type: "post",
        url: "crud_proveedores.php",
        data: "funcion=" + 3 + "&id=" + id + "&ruc=" + ruc + "&social=" + nombre + "&telef=" + telf + "&dir=" + dir,
        success: function (data) {
            console.log(data);
            if (data == 1) {
                var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
                Toast.fire({ icon: 'success', title: 'Se Actualizo el Registro con Exito.' })
                location.reload();
            } else {
                $(document).Toasts('create', {
                    class: 'bg-maroon',
                    title: 'ERROR !!!',
                    subtitle: 'Alerta',
                    body: 'Ocurrio un Error al Actualizar!!!.'
                })
                location.reload();
            }
        }
    })
}
function asociabobina(id) {
    $("#idsxcodigobobina").val(id);
    document.getElementById('codigo').disabled=false;
}
function asociamerma(id) {
    $("#idsxcodigobobina").val(id);
    document.getElementById('cantidad').disabled=false;
    document.getElementById('espesor').disabled=false;
    document.getElementById('largo').disabled=false;
    document.getElementById('ancho').disabled=false;
    document.getElementById('obs').disabled=false;
}
function eliminarprod(id) {
    $("#idsx").val(id);
}
function eliminarproduc() {
    var id = $("#idsx").val();
    $.ajax({
        type: "post",
        url: "crud_orden_produccion.php",
        data: "funcion=" + 4 + "&id=" + id + "&ruc=" + 0 + "&social=" + 0 ,
        success: function (data) {
            console.log(data);
            if (data == 1) {
                var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
                Toast.fire({ icon: 'success', title: 'Se Elimino al Cliente con Exito.' })
                location.reload();
            } else {
                $(document).Toasts('create', {
                    class: 'bg-maroon',
                    title: 'ERROR !!!',
                    subtitle: 'Alerta',
                    body: 'Ocurrio un Error al Eliminar!!!.'
                })
                location.reload();
            }
        }
    })
}
function registrarmerma() {
    var cantidad = $("#cantidad").val();
    var idsxcodigobobina = $("#idsxcodigobobina").val();
    var espesor = $("#espesor").val();
    var largo = $("#largo").val();
    var ancho = $("#ancho").val();
    var obs = $("#obs").val();
    //alert(ruc);
   
    $.ajax({
        type: "post",
        url: "crud_orden_produccion.php",
        data: "funcion=" + 3 + "&id=" + 0 + "&cantidad=" + cantidad + "&idsxcodigobobina=" + idsxcodigobobina+ "&espesor=" + espesor + "&largo=" + largo + "&ancho=" + ancho+ "&obs=" + obs,
        success: function (data) {
            console.log(data);
            if (data == 1) {
                var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
                Toast.fire({ icon: 'success', title: 'Se Registro al Cliente con Exito.' })
                location.reload();
            } else {
                $(document).Toasts('create', {
                    class: 'bg-maroon',
                    title: 'ERROR !!!',
                    subtitle: 'Alerta',
                    body: 'Ocurrio un Error al Registrar al Cliente!!!.'
                })
                location.reload();
            }
        }
    })
}
function registrarbobina() {
    var codigo = $("#codigo").val();
    var idsxcodigobobina = $("#idsxcodigobobina").val();
 
    //alert(ruc);
   
    $.ajax({
        type: "post",
        url: "crud_orden_produccion.php",
        data: "funcion=" + 2 + "&id=" + 0 + "&codigo=" + codigo + "&idsxcodigobobina=" + idsxcodigobobina,
        success: function (data) {
            console.log(data);
            if (data == 1) {
                var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
                Toast.fire({ icon: 'success', title: 'Se Registro al Cliente con Exito.' })
                location.reload();
            } else {
                $(document).Toasts('create', {
                    class: 'bg-maroon',
                    title: 'ERROR !!!',
                    subtitle: 'Alerta',
                    body: 'Ocurrio un Error al Registrar al Cliente!!!.'
                })
                location.reload();
            }
        }
    })
}
function registrarpro() {
    var tipo_producto = $("#tipo_producto").val();
    var cantidad = $("#cantidad").val();
    var espesor = $("#espesor").val();
    var largo = $("#largo").val();
    var ancho = $("#ancho").val();
    var obs = $("#obs").val();
    //alert(ruc);
    var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
    if (tipo_producto == "") {
        Toast.fire({ icon: 'error', title: 'Debe de Ingresar el tipo_producto.' })
        return;
    } else if (cantidad == "") {
        Toast.fire({ icon: 'error', title: 'Debe de Ingresar la cantidad.' })
        return;
    } else if (espesor == "") {
        Toast.fire({ icon: 'error', title: 'Debe de Ingresar el espesor.' })
        return;
    } else if (largo == "") {
        Toast.fire({ icon: 'error', title: 'Debe de Ingresar el largo.' })
        return;
    }
    else if (ancho == "") {
    Toast.fire({ icon: 'error', title: 'Debe de Ingresar el ancho.' })
    return;
    }
    $.ajax({
        type: "post",
        url: "crud_orden_produccion.php",
        data: "funcion=" + 1 + "&id=" + 0 + "&tipo_producto=" + tipo_producto + "&cantidad=" + cantidad + "&espesor=" + espesor + "&largo=" + largo + "&ancho=" + ancho + "&obs=" + obs,
        success: function (data) {
            console.log(data);
            if (data == 1) {
                var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
                Toast.fire({ icon: 'success', title: 'Se Registro al Cliente con Exito.' })
                location.reload();
            } else {
                $(document).Toasts('create', {
                    class: 'bg-maroon',
                    title: 'ERROR !!!',
                    subtitle: 'Alerta',
                    body: 'Ocurrio un Error al Registrar al Cliente!!!.'
                })
                location.reload();
            }
        }
    })
}
function selectProduc(e) {
    var nit =  e.target.selectedOptions[0].getAttribute("data-nit")
    document.getElementById("producto").value = nit; 
    } 