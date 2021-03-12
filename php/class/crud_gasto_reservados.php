<?php 
session_start();

include './connect.php';

$id_usuario = $_SESSION['id_usuario'];


if (isset($_POST['opc'])) {
	$opc = $_POST['opc'];

	switch ($opc) {
		case 'insert':

		$Decripcion = $_POST['Decripcion'];
		$tipo_gasto = $_POST['tipo_gasto'];
		$fecha_pago = $_POST['fecha_pago'];
		$total_gasto = $_POST['total_gasto'];


		$sqlInsert = "INSERT INTO `gastos_reservados`(`descripcion`, `total_pago`, `fecha_registro`, `fecha_pago`, `id_gasto`, `id_usuario`) VALUES ('$Decripcion','$total_gasto',NOW(),'$fecha_pago','$tipo_gasto','$id_usuario')";
		$queryInsert = $connect->query($sqlInsert);

		if ($queryInsert) {

			$id_gasto = $connect->insert_id;

			$sql_total = "SELECT `monto_actual` FROM `caja` WHERE `id`=1";
			$query_total = $connect->query($sql_total);
			$data_totales = mysqli_fetch_assoc($query_total);
			$monto_actual = $data_totales['monto_actual'];
			
			$nuevo_total = $monto_actual - $total_gasto;

			$sqlIn_n = "UPDATE `caja` SET `monto_actual`=$nuevo_total WHERE `id`=1";
			$queryIn = $connect->query($sqlIn_n);

			$sqlIn_log = "INSERT INTO `log_caja`(`decripcion`, `estado`, `id_gasto`, `total`,`caja`, `fecha`) VALUES ('Se registro un gasto reservado ',1,'$id_gasto','$total_gasto','$nuevo_total',NOW())";
			$queryIn_log = $connect->query($sqlIn_log);

			echo "insert_ok";
		}else{
			echo "error";
		}
		
		break;

		case 'get_gasto':

		$query="SELECT `id`, `nombre`, `estado`, `fecha_registro` FROM `gastos`";

		$result = $connect->query($query);

		while (($fila = mysqli_fetch_array($result)) != NULL) {
			$array[] = new gastos($fila['id'],$fila['nombre'],$fila['estado'],$fila['fecha_registro']);
		}
		echo json_encode($array);
		break;

		case 'get_gasto_reservado':

		$query="SELECT gr.id , gr.descripcion, gr.total_pago,gr.fecha_registro,gr.fecha_pago,g.nombre AS tipo_pago FROM gastos_reservados gr 
		INNER JOIN gastos g ON g.id=gr.id_gasto WHERE gr.eliminado=0";

		$result = $connect->query($query);

		while (($fila = mysqli_fetch_array($result)) != NULL) {
			$array[] = new gastos_reservados($fila['id'],$fila['descripcion'],$fila['total_pago'],$fila['fecha_registro'],$fila['fecha_pago'],$fila['tipo_pago']);
		}
		echo json_encode($array);
		break;


		case 'get_un_gasto':

		$id = $_POST['id'];

		$query="SELECT `id`, `nombre`, `estado`, `fecha_registro` FROM `gastos` where id = '$id'";

		$result = $connect->query($query);

		while (($fila = mysqli_fetch_array($result)) != NULL) {
			$array[] = new gastos($fila['id'],$fila['nombre'],$fila['estado'],$fila['fecha_registro']);
		}
		echo json_encode($array);
		break;

		case 'update':
		$id = $_POST['id'];
		$txtGasto = $_POST['txtGasto'];
		$Estado = $_POST['slEstado'];


		$sqlInsert = "UPDATE `gastos` SET `nombre`='$txtGasto',`estado`='$Estado' WHERE `id`='$id'";
		$queryInsert = $connect->query($sqlInsert);

		if ($queryInsert) {
			echo "insert_ok";
		}else{
			echo "error";
		}
		
		break;

		case 'eliminar_gasto_reservado':
		$id = $_POST['id'];

		$sqlInsert = "UPDATE `gastos_reservados` SET `eliminado`=1 WHERE `id`='$id'";
		$queryInsert = $connect->query($sqlInsert);

		if ($queryInsert) {
			echo "insert_ok";
		}else{
			echo "error";
		}
		
		break;

		default:

		echo "Opcion no valida";
		
		break;
	}
}else{
	echo "opc no encontrado";
}


class gastos

{

	var $id;

	var $nombre_gasto;

	var $estado;

	var $fecha_registro;
	


	function __construct($id,$nombre_gasto,$estado,$fecha_registro)

	{

		$this->id = $id;

		$this->nombre_gasto = $nombre_gasto;

		$this->estado = $estado;

		$this->fecha_registro = $fecha_registro;


	}

}

class gastos_reservados

{

	var $id;

	var $descripcion;

	var $total_pago;

	var $fecha_registro;

	var $fecha_pago;

	var $tipo_pago;
	


	function __construct($id,$descripcion,$total_pago,$fecha_registro,$fecha_pago,$tipo_pago)

	{

		$this->id = $id;

		$this->descripcion = $descripcion;

		$this->total_pago = $total_pago;

		$this->fecha_registro = $fecha_registro;

		$this->fecha_pago = $fecha_pago;

		$this->tipo_pago = $tipo_pago;

	}

}

mysqli_close($connect) 


?>