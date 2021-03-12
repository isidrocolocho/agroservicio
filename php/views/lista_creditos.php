<br>


<div class="container" id="lista_venta" style="display: none;">
	<center>
		<h3>Listado de Creditos</h3>
		<br>
	</center>

	<div class="table-wrap">
		<div class="table-responsive">
			<table id="productos" class="table table-hover display  pb-30">
				<thead>
					<tr>
						<th class="text-center">id</th>
						<th class="text-center">Cliente</th>
						<th class="text-center">Total producto</th>
						<th class="text-center">Total Cantidad</th>
						<th class="text-center">Estado</th>
						<th class="text-center">Fecha registro</th>
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
							<td>
								Estado Credito: <span id="estado_credito_detalles"></span><br>
								Nombre Cliente: <span id="nombre_cliente"></span>
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
			<tbody id="datos_tabla"></tbody>
	

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
	document.getElementById('detalle_venta').style.display = 'none';" >Regresar</button></div></center>
</div>

<?php require_once './php/views/footer.php'; ?>
<script type="text/javascript">
	getProducts();

	function getProducts(){

		/*var value = JSON.stringify({"sucursal": "0" });*/

		document.getElementById('lista_venta').style.display = 'block';

		return $.ajax({

			type: 'post',

			url: './php/class/crud_creditos.php',

			data: {opc:'lista'},

			dataType: "json",

			success: function (msg) {

				var d;

				$.each(msg,function(index,obj){

					var id_venta = obj.id_venta;
					var total_productos = obj.total_productos;
					var total_precio = obj.total_precio;
					var fecha = obj.fecha;
					var duracion = obj.duracion;
					var estado_credito = obj.estado_credito;
					var nombre_completo = obj.nombre_completo;

					var id_venta_2 = "'"+id_venta+"'";
					var total_productos_2 = "'"+total_productos+"'";
					var total_precio_2 = "'"+total_precio+"'";
					var fecha2 = "'"+fecha+"'";
					var duracion2 = "'"+duracion+"'";
					var estado_credito2 = "'"+estado_credito+"'";
					var nombre_completo2 = "'"+nombre_completo+"'";



					d+= '<tr>'+

					'<td class="text-center">'+id_venta+'</td>'+

					'<td class="text-center">'+nombre_completo+'</td>'+

					'<td class="text-center">'+total_productos+'</td>'+

					'<td class="text-center">$'+total_precio+'</td>'+

					'<td class="text-center">'+estado_credito+'</td>'+

					'<td class="text-center">'+fecha+'</td>'+

					'<td class="text-center"><a href="#" onclick="ver_venta('+id_venta_2+','+total_productos_2+','+total_precio_2+','+fecha2+','+duracion2+','+estado_credito2+','+nombre_completo2+')" class="btn btn-primary">Ver</a></td>'+

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

	function ver_venta(id,total_productos,total_precio,fecha,duracion,estado_credito,nombre_completo) {
		
		$.ajax({

			type: 'post',

			url: './php/class/crud_creditos.php',

			data: {opc:'lista_venta',id},

			dataType: "json",

			success: function (msg) {

				$("#n_id").html(id);
				$("#total_productos").html(total_precio);
				$("#fecha_venta").html(fecha);
				$("#nombre_cliente").html(nombre_completo);
				$("#estado_credito_detalles").html(estado_credito);

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
</script>