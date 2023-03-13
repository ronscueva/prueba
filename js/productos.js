function calculoprecio(){
    var peso =$("#peso").val();
    
}
function calculopeso(){
var cat=$("#categoria").val();
var espesor=$("#espesor").val();
var alto=$("#alto").val();
var ancho=$("#ancho").val();
var constante=$("#subcat").val();
var peso="";
console.log(cat);
if(cat==1){
    peso=(parseFloat(espesor)*parseFloat(alto)*parseFloat(ancho)*parseFloat(constante))/1000;
}else{
    peso=(parseFloat(espesor)*parseFloat(alto)*parseFloat(ancho)*parseFloat(constante))/1000000;
}
var pesofinal = peso.toFixed(4);
$("#peso").val(pesofinal);
}
function editarpro(id){
    //$("#dirx").val('');
    //$("#producto").val('');
    //$("#categoria").val('');
    //$("#subcat").val('');
    //$("#espesor").val('');
    //$("#alto").val('');
    //$("#ancho").val('');
    //$("#precioc").val('');
    //$("#preciov").val('');
    //console.log("Hola");
    document.getElementById("reg").hidden=true;
        $.ajax({
            type:"post",
            url:"crud_productos.php",
            data:"funcion="+2+"&id="+id+"&producto="+0+"&categoria="+0+"&subcat="+0+"&espesor="+0+"&alto="+0+"&ancho="+0+"&precio="+0+"&compra="+0,
            dataType:"JSON",
            success:function(data){
                document.getElementById("edi").hidden=false;
    $("#codigo").val(data[0]['idp']);
    $("#dirx").val(data[0]['id']);
    $("#categoria").val(data[0]['cat']);
    $("#producto").val(data[0]['nombres']);
    $("#subcat").val(data[0]['scat']);
    $("#espesor").val(data[0]['espesor']);
    $("#alto").val(data[0]['alto']);
    $("#ancho").val(data[0]['ancho']);
    $("#precioc").val(data[0]['compra']);
    $("#preciov").val(data[0]['venta']);
               // console.log(data[0]['id']);
                
               
            }
        })
    }
    
    function editarprod(){
    var id      =$("#codigo").val();
    var producto=$("#producto").val();
    var cat     =$("#categoria").val();
    var scat    =$("#subcat").val();
    var espesor =$("#espesor").val();
    var alto    =$("#alto").val();
    var ancho   =$("#ancho").val();
    var compra  =$("#precioc").val();
    var venta   =$("#preciov").val();
    $.ajax({
    type:"post",
            url:"crud_productos.php",
            data:"funcion="+3+"&id="+id+"&producto="+producto+"&categoria="+cat+"&subcat="+scat+"&espesor="+espesor+"&alto="+alto+"&ancho="+ancho+"&precio="+venta+"&compra="+compra,
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
                //location.reload();
                }
            }
    })
    }
    function eliminarprod(id){
    $("#idsx").val(id);
    }
    
    function eliminarproduc(){
    var id=$("#idsx").val();
    $.ajax({
        type:"post",
            url:"crud_productos.php",
            data:"funcion="+4+"&id="+id+"&producto="+0+"&categoria="+0+"&subcat="+0+"&espesor="+0+"&alto="+0+"&ancho="+0+"&precio="+0+"&compra="+0,
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
                //location.reload();
                }
            }
    })
    }
    
    function registrarpro(){
    var id      =$("#dirx").val();
    var producto=$("#producto").val();
    var cat     =$("#categoria").val();
    var scat    =$("#subcat").val();
    var espesor =$("#espesor").val();
    var alto    =$("#alto").val();
    var ancho   =$("#ancho").val();
    var compra  =$("#precioc").val();
    var venta   =$("#preciov").val();
    var codmateria   =$("#codmateria").val();

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
            data:"funcion="+1+"&id="+id+"&producto="+producto+"&categoria="+cat+"&subcat="+scat+"&espesor="+espesor+"&alto="+alto+"&ancho="+ancho+"&precio="+venta+"&compra="+compra+"&codmateria="+codmateria,
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
    function registrartipopro() {
        var tipo_producto = $("#tipo_productox").val();
        var constante = $("#constantex").val();
    
        //alert(ruc);
        var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
        if (tipo_producto == "") {
            Toast.fire({ icon: 'error', title: 'Debe de Ingresar el Nombre.' })
            return;
        } else if (constante == "") {
            Toast.fire({ icon: 'error', title: 'Debe de Ingresar la constante.' })
            return;
        } 
        $.ajax({
            type: "post",
            url: "crud_tipo_producto.php",
            data: "funcion=" + 1 + "&id=" + 0 + "&tipo_producto=" + tipo_producto +  "&constante=" + constante ,
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
                    Toast.fire({ icon: 'success', title: 'Se Registro al Usuario con Exito.' })
                    location.reload();
                } else {
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
    function selectNit(e) {
        var nit =  e.target.selectedOptions[0].getAttribute("data-nit")
        document.getElementById("descripmateria").value = nit; 
        } 
    