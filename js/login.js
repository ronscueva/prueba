function validar(){
	var user=$("#usuario").val();
	var contra=$("#clave").val();
	$.ajax({
		type:"post",
		url:"pages/login/login.php",
		data:"user="+user+"&contra="+contra,
		success:function(data){
				var Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000});
			if (data==1){
				Toast.fire({icon: 'success',title: 'credenciales correctas.'})
				window.location.href='panel.php';
			}else{
				Toast.fire({icon: 'error',title: 'Las credenciales ingresadas estan incorrectas!!!.'})
			}
		}
	})
}