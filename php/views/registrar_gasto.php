<br>



<div class="container">
	<br>

	<center>
		<h3>Registro de gasto</h3>
	</center>

	<br><br>
	<form id="frmGasto" name="frmGasto" method="POST">
		<input type="hidden" name="opc" id="opc" value="insert">
		<center>
			<div class="col-md-8">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="txtGasto">Nombre del gasto *</label>
						<input type="text" class="form-control" id="txtGasto" name="txtGasto" placeholder="recibos">
					</div>
					<div class="form-group col-md-6">
						<label for="txtGasto">Estado del gasto *</label>
						<select class="form-control" id="slEstado" name="slEstado">
							<option selected="true" value="1">Activo</option>
							<option value="0">Inactivo</option>
						</select>
					</div>
				</div><br>
				
				<a href="?param=lista_gastos" class="btn btn-info" style="float: left;">Lista de gastos</a>
				<button type="button" class="btn btn-success" onclick="registrar_gasto();" style="float: right;">Guardar gasto</button>
			</div>
		</center>
		
		
	</form>
</div>





<?php require_once './php/views/footer.php'; ?>
<script type="text/javascript">
	function registrar_gasto() {
		if ($('#txtGasto').val().length == 0) {
			Swal.fire({
				icon: 'error',
				title: 'Ocurrió un error!',
				text: 'Favor llene todos los datos requeridos (*)!'
			})
		}else{
			$.post('./php/class/crud_gasto.php',$('#frmGasto').serialize(),function(result){
					switch(result.trim()){
						case 'insert_ok':
						Swal.fire({
							icon: 'success',
							title: 'Bien hecho!',
							text: 'El gasto ha sido registrado correctamente!'
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
</script>