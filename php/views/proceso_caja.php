<br>



<div class="container">
	<br>

	<center>
		<h3>Registrar entradas o salidas</h3>
		
	</center>

	<br><br>
	

	<form id="frmGasto" name="frmGasto" method="POST" >
		<center>
			<div class="col-md-8">
				<select class="form-control" id="estado" name="estado">
					<option selected="true" disabled="true" value="0">Seleccione una opcion</option>
					<option value="1">Registrar Ingreso a caja(abono)</option>
					<option value="2">Registrar Egreso a caja(retiro)</option>
				</select>
			</div>
		</center>
		<br><br>
		<div id="mostrar" style="display: none;">
			<center><h3 id="estado_accion"></h3></center>
			<br><br>
			<input type="hidden" name="opc" id="opc" value="insert">
			<center i>
				<div class="col-md-8">
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="Decripcion" id="lbdescripcion">descripcion del gasto *</label>
							<input type="text" class="form-control" id="Decripcion" name="Decripcion">
						</div>
					</div><br>
					<div class="form-row">
						<div class="form-group col-md-8">
							<label for="fecha" id="lbfecha">fecha del gasto *</label>
							<input type="DATE" class="form-control" id="fecha" name="fecha" >
						</div>
						<div class="form-group col-md-4">
							<label for="total" id="lbTotal">total del gasto *</label>
							<input type="number"  class="form-control" id="total" name="total">
						</div>
					</div><br>

					<a href="?param=lista_ingresos_salidas" class="btn btn-info" style="float: left;">Lista de ingreso y salidas</a>
					<button type="button" class="btn btn-success" id="btnGuardar" onclick="registrar_gasto();" style="float: right;">Guardar gasto</button>
				</div>
			</center>
		</div>
		
	</form>
</div>





<?php require_once './php/views/footer.php'; ?>
<script type="text/javascript">
	$("#estado").change(function () {
		document.getElementById('mostrar').style.display='none';
		if ($("#estado").val()==1) {
			document.getElementById('mostrar').style.display='block';
			$("#estado_accion").html('Abonar de caja');
			$("#lbdescripcion").html('Descripcion de Abonar *');
			$("#lbfecha").html('Fecha de Abonar *');
			$("#lbTotal").html('Total Abonar *');
			$("#btnGuardar").html('Guardar Abono');
		}else{
			document.getElementById('mostrar').style.display='block';
			$("#estado_accion").html('Retirar de caja');
			$("#lbdescripcion").html('Descripcion de Retiro *');
			$("#lbfecha").html('Fecha de Retiro *');
			$("#lbTotal").html('Total Retiro *');
			$("#btnGuardar").html('Guardar Retiro');

		}
	});
	function registrar_gasto() {
		if ($("#estado").val()==1) {
			var estado = ' Abono ';
		}else{
			var estado = ' Retiro ';
		}
		if ($('#Decripcion').val().length == 0 || $('#fecha').val().length == 0 || $('#total').val().length == 0) {
			Swal.fire({
				icon: 'error',
				title: 'Ocurrió un error!',
				text: 'Favor llene todos los datos requeridos (*)!'
			})
		}else{
			$.post('./php/class/crud_caja.php',$('#frmGasto').serialize(),function(result){
				switch(result.trim()){
					case 'insert_ok':
					Swal.fire({
						icon: 'success',
						title: 'Bien hecho!',
						text: 'El '+estado+' ha sido registrado correctamente!'
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