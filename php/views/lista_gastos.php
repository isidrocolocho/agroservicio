<br>


<div class="container">
	<center>
		<h3>Listado de Gastos</h3>
		<br>
	</center>

	<div class="table-wrap">
		<div class="table-responsive">
			<table id="gastos" class="table table-hover display  pb-30">
				<thead>
					<tr>
						<th class="text-center">Id</th>
						<th class="text-center">Nombre del gasto</th>
						<th class="text-center">Estado</th>
						<th class="text-center">Fecha registro</th>
						<th class="text-center">Funciones</th>
					</tr>
				</thead>
				<tbody id="tbodyGastos">
				</tbody>
			</table>
		</div>
	</div>

</div>





<?php require_once './php/views/footer.php'; ?>
<script type="text/javascript">
	getGastos();

	function getGastos(){

		return $.ajax({

			type: 'post',

			url: './php/class/crud_gasto.php',

			data: {opc:'get_gasto'},

			dataType: "json",

			success: function (msg) {

				var d;

				$.each(msg,function(index,obj){

					var id = obj.id;
					var nombre_gasto = obj.nombre_gasto;
					var estado = obj.estado;
					var fecha_registro = obj.fecha_registro;
					var text_estado = "";
					var text_usuario = "";
					if (estado==1) {
						text_estado = "Activo";
					}else{
						text_estado = "Inactivo";
					}

					d+= '<tr>'+

					'<td class="text-center">'+id+'</td>'+

					'<td class="text-center">'+nombre_gasto+'</td>'+

					'<td class="text-center">'+text_estado+'</td>'+
					
					'<td class="text-center">'+fecha_registro+'</td>'+

					'<td class="text-center"><a href="?param=editar_gasto&id='+id+'" class="btn btn-primary">Editar</a></td>'+

					'</tr>';

				});

				$("#gastos").dataTable().fnDestroy();

				$("#tbodyGastos").empty();

				$("#gastos").append(d);

				$('#gastos').dataTable(

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