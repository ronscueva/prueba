function grabarcliente(){
var ruc =$("#ruc").val();
var rz  =$("#nombre").val();
var telf=$("#telefono").val();
var dir =$("#direccion").val();

$.ajax({
	type:'post',
	url:'clientes/registro_cliente.php',
	data:'ruc='+ruc+'&rz='+rz+'&telf='+telf+'&dir='+dir,
	success:function(data){
		alert(data);
	}
})
}