<?php 
include './php/class/connect.php';

	if (isset($_GET['id'])) {
		$id_producto = $_GET['id'];

		$sqlProd = "select nombre, descripcion, cantidad, precio_costo, precio_venta from producto where id = $id_producto";
		$queryProd = $connect->query($sqlProd);

		if ($queryProd) {
			$dataProd = mysqli_fetch_assoc($queryProd);

			$nombre = $dataProd['nombre'];
			$descripcion = $dataProd['descripcion'];
			$cantidad = $dataProd['cantidad'];
			$precio_costo = $dataProd['precio_costo'];
			$precio_venta = $dataProd['precio_venta'];
		}
	}else{
		$nombre = "";
		$descripcion = "";
		$cantidad = "";
		$precio_costo = "";
		$precio_venta = "";
	}


 ?>

<br>

<div class="container">
	<br>

	<center>
		<h3>Registro de producto</h3>
	</center>

	<br><br>
	<form id="frmEditProducto" name="frmEditProducto" method="POST">
		<input type="hidden" name="opc" id="opc" value="upd">
		<input type="hidden" name="id_producto" id="id_producto" value="<?php echo $id_producto ?>">
		<center>
			<div class="col-md-8">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="txtProducto">Nombre del producto *</label>
						<input type="text" class="form-control" id="txtProducto" name="txtProducto" value="<?php echo $nombre ?>">
					</div>
					<div class="form-group col-md-6">
						<label for="txtCantidad">Cantidad *</label>
						<input type="number" min="1" class="form-control" id="txtCantidad" name="txtCantidad" value="<?php echo $cantidad ?>">
					</div>
				</div><br>
				<div class="form-group">
					<label for="txtDescripcion">Descripción del producto </label>
					<input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" value="<?php echo $descripcion ?>">
				</div><br>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="precio_costo">Precio costo (unitario)</label>
						<input type="text" class="form-control decimales" id="precio_costo" name="precio_costo" value="<?php echo $precio_costo ?>">
					</div>
					<div class="form-group col-md-6">
						<label for="precio_venta">Precio venta (unitario)</label>
						<input type="text" class="form-control decimales" id="precio_venta" name="precio_venta" value="<?php echo $precio_venta ?>">
					</div>
				</div><br>
				<a href="?param=lista_producto" class="btn btn-warning" style="float: left;">Cancelar</a>
				<button type="button" class="btn btn-success" onclick="actualizar_producto(<?php echo $id_producto ?>);" style="float: right;">Actualizar producto</button>
				<a href="javascript:;" onclick="eliminar_producto(<?php echo $id_producto; ?>)" class="btn btn-danger" style="float: left; margin-left: 3px;">Eliminar producto</a>
			</div>
		</center>
		
		
	</form>
</div>


<?php require_once './php/views/footer.php'; ?>
<script type="text/javascript">
	function eliminar_producto(pId) {
		Swal.fire({
		  title: 'Está seguro de borrar este producto?',
		  text: "Esta acción no se podrá revertir!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Borrar!'
		}).then((result) => {
		  if (result.isConfirmed) {
		  	$.post('./php/class/crud_productos.php',{"opc":"del","id_producto":pId},function(result){
		  		switch(result.trim()){
		  			case 'deleted':
		  				Swal.fire(
					      'Listo!',
					      'El producto ha sido borrado!',
					      'success'
					    ).then((result) => {
									$(location).attr('href','index.php?param=lista_producto');
                            });
		  			break;

		  			default:
		  				Swal.fire({
								  icon: 'error',
								  title: 'Ocurrió un error!',
								  text: 'Intente nuevamente, si el error persiste contacte al administrador!'
								})
		  			break;
		  		}
		  	});
		  }
		})
	}

	function actualizar_producto(){
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
					$.post('./php/class/crud_productos.php',$('#frmEditProducto').serialize(),function(result){
						switch(result.trim()){
							case 'update_ok':
								Swal.fire({
								  icon: 'success',
								  title: 'Bien hecho!',
								  text: 'El producto ha sido actualizado correctamente!'
								}).then((result) => {
									$(location).attr('href','index.php?param=lista_producto');
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