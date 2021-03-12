<br>



<div class="container">
	<br>

	<center>
		<h3>Registro de cliente</h3>
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
						<label for="txtTelefono">Telefono *</label>
						<input type="text" maxlength="8" minlength="8" onkeypress="return numeros(event)" class="form-control" id="txtTelefono" name="txtTelefono">
					</div>
				</div><br>
				<div class="form-group">
					<label for="txtDireccion">Direccion</label>
					<textarea class="form-control" id="txtDireccion" name="txtDireccion"></textarea>
				</div><br>
				
				<a href="?param=lista_clientes" class="btn btn-info" style="float: left;">Lista de clientes</a>
				<button type="button" class="btn btn-success" onclick="registrar_producto();" style="float: right;">Guardar cliente</button>
			</div>
		</center>
		
		
	</form>
</div>

<br><br><br><br><br><br>



<?php require_once './php/views/footer.php'; ?>
<script type="text/javascript">
	function registrar_producto() {
		if ($('#txtNombreC').val().length == 0 || $('#txtTelefono').val().length == 0 || $('#txtDireccion').val().length == 0) {
			Swal.fire({
				icon: 'error',
				title: 'Ocurrió un error!',
				text: 'Favor llene todos los datos requeridos (*)!'
			})
		}else{
			
			$.post('./php/class/crud_clientes.php',$('#frmUsuario').serialize(),function(result){
				switch(result.trim()){
					case 'insert_ok':
					Swal.fire({
						icon: 'success',
						title: 'Bien hecho!',
						text: 'El Cliente ha sido registrado correctamente!'
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

	function numeros(e) {
		var key = window.Event ? e.which : e.keyCode;
		return ((key >= 48 && key <= 57) || (key==8));
	}
</script>