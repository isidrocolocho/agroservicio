<?php if (isset($_GET['id'])) {
	$id = $_GET['id'];
}else{
	$id = 0;
} ?>
<br>



<div class="container">
	<br>

	<center>
		<h3>Actualizar gasto reservado</h3>
	</center>

	<br><br>
	<form id="frmGasto" name="frmGasto" method="POST">
		<input type="hidden" name="opc" id="opc" value="update">
		<input type="hidden" name="id" id="id" value="<?= $id ?>">
		<center>
			<div class="col-md-8">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="txtGasto">Nombre Gasto *</label>
						<input type="text" class="form-control" id="txtGasto" name="txtGasto">
					</div>
					<div class="form-group col-md-6">
						<label for="txtEmail">Estado *</label>
						<select class="form-control" id="slEstado" name="slEstado">
							<option selected="true" value="1">Activo</option>
							<option value="0">Inactivo</option>
						</select>
					</div>
				</div><br>
				
				<a href="?param=lista_gastos" class="btn btn-info" style="float: left;">Lista de gastos</a>
				<button type="button" class="btn btn-success" onclick="registrar_gasto();" style="float: right;">Actualizar gasto</button>
			</div>
		</center>
		
		
	</form>
</div>





<?php require_once './php/views/footer.php'; ?>
<script type="text/javascript">	
	var id = '<?= $id ?>';
	getGasto(id);

	function getGasto(id){

		$.ajax({

			type: 'post',

			url: './php/class/crud_gasto.php',

			data: {opc:'get_un_gasto',id},

			dataType: "json",

			success: function (msg) {

				var d;

				$.each(msg,function(index,obj){

					var id = obj.id;
					var nombre_gasto = obj.nombre_gasto;
					var estado = obj.estado;
					

					$("#txtGasto").val(nombre_gasto);
					$("#slEstado").val(estado).change();
				});

				

			}

		});

	}
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
						text: 'El gasto ha sido actualizado correctamente!'
					}).then((result) => {
						$(location).attr('href','?param=lista_gastos');
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