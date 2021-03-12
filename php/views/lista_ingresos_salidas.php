<br>


<div class="container">
	<center>
		<h3>Listado de Ingresos y salidas </h3>
		<br>
	</center>

	<div class="table-wrap">
		<div class="table-responsive">
			<table id="productos" class="table table-hover display  pb-30">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Descripcion</th>
						<th class="text-center">Total</th>
						<th class="text-center">Estado</th>
						<th class="text-center">Fecha</th>
						<th class="text-center">Fecha registro</th>
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

		return $.ajax({

			type: 'post',

			url: './php/class/crud_caja.php',
			data: {opc:'lista_ingreso_retiro'},

			dataType: "json",

			success: function (msg) {

				var d;

				$.each(msg,function(index,obj){

					var id = obj.id;
					var descripcion = obj.descripcion;
					var estado = obj.estado;
					var total = obj.total;
					var fecha_creacion = obj.fecha_creacion;
					var fecha = obj.fecha;
					if (estado==1) {
						text_estado = "Abono";
					}else{
						text_estado = "Retiro";
					}

					d+= '<tr>'+

					'<td class="text-center">'+id+'</td>'+

					'<td class="text-center">'+descripcion+'</td>'+

					'<td class="text-center">$ '+total+'</td>'+
					
					'<td class="text-center">'+text_estado+'</td>'+

					'<td class="text-center">'+fecha+'</td>'+

					'<td class="text-center">'+fecha_creacion+'</td>'+

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