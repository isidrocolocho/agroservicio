<br>



<div class="container">
	<br>

	<center>
		<h3>Registro de gasto reservado</h3>
	</center>

	<br><br>
	<form id="frmGasto" name="frmGasto" method="POST">
		<input type="hidden" name="opc" id="opc" value="insert">
		<center>
			<div class="col-md-8">
				<div class="form-row">
					<div class="form-group col-md-8">
						<label for="Decripcion">descripcion del gasto *</label>
						<input type="text" class="form-control" id="Decripcion" name="Decripcion">
					</div>
					<div class="form-group col-md-4">
						<label for="tipo_gasto">Estado del gasto *</label>
						<select class="form-control" id="tipo_gasto" name="tipo_gasto">
						
						</select>
					</div>
				</div><br>
				<div class="form-row">
					<div class="form-group col-md-8">
						<label for="fecha_pago">fecha del gasto *</label>
						<input type="DATE" class="form-control" id="fecha_pago" name="fecha_pago" >
					</div>
					<div class="form-group col-md-4">
						<label for="total_gasto">total del gasto *</label>
						<input type="number"  class="form-control" id="total_gasto" name="total_gasto">
					</div>
				</div><br>
				
				<a href="?param=lista_gastos_reservados" class="btn btn-info" style="float: left;">Lista de gastos reservados</a>
				<button type="button" class="btn btn-success" onclick="registrar_gasto();" style="float: right;">Guardar gasto</button>
			</div>
		</center>
		
		
	</form>
</div>





<?php require_once './php/views/footer.php'; ?>
<script type="text/javascript">
	function registrar_gasto() {
		if ($('#Decripcion').val().length == 0 || $('#tipo_gasto').val() == null || $('#fecha_pago').val() == null || $('#total_gasto').val().length == 0) {
			Swal.fire({
				icon: 'error',
				title: 'Ocurrió un error!',
				text: 'Favor llene todos los datos requeridos (*)!'
			})
		}else{
			$.post('./php/class/crud_gasto_reservados.php',$('#frmGasto').serialize(),function(result){
					switch(result.trim()){
						case 'insert_ok':
						Swal.fire({
							icon: 'success',
							title: 'Bien hecho!',
							text: 'El gasto reservado ha sido registrado correctamente!'
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

	getGastos();

	function getGastos(){

		return $.ajax({

			type: 'post',

			url: './php/class/crud_gasto_reservados.php',

			data: {opc:'get_gasto'},

			dataType: "json",

			success: function (msg) {

				var d='<option value="0" selected="true" disabled="true">Seleccione un tipo de gasto</option>';

				$.each(msg,function(index,obj){

					var id = obj.id;
					var nombre_gasto = obj.nombre_gasto;
					
					d+= '<option value="'+id+'">'+nombre_gasto+'</option>';

				});

				$("#tipo_gasto").html(d);
				$("#tipo_gasto").select2({ height:"10px" });
			}

		});

	}
</script>