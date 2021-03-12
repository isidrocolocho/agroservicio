<br>


<div class="container" id="lista_venta" style="display: none;">
	<center>
		<h3>Listado de ventas</h3>
		<br>
	</center>

	<div class="table-wrap">
		<div class="table-responsive">
			<table id="productos" class="table table-hover display  pb-30">
				<thead>
					<tr>
						<th class="text-center">id</th>
						<th class="text-center">Total producto</th>
						<th class="text-center">Total Cantidad</th>
						<th class="text-center">Fecha registro</th>
						<th class="text-center">Tipo de venta</th>
						<th class="text-center">Funciones</th>
					</tr>
				</thead>
				<tbody id="tbodyProds">
				</tbody>
			</table>
		</div>
	</div>

</div>

<style>
	.invoice-box {
		max-width: 800px;
		margin: auto;
		padding: 30px;
		border: 1px solid #eee;
		box-shadow: 0 0 10px rgba(0, 0, 0, .15);
		font-size: 16px;
		line-height: 24px;
		font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
		color: #555;
	}

	.invoice-box table {
		width: 100%;
		line-height: inherit;
		text-align: left;
	}

	.invoice-box table td {
		padding: 5px;
		vertical-align: top;
	}

	.invoice-box table tr td:nth-child(2) {
		text-align: right;
	}

	.invoice-box table tr.top table td {
		padding-bottom: 20px;
	}

	.invoice-box table tr.top table td.title {
		font-size: 45px;
		line-height: 45px;
		color: #333;
	}

	.invoice-box table tr.information table td {
		padding-bottom: 40px;
	}

	.invoice-box table tr.heading td {
		background: #eee;
		border-bottom: 1px solid #ddd;
		font-weight: bold;
	}

	.invoice-box table tr.details td {
		padding-bottom: 20px;
	}

	.invoice-box table tr.item td{
		border-bottom: 1px solid #eee;
	}

	.invoice-box table tr.item.last td {
		border-bottom: none;
	}

	.invoice-box table tr.total td:nth-child(2) {
		border-top: 2px solid #eee;
		font-weight: bold;
	}

	@media only screen and (max-width: 600px) {
		.invoice-box table tr.top table td {
			width: 100%;
			display: block;
			text-align: center;
		}

		.invoice-box table tr.information table td {
			width: 100%;
			display: block;
			text-align: center;
		}
	}

	/** RTL **/
	.rtl {
		direction: rtl;
		font-family: Tahoma, "Helvetica Neue","Helvetica", Helvetica, Arial, sans-serif;
	}

	.rtl table {
		text-align: right;
	}

	.rtl table tr td:nth-child(2) {
		text-align: left;
	}
</style>

<div class="container" id="detalle_venta" style="display: none;">
	<div class="invoice-box" >
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr class="top">
				<td colspan="4">
					<table width="100%">
						<tr>
							<td class="title">
							</td>
							<td></td>

							<td style="text-align:right;">
								Orden #: <span id="n_id"></span><br>
								Creada: <span id="fecha_venta"></span><br>
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr class="heading">
				<td>
					Producto
				</td>
				<td class="text-center">Cantidad</td>
				<td class="text-center">Precio Unitario</td>
				<td style="text-align:right;">
					Sub Total
				</td>
			</tr>
			<tbody id="datos_tabla">
				
			</tbody>

			<tr class="total">
				<td colspan="4" style="text-align:right;">
					Total: $ <span id="total_productos"></span>
				</td>
			</tr>
		</table>


	</div>
	<br><br>
	<center>
		<div class="col-ms-5">
			<button type="button" class="btn btn-secondary" onclick="document.getElementById('lista_venta').style.display = 'block';
			document.getElementById('detalle_venta').style.display = 'none';" >Regresar</button>&nbsp;&nbsp;
			<button type="button" class="btn btn-danger" onclick="alerta_venta()" >Eliminar venta</button>&nbsp;&nbsp;
			<button type="button" class="btn btn-primary" id="btn_quitar_reserva" onclick="alerta_quitar_reserva()" >Cambiar a venta sin reservada</button>&nbsp;&nbsp;
			<button type="button" class="btn btn-primary" id="btn_poner_reserva" onclick="alerta_poner_reserva()" >Cambiar a venta reservada</button>&nbsp;&nbsp;
		</div>
	</center>
</div>
<input type="hidden" name="id_venta_activa" id="id_venta_activa">
<?php require_once './php/views/footer.php'; ?>
<script type="text/javascript">
	getProducts();

	function getProducts(){

		/*var value = JSON.stringify({"sucursal": "0" });*/

		document.getElementById('lista_venta').style.display = 'block';

		return $.ajax({

			type: 'post',

			url: './php/class/crud_ventas.php',

			data: {opc:'lista'},

			dataType: "json",

			success: function (msg) {

				var d;

				$.each(msg,function(index,obj){

					var id_venta = obj.id_venta;
					var total_productos = obj.total_productos;
					var total_precio = obj.total_precio;
					var fecha = obj.fecha;

					var reservada = obj.reservada;

					var id_venta_2 = "'"+id_venta+"'";
					var total_productos_2 = "'"+total_productos+"'";
					var total_precio_2 = "'"+total_precio+"'";
					var fecha2 = "'"+fecha+"'";
					var tipo_reserva = "'"+reservada+"'";

					var estado_resevado = "";
					if (reservada==1) {
						estado_resevado = "reservada";
					}
					//var estado = obj.estado;

					d+= '<tr>'+

					'<td class="text-center">'+id_venta+'</td>'+

					'<td class="text-center">'+total_productos+'</td>'+

					'<td class="text-center">$'+total_precio+'</td>'+

					'<td class="text-center">'+fecha+'</td>'+
					'<td class="text-center">'+estado_resevado+'</td>'+

					'<td class="text-center"><a href="#" onclick="ver_venta('+id_venta_2+','+total_productos_2+','+total_precio_2+','+fecha2+','+tipo_reserva+')" class="btn btn-primary">Ver</a></td>'+

					'</tr>';

				});

				$("#productos").dataTable().fnDestroy();

				$("#tbodyProds").empty();

				$("#productos").append(d);

				$('#productos').dataTable(

				{
					dom: 'Bfrtip',
					buttons: [
					'copy', 'csv', 'excel', 'print', 'pdf'
					],

					"iDisplayLength": 10,

					"aLengthMenu": [[5, 5], [10, 10], [25, 25], [50, 50]],

					"oLanguage": 

					{

						"sLengthMenu": "_MENU_ Registros por p&aacute;gina"

					} ,



				});

			}

		});

	}

	function ver_venta(id,total_productos,total_precio,fecha,tipo_reserva) {

		$.ajax({

			type: 'post',

			url: './php/class/crud_ventas.php',

			data: {opc:'lista_venta',id},

			dataType: "json",

			success: function (msg) {

				$("#n_id").html(id);
				$("#total_productos").html(total_precio);
				$("#fecha_venta").html(fecha);
				$("#id_venta_activa").val(id);

				if (tipo_reserva===0) {
					$("#btn_poner_reserva").show();
					$("#btn_quitar_reserva").hide();
				}else{
					$("#btn_poner_reserva").hide();
					$("#btn_quitar_reserva").show();
				}



				document.getElementById('lista_venta').style.display = 'none';
				document.getElementById('detalle_venta').style.display = 'block';

				var d;

				$.each(msg,function(index,obj){

					var product = obj.product;
					var cantidad = obj.cantidad;
					var precio = obj.precio;
					var precio_unitario = obj.precio_unitario;

					//var estado = obj.estado;

					d+= '<tr class="item">'+

					'<td> '+product+' </td>'+
					'<td class="text-center">'+cantidad+'</td>'+
					'<td class="text-center">$'+precio_unitario+'</td>'+
					'<td style="text-align:right;">$'+precio+'</td></tr>';

				});

				$("#datos_tabla").html(d);



			}

		});

	}

	function alerta_venta() {
		Swal.fire({
			title: 'Está seguro de borrar esta venta?',
			text: "Esta acción no se podrá revertir!",
			icon: 'warning',
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, Borrar!'
		}).then((result) => {
			if (result.isConfirmed) {
				var id = $("#id_venta_activa").val();
				$.post('./php/class/crud_ventas.php',{opc:'eliminar_venta',id},function(result){
					switch(result.trim()){
						case 'insert_ok':
						Swal.fire({
							icon: 'success',
							title: 'Bien hecho!',
							text: 'La venta ha sido eliminado correctamente!'
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
		});

	}

	function alerta_quitar_reserva() {
		Swal.fire({
			title: 'Está seguro de este cambio?',
			text: "Cambiar venta a sin reservada!",
			icon: 'warning',
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, Borrar!'
		}).then((result) => {
			if (result.isConfirmed) {
				var id = $("#id_venta_activa").val();
				$.post('./php/class/crud_ventas.php',{opc:'quitar_reserva',id},function(result){
					switch(result.trim()){
						case 'insert_ok':
						Swal.fire({
							icon: 'success',
							title: 'Bien hecho!',
							text: 'La venta ha sido actualizada correctamente!'
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
		});
	}

	function alerta_poner_reserva() {
		Swal.fire({
			title: 'Está seguro de este cambio?',
			text: "Cambiar venta a reservada!",
			icon: 'warning',
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, Borrar!'
		}).then((result) => {
			if (result.isConfirmed) {
				var id = $("#id_venta_activa").val();
				$.post('./php/class/crud_ventas.php',{opc:'poner_reserva',id},function(result){
					switch(result.trim()){
						case 'insert_ok':
						Swal.fire({
							icon: 'success',
							title: 'Bien hecho!',
							text: 'La venta ha sido actualizada correctamente!'
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
		});
	}
</script>