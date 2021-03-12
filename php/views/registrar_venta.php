<br>
<style>
	.select2-container{
		width: 100%;
		height: 100%;
	}
</style>


<div class="container">
	<div class="text-center">

		<br>

		<center>
			<h3>Registro venta</h3>
		</center>

		<br><br>
		<form id="frmVenta" name="frmVenta" method="POST">
			<input type="hidden" name="opc" id="opc" value="insert">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-md-9">
					
					<div class="container">
						<div class="row">
							<div class="col-md-4"><br></div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="reservada">¿Es una venta reservada? *</label>
									<select  class="form-control" id="reservada" name="reservada">
										<option selected="true" value="0">No</option>
										<option value="1">Si</option>
									</select>
								</div>
							</div>
						</div><br>
					</div>
					
					<div class="container" id="divContenedor">
						
					</div>
					<a href="?param=lista_ventas" class="btn btn-info" style="float: left;">Lista de ventas</a>
					<button type="button" class="btn btn-primary" onclick="agregarProducto()">Agregar producto</button>
					<button type="button" class="btn btn-success" onclick="registrar_venta();" style="float: right;">Guardar venta</button>
				</div>
			</div>

		</form>
	</div>
</div>





<?php require_once './php/views/footer.php'; ?>

<script type="text/javascript">
	cont_producto=0;
	agregarProducto();
	function agregarProducto() {
		cont_producto++;
		var agregar = '<div class="row" id="div'+cont_producto+'">'+
		'<div class="col-md-5">'+
		'<div class="form-group">'+
		'<label for="selectProducto">Nombre del producto *</label>'+
		'<select style="height: 20px;" class="form-control select2 agregar_producto" id="selectProducto'+cont_producto+'" name="selectProducto[]"></select>'+
		'</div>'+
		'</div>'+
		'<div class="col-md-4">'+
		'<div class="form-group">'+
		'<label for="txtCantidad">Cantidad* </label>'+
		'<input type="number" class="form-control cantidad_producto" min="1" value="1" id="txtCantidad'+cont_producto+'" name="txtCantidad[]">'+
		'</div>'+
		'</div>'+
		'<div class="col-md-3">'+
		'<br><button  class="btn btn-danger" onclick=eliminar_producto("div'+cont_producto+'")>Eliminar</button>'+
		'</div>'+
		'</div><br>';
		$("#divContenedor").append(agregar);
		getProducts(cont_producto);
	}
	function eliminar_producto(id) {
		if (cont_producto<2) {
			Swal.fire({
				icon: 'error',
				title: 'Alerta',
				text: 'No puede borrar este producto!'
			})
		}else{
			cont_producto--;
			$('#'+id).remove(); 
		}
	}

	function getProducts(cont_producto){

		var value = JSON.stringify({"sucursal": "0" });

		return $.ajax({

			type: 'post',

			url: './php/class/get_productos.php',

			data: value,

			contentType: "application/json; charset=utf-8",

			dataType: "json",

			success: function (msg) {

				var d='<option value="0" selected="true" disabled="true">Seleccione un producto</option>';

				$.each(msg,function(index,obj){

					var id = obj.id;
					var nombre = obj.nombre;
					var cantidad = obj.cantidad;
					if (cantidad > 0) {
						d+= '<option data-limit="'+cantidad+'" data-identificador="selectProducto'+cont_producto+'" value="'+id+'">'+nombre+'</option>';
					}
				});
				$("#selectProducto"+cont_producto).html(d);
				$("#selectProducto"+cont_producto).select2({ height:"10px" });
			}

		});

	}

	/*$("#divContenedor").on('change','.agregar_producto',function (e) {
		var limite = $(this).attr('data-limit');
		var identificador = $(this).attr('data-identificador');
		console.log(this);
		console.log(e);
		console.log(limite);
		console.log(identificador);
	});*/
</script>
<script type="text/javascript">
	function registrar_venta() {
		var selectProducto = document.getElementsByClassName('agregar_producto');
		for (var j = 0; j < selectProducto.length; j++) {
			if (selectProducto[j].selectedIndex === "" || selectProducto[j].selectedIndex === 0 || selectProducto[j].selectedIndex === null)  {
				Swal.fire({
					title: "Atención!",
					text: "Se olvido seleccionar un producto.",
					icon: "info",
					confirmButtonColor: '#45ff4b',
					confirmButtonText: 'Aceptar',
					closeOnConfirm: false,
				});
				return false;
			}  
		}
		var txtCantidad = document.getElementsByClassName('cantidad_producto');
		for (var k = 0; k < txtCantidad.length; k++) {
			console.log(txtCantidad[k]);
			if (txtCantidad[k].value.length == 0 || txtCantidad[k].value == 0 || txtCantidad[k].value == null)  {
				Swal.fire({
					title: "Atención!",
					text: "Se olvido agregar una cantidad.",
					icon: "info",
					confirmButtonColor: '#45ff4b',
					confirmButtonText: 'Aceptar',
					closeOnConfirm: false,
				});
				return false;
			}  
		}

		$.post('./php/class/crud_ventas.php',$('#frmVenta').serialize(),function(result){
			//console.log(result);
			switch(result.trim()){
				case 'insert_ok':
				Swal.fire({
					icon: 'success',
					title: 'Bien hecho!',
					text: 'La venta ha sido registrada correctamente!'
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

</script>