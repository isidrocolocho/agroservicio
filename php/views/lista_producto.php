<br>


<div class="container">
	<center>
		<h3>Listado de productos</h3>
		<br>
	</center>

	<div class="table-wrap">
		<div class="table-responsive">
			<table id="productos" class="table table-hover display  pb-30">
				<thead>
					<tr>
						<th class="text-center">Nombre Producto</th>
						<th class="text-center">Descripción</th>
						<th class="text-center">Cantidad / Existencia</th>
						<th class="text-center">Costo Unitario</th>
						<th class="text-center">Precio Venta</th>
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





<?php require_once './php/views/footer.php'; ?>
<script type="text/javascript">
	getProducts();

	function getProducts(){

		var value = JSON.stringify({"sucursal": "0" });

		return $.ajax({

			type: 'post',

			url: './php/class/get_productos.php',

			data: value,

			contentType: "application/json; charset=utf-8",

			dataType: "json",

			success: function (msg) {

				var d;

				$.each(msg,function(index,obj){

					var id = obj.id;
					var nombre = obj.nombre;
					var descripcion = obj.descripcion;
					var cantidad = obj.cantidad;
					var precio_costo = obj.precio_costo;
					var precio_venta = obj.precio_venta;
					var fecha_registro = obj.fecha_registro;
					//var estado = obj.estado;

					d+= '<tr>'+

					'<td class="text-center">'+nombre+'</td>'+

					'<td class="text-center">'+descripcion+'</td>'+

					'<td class="text-center">'+cantidad+'</td>'+

					'<td class="text-center">'+precio_costo+'</td>'+

					'<td class="text-center">'+precio_venta+'</td>'+

					'<td class="text-center">'+fecha_registro+'</td>'+

					//'<td class="text-center">'+estado+'</td>'+

					'<td class="text-center"><a href="?param=editar_producto&id='+id+'" class="btn btn-primary">Editar</a></td>'+

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
</script>