<br>


<div class="container">
	<center>
		<h3>Listado de Clientes</h3>
		<br>
	</center>

	<div class="table-wrap">
		<div class="table-responsive">
			<table id="productos" class="table table-hover display  pb-30">
				<thead>
					<tr>
						<th class="text-center">Nombre completo</th>
						<th class="text-center">Telefono</th>
						<th class="text-center">Direccion</th>
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


<br><br><br><br><br><br><br><br>


<?php require_once './php/views/footer.php'; ?>
<script type="text/javascript">
	getProducts();

	function getProducts(){

		return $.ajax({

			type: 'post',

			url: './php/class/crud_clientes.php',

			data: {opc:'get_usuarios'},

			dataType: "json",

			success: function (msg) {

				var d;

				$.each(msg,function(index,obj){

					var id = obj.id;
					var nombre_completo = obj.nombre_completo;
					
					var telefono = obj.telefono;
					
					var direccion = obj.direccion;
					var fecha_registro = obj.fecha_registro;
					var id_tipo_usuario = obj.id_tipo_usuario;

					d+= '<tr>'+

					'<td class="text-center">'+nombre_completo+'</td>'+

					

					'<td class="text-center">'+telefono+'</td>'+
					
					'<td class="text-center">'+direccion+'</td>'+


					'<td class="text-center">'+fecha_registro+'</td>'+

					'<td class="text-center"><a href="?param=editar_cliente&id='+id+'" class="btn btn-primary">Editar</a></td>'+

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