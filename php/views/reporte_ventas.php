
<br>

<div class="container" id="lista_venta">
	<center>
		<h3>Reporte de Ventas</h3>
		<br>
	</center>

	<div class="table-wrap">
		<div class="table-responsive">
			<table id="productos" class="table table-hover display  pb-30">
				<thead>
					<tr>
						<th class="text-center">ID venta</th>
						<th class="text-center">Productos</th>
						<th class="text-center">Total venta</th>
						<th class="text-center">Costo Venta</th>
						<th class="text-center">Ganancia</th>
					</tr>
				</thead>
				<tbody id="tbodyProds">
				</tbody>
				<tfoot>
					<tr>
						<th class="text-center" colspan="2">Totales</th>
						<th class="text-center" id="id_total_venta"></th>
						<th class="text-center" id="id_total_costo"></th>
						<th class="text-center" id="id_total_ganancia"></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>

</div>
<?php require_once './php/views/footer.php'; ?>
<script type="text/javascript">
	getProducts();

	function getProducts(){

		/*var value = JSON.stringify({"sucursal": "0" });*/

		document.getElementById('lista_venta').style.display = 'block';

		return $.ajax({

			type: 'post',

			url: './php/class/crud_ventas.php',

			data: {opc:'lista_ganancia'},

			dataType: "json",

			success: function (msg) {

				var d;
				var total_precio_t = 0;
				var total_costo = 0;
				var total_ganacia = 0;

				var t;

				$.each(msg,function(index,obj){

					var id_venta = obj.id_venta;
					var nombre_producto = obj.nombre_producto;
					var total_precio = obj.total_precio;
					var costo_venta = obj.costo_venta;

					var ganancia = obj.ganancia;

					total_precio_t = total_precio_t+parseFloat(total_precio);
					total_costo = total_costo+parseFloat(costo_venta);
					total_ganacia = total_ganacia+parseFloat(ganancia);

					d+= '<tr>'+

					'<td class="text-center">'+id_venta+'</td>'+

					'<td class="text-center">'+nombre_producto+'</td>'+

					'<td class="text-center">$'+total_precio+'</td>'+

					'<td class="text-center">$'+costo_venta+'</td>'+
					'<td class="text-center">$'+ganancia+'</td>'+

					'</tr>';

				});

				$("#id_total_venta").html('$ '+total_precio_t.toFixed(2));
				$("#id_total_costo").html('$ '+total_costo.toFixed(2));
				$("#id_total_ganancia").html('$ '+total_ganacia.toFixed(2));

				$("#productos").dataTable().fnDestroy();

				$("#tbodyProds").empty();

				$("#productos").append(d);
				/*$("#productos").append($('<tfoot/>').append(t));*/

				$('#productos').dataTable({

					dom: 'B',
					buttons: [
					/*'copy', 'csv', 'excel', 'print', 'pdf'*/
					{ extend: 'copyHtml5', footer: true },
					{ extend: 'excelHtml5', footer: true },
					{ extend: 'csvHtml5', footer: true },
					{ extend: 'pdfHtml5', footer: true }
					],

					"iDisplayLength": -1,

					"aLengthMenu": [[-1, 'Todos']],

					"oLanguage": 

					{

						"sLengthMenu": "_MENU_ Registros por p&aacute;gina"

					} ,



				});

			}

		});

	}
</script>