function editarcli(id){
    $("#ids").val('');
    $("#dnis").val('');
    $("#nombres").val('');
    $("#apellidos").val('');
    $("#tef").val('');
    $("#dire").val('');
    console.log("Hola");
        $.ajax({
            type:"post",
            url:"crud_vendedores.php",
            data:"funcion="+2+"&id="+id+"&dni="+0+"&nombre="+0+"&apellido="+0+"&telef="+0+"&dir="+0,
            dataType:"JSON",
            success:function(data){
    $("#ids").val(data[0]['id']);
    $("#dnis").val(data[0]['dni']);
    $("#nombres").val(data[0]['nombre']);
    $("#apellidos").val(data[0]['apellido']);
    $("#tef").val(data[0]['telef']);
    $("#dire").val(data[0]['dir']);
                console.log(data[0]['id']);
                
               
            }
        })
    }
    
    function edicioncli(){
        var id=$("#ids").val();
        var dni=$("#dnis").val();
        var nombre=$("#nombres").val();
        var apellido=$("#apellidos").val();
        var telf=$("#tef").val();
        var dir=$("#dire").val();
    $.ajax({
    type:"post",
            url:"crud_vendedores.php",
            data:"funcion="+3+"&id="+id+"&dni="+dni+"&nombre="+nombre+"&apellido="+apellido+"&telef="+telf+"&dir="+dir,
            success:function(data){
                console.log(data);
                if (data==1){
                    var Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000});
                    Toast.fire({icon: 'success',title: 'Se Actualizo el Registro con Exito.'})
                    location.reload();
                }else{
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
    function eliminarcli(id){
    $("#idsx").val(id);
    }
    
    function eliminarclient(){
    var id=$("#idsx").val();
    $.ajax({
        type:"post",
            url:"crud_cliente.php",
            data:"funcion="+4+"&id="+id+"&ruc="+0+"&social="+0+"&telef="+0+"&dir="+0,
            success:function(data){
                console.log(data);
                if (data==1){
                    var Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000});
                    Toast.fire({icon: 'success',title: 'Se Elimino al Cliente con Exito.'})
                    location.reload();
                }else{
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
    
    function registrarven(){
        var dni=$("#dnix").val();
        var nombre=$("#nombrex").val();
        var apellido=$("#apellidox").val();
        var tel=$("#telx").val();
        var dir=$("#dirx").val();
    //alert(ruc);
        var Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000});
        if (dni==""){
                    Toast.fire({icon: 'error',title: 'Debe de Ingresar el Nro DNI.'})
                    return;
        }else if (nombre==""){
                    Toast.fire({icon: 'error',title: 'Debe de Ingresar el Nombre y Apellido.'})
                    return;
        }else if (apellido==""){
                   Toast.fire({icon: 'error',title: 'Debe de Ingresar el Nombre y Apellido.'})
                   return;
        }else if (tel==""){
                    Toast.fire({icon: 'error',title: 'Debe de Ingresar el Telefono.'})
                    return;
        }else if (dir==""){
                    Toast.fire({icon: 'error',title: 'Debe de Ingresar la Direccion.'})
                    return;
        }
        $.ajax({
            type:"post",
            url:"crud_vendedores.php",
            data:"funcion="+1+"&id="+0+"&dni="+dni+"&nombre="+nombre+"&apellido="+apellido+"&telef="+tel+"&dir="+dir,
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
                    location.reload();
                }
            }
        })
    }
    