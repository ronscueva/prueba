function editarcli(id){
    $("#ids").val('');
    $("#rucs").val('');
    $("#nomb").val('');
    $("#tef").val('');
    $("#dire").val('');
        $.ajax({
            type:"post",
            url:"crud_usuarios.php",
            data:"funcion="+2+"&id="+id+"&ruc="+0+"&social="+0+"&telef="+0+"&dir="+0,
            dataType:"JSON",
            success:function(data){
    $("#ids").val(data[0]['id']);
    $("#rucs").val(data[0]['doc']);
    $("#nomb").val(data[0]['nombres']);
    $("#tef").val(data[0]['telef']);
    $("#dire").val(data[0]['dir']);
                console.log(data[0]['id']);
            }
        })
    }
    
    function edicioncli(){
    var id=$("#ids").val();
    var ruc=$("#rucs").val();
    var nombre=$("#nomb").val();
    var telf=$("#tef").val();
    var dir=$("#dire").val();
    $.ajax({
    type:"post",
            url:"crud_usuarios.php",
            data:"funcion="+3+"&id="+id+"&ruc="+ruc+"&social="+nombre+"&telef="+telf+"&dir="+dir,
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
            url:"crud_usuarios.php",
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
    
    function registrarcli(){
        var nombre=$("#nombrex").val();
        var usuario=$("#usuariox").val();
        var pass=$("#passx").val();
        var level=$("#levelx").val();
        
    //alert(ruc);
        var Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000});
        if (nombre==""){
                    Toast.fire({icon: 'error',title: 'Debe de Ingresar el Nombre.'})
                    return;
        }else if (usuario==""){
                    Toast.fire({icon: 'error',title: 'Debe de Ingresar el usuario.'})
                    return;
        }else if (pass==""){
                    Toast.fire({icon: 'error',title: 'Debe de Ingresar la Contraseña.'})
                    return;
        }
        $.ajax({
            type:"post",
            url:"crud_usuarios.php",
            data:"funcion="+1+"&id="+0+"&nombre="+nombre+"&usuario="+usuario+"&pass="+pass+"&level="+level,
            success:function(data){
                console.log(data);
                if (data==1){
                    var Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000});
                    Toast.fire({icon: 'success',title: 'Se Registro al Usuario con Exito.'})
                    location.reload();
                }else{
                $(document).Toasts('create', {
                    class: 'bg-maroon',
                    title: 'ERROR !!!',
                    subtitle: 'Alerta',
                    body: 'Ocurrio un Error al Registrar al Ususario!!!.'
          })
                location.reload();
                }
            }
        })
    }
    