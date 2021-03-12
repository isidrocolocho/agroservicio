<br>


<div class="container">
	<center>
		<h3>Reporte de log caja </h3>
		<br>
	</center>

	<div class="table-wrap">
		<div class="table-responsive">
			<table id="productos" class="table table-hover display  pb-30">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Descripcion</th>
						<th class="text-center">Estado</th>
						<th class="text-center">Total</th>
						<th class="text-center">Caja</th>
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
			data: {opc:'log_caja'},

			dataType: "json",

			success: function (msg) {

				var d;

				$.each(msg,function(index,obj){

					var id = obj.id;
					var decripcion = obj.decripcion;
					var tipo_estado = obj.tipo_estado;
					var total = obj.total;
					var caja = obj.caja;
					var fecha = obj.fecha;
					var estado = obj.estado;
					var text_total ='';
					if (estado==1) {
						text_total ='-$ '+total;
					}else if (estado==2) {
						text_total ='- $'+total;
					}else if (estado==3) {
						text_total ='+ $'+total;
					}else if (estado==4) {
						text_total ='+ $'+total;
					}else if (estado==5) {
						text_total ='- $'+total;

					}


						d+= '<tr>'+

						'<td class="text-center">'+id+'</td>'+

						'<td class="text-center">'+decripcion+'</td>'+

						'<td class="text-center">'+tipo_estado+'</td>'+

						'<td class="text-center">'+text_total+'</td>'+

						'<td class="text-center">'+caja+'</td>'+

						'<td class="text-center">'+fecha+'</td>'+

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