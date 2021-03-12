<br>


<div class="container">
	<center>
		<h3>Listado de Gastos Reservados</h3>
		<br>
	</center>

	<div class="table-wrap">
		<div class="table-responsive">
			<table id="gastos" class="table table-hover display  pb-30">
				<thead>
					<tr>
						<th class="text-center">Id</th>
						<th class="text-center">Tipo gasto</th>
						<th class="text-center">Descripcion</th>
						<th class="text-center">Total</th>
						<th class="text-center">Fecha pago</th>
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

			url: './php/class/crud_gasto_reservados.php',

			data: {opc:'get_gasto_reservado'},

			dataType: "json",

			success: function (msg) {

				var d;

				$.each(msg,function(index,obj){

					var id = obj.id;
					var descripcion = obj.descripcion;
					var total_pago = obj.total_pago;
					var fecha_registro = obj.fecha_registro;
					var fecha_pago = obj.fecha_pago;
					var tipo_pago = obj.tipo_pago;
					
					

					d+= '<tr>'+

					'<td class="text-center">'+id+'</td>'+

					'<td class="text-center">'+tipo_pago+'</td>'+

					'<td class="text-center">'+descripcion+'</td>'+

					'<td class="text-center">$'+total_pago+'</td>'+
					
					'<td class="text-center">'+fecha_pago+'</td>'+

					'<td class="text-center">'+fecha_registro+'</td>'+

					'<td class="text-center"><button data="'+id+'" class="btn btn-danger eliminar_gasto_reservado">Eliminar</button></td>'+

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

	$("#tbodyGastos").on('click','.eliminar_gasto_reservado',function () {
		var data = $(this).attr('data');
		Swal.fire({
			title: "!Atención!",
			text: "¿Seguro desea eliminar este gasto reservado?",
			icon: "info",
			confirmButtonColor: '#45ff4b',
			confirmButtonText: 'Aceptar',
			closeOnConfirm: false,
		}).then((result) => {
			if (result.value) {
				eliminar_gasto_reservado(data);
			}
		});
		return false;
	});

	function eliminar_gasto_reservado(id) {
		$.post('./php/class/crud_gasto_reservados.php',{opc:'eliminar_gasto_reservado',id},function(result){
			switch(result.trim()){
				case 'insert_ok':
				Swal.fire({
					icon: 'success',
					title: 'Bien hecho!',
					text: 'El gasto reservado ha sido registrado correctamente!'
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