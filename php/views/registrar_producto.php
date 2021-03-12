<br>



<div class="container">
	<br>

	<center>
		<h3>Registro de producto</h3>
	</center>

	<br><br>
	<form id="frmProducto" name="frmProducto" method="POST">
		<input type="hidden" name="opc" id="opc" value="insert">
		<center>
			<div class="col-md-8">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="txtProducto">Nombre del producto *</label>
						<input type="text" class="form-control" id="txtProducto" name="txtProducto">
					</div>
					<div class="form-group col-md-6">
						<label for="txtCantidad">Cantidad *</label>
						<input type="number" min="1" class="form-control" id="txtCantidad" name="txtCantidad">
					</div>
				</div><br>
				<div class="form-group">
					<label for="txtDescripcion">Descripción del producto </label>
					<input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion">
				</div><br>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="precio_costo">Precio costo (unitario)</label>
						<input type="text" class="form-control decimales" id="precio_costo" name="precio_costo">
					</div>
					<div class="form-group col-md-6">
						<label for="precio_venta">Precio venta (unitario)</label>
						<input type="text" class="form-control decimales" id="precio_venta" name="precio_venta">
					</div>
				</div><br>
				<a href="?param=lista_producto" class="btn btn-info" style="float: left;">Lista de productos</a>
				<button type="button" class="btn btn-success" onclick="registrar_producto();" style="float: right;">Guardar producto</button>
			</div>
		</center>
		
		
	</form>
</div>





<?php require_once './php/views/footer.php'; ?>
<script type="text/javascript">
	$('.decimales').on('input', function () {
  this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
});
</script>
<script type="text/javascript">
	function registrar_producto() {
		if ($('#txtProducto').val().length == 0 ||
			$('#precio_costo').val().length == 0 ||
			$('#precio_venta').val().length == 0) {
			Swal.fire({
			  icon: 'error',
			  title: 'Ocurrió un error!',
			  text: 'Favor llene todos los datos requeridos (*)!'
			})
		}else{
			if ($('#txtCantidad').val() < 1) {
				Swal.fire({
				  icon: 'error',
				  title: 'Ocurrió un error!',
				  text: 'La cantidad de producto debe ser mayor a cero!'
				})
			}else{
				if ($('#precio_costo').val() == 0 || $('#precio_venta').val() == 0) {
					Swal.fire({
					  icon: 'error',
					  title: 'Ocurrió un error!',
					  text: 'El precio costo y precio venta debe ser mayor a cero!'
					})
				}else{
					$.post('./php/class/crud_productos.php',$('#frmProducto').serialize(),function(result){
						switch(result.trim()){
							case 'insert_ok':
								Swal.fire({
								  icon: 'success',
								  title: 'Bien hecho!',
								  text: 'El producto ha sido registrado correctamente!'
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
	}
</script>