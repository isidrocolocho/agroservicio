function autenticar(){
	if ($('#txtUser').val().length == 0 ||
		$('#txtPass').val().length == 0) {
		Swal.fire({
		  icon: 'error',
		  title: 'Ocurrió un error!',
		  text: 'Favor ingrese su usuario y contraseña!'
		})
	}else{
		$.post('../class/autenticar.php',$('#frmLogin').serialize(),function(result){
				switch(result.trim()){

					case 'LOGUED':
						$(location).attr('href','../../index.php?param=inicio');
					break;

					case 'NOEMAIL':
						Swal.fire({
						  icon: 'error',
						  title: 'Ocurrió un error!',
						  text: 'El correo ingresado no existe, favor ingrese su correo nuevamente.'
						})
					break;

					case 'NOPASS':
						Swal.fire({
						  icon: 'error',
						  title: 'Ocurrió un error!',
						  text: 'La contraseña ingresada no es correcta.'
						})
					break;

					case 'USERBLOCK':
						Swal.fire({
						  icon: 'error',
						  title: 'Ocurrió un error!',
						  text: 'Su usuario ha sido bloqueado, favor contacte al administrador.'
						})
					break;

					default:
						Swal.fire({
						  icon: 'error',
						  title: 'Ocurrió un error!',
						  text: 'Favor intente nuevamente, si el error persiste contacte al desarrollador.'
						})
					break;
				}
			});
	}
}