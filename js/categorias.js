function editarcli(id) {
    console.log("LLEgo");
    $("#ids").val('');
    $("#nombres").val('');
    $.ajax({
        type: "post",
        url: "crud_categoria.php",
        data: "funcion=" + 2 + "&id=" + id + "&nombre=" + 0 ,
        dataType: "JSON",
        success: function (data) {
            $("#ids").val(data[0]['id']);
            $("#nombres").val(data[0]['nombres']);
            console.log(data[0]['id']);
        }
    })
}
function edicioncli() {
    var id = $("#ids").val();
    var nombre = $("#nombres").val();
    $.ajax({
        type: "post",
        url: "crud_categoria.php",
        data: "funcion=" + 3 + "&id=" + id +  "&nombre=" + nombre ,
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
function eliminarcli(id) {
    $("#idsx").val(id);
}

function eliminarclient() {
    var id = $("#idsx").val();
    $.ajax({
        type: "post",
        url: "crud_proveedores.php",
        data: "funcion=" + 4 + "&id=" + id + "&ruc=" + 0 + "&social=" + 0 + "&telef=" + 0 + "&dir=" + 0,
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

function registrarcli() {
    var nombre = $("#nombrex").val();
    //alert(ruc);
    var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
    if (nombre == "") {
        Toast.fire({ icon: 'error', title: 'Debe de Ingresar el Nombre.' })
        return;
    } else if (nombre == "") {
        Toast.fire({ icon: 'error', title: 'Debe de Ingresar el Nombre.' })
        return;
    }
    $.ajax({
        type: "post",
        url: "crud_categoria.php",
        data: "funcion=" + 1 + "&id=" + 0 +"&nombre=" + nombre,
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
