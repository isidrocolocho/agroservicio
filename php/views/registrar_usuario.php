<br>



<div class="container">
	<br>

	<center>
		<h3>Registro de usuario</h3>
	</center>

	<br><br>
	<form id="frmUsuario" name="frmUsuario" method="POST">
		<input type="hidden" name="opc" id="opc" value="insert">
		<center>
			<div class="col-md-8">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="txtNombreC">Nombre Completo *</label>
						<input type="text" class="form-control" id="txtNombreC" name="txtNombreC">
					</div>
					<div class="form-group col-md-6">
						<label for="txtEmail">Correo Electronico *</label>
						<input type="text" onchange="validarEmail()" class="form-control" id="txtEmail" name="txtEmail">
					</div>
				</div><br>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="txtTelefono">Telefono *</label>
						<input type="text" maxlength="8" minlength="8" onkeypress="return numeros(event)" class="form-control" id="txtTelefono" name="txtTelefono">
					</div>
					<div class="form-group col-md-6">
						<label for="txtusuario">Tipo de usuarios *</label>
						<select class="form-control" id="txtusuario" name="txtusuario">
							<option value="0" disabled="true" selected="true">Seleccione un tipo de usuario</option>

						</select>
					</div>
				</div><br>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="txtcontra">Contraseña *</label>
						<input type="password" class="form-control" id="txtcontra" name="txtcontra">
					</div>
					<div class="form-group col-md-6">
						<label for="txtRcontra">Repetir Contraseña *</label>
						<input type="password" class="form-control decimales" id="txtRcontra" name="txtRcontra">
					</div>
				</div><br>
				<div class="form-group">
					<label for="txtDireccion">Direccion</label>
					<textarea class="form-control" id="txtDireccion" name="txtDireccion"></textarea>
				</div><br>
				
				<a href="?param=lista_usuarios" class="btn btn-info" style="float: left;">Lista de usuarios</a>
				<button type="button" class="btn btn-success" onclick="registrar_producto();" style="float: right;">Guardar usuarios</button>
			</div>
		</center>
		
		
	</form>
</div>





<?php require_once './php/views/footer.php'; ?>
<script type="text/javascript">
	function registrar_producto() {
		if ($('#txtNombreC').val().length == 0 || $('#txtEmail').val().length == 0 || $('#txtTelefono').val().length == 0 || $('#txtusuario').val() == null || $('#txtcontra').val().length == 0 || $('#txtRcontra').val().length == 0 || $('#txtDireccion').val().length == 0) {
			Swal.fire({
				icon: 'error',
				title: 'Ocurrió un error!',
				text: 'Favor llene todos los datos requeridos (*)!'
			})
		}else{
			if ($('#txtcontra').val() != $('#txtRcontra').val()) {
				Swal.fire({
					icon: 'error',
					title: 'Ocurrió un error!',
					text: 'Las Contraseñas deven ser iguales!'
				})
			}else{
				$.post('./php/class/crud_usuarios.php',$('#frmUsuario').serialize(),function(result){
					switch(result.trim()){
						case 'insert_ok':
						Swal.fire({
							icon: 'success',
							title: 'Bien hecho!',
							text: 'El usuario ha sido registrado correctamente!'
						}).then((result) => {
							location.reload();
						});
						break;

						case 'error':
						Swal.fire({
							icon: 'error',
							title: 'Ocurrió un error!',
							text: 'Intente nuevamente, si el error persiste contacte al administrador!'
						})
						break;
					}
				});
			}
		}
	}

	get_usuarios();

	function get_usuarios() {
		$.ajax({
			type: 'post',

			url: './php/class/crud_usuarios.php',

			data: {opc:'get_tipo_usuario'},

			success: function (msg) {
				$('#txtusuario').html(msg).fadeIn();
				$('#txtusuario').html(msg);
			}

		});
	}

	function validarEmail() {
		var email =  document.getElementById('txtEmail').value;
		var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

		if (!regex.test(email)) {
			Swal.fire({
				title: "¡Email incorrecto!",
				text: "Favor ingrese un email valido",
				icon: "error",
				confirmButtonColor: '#45ff4b',
				confirmButtonText: 'Aceptar',

			});
		}
	}

	function numeros(e) {
		var key = window.Event ? e.which : e.keyCode;
		return ((key >= 48 && key <= 57) || (key==8));
	}
</script>