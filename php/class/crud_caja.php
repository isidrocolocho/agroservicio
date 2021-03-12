<?php 
session_start();

include './connect.php';

$id_usuario = $_SESSION['id_usuario'];


if (isset($_POST['opc'])) {
	$opc = $_POST['opc'];

	switch ($opc) {
		case 'insert':

		$Decripcion = mysqli_real_escape_string($connect,$_POST['Decripcion']);

		$fecha = $_POST['fecha'];		
		
		$total = $_POST['total'];
		
		$estado = $_POST['estado'];
		

		$sqlInsert = "INSERT INTO `retiros_abonos`(`descripcion`, `estado`, `total`, `fecha_creacion`, `fecha`) VALUES ('$Decripcion','$estado','$total',NOW(),'$fecha')";
		$queryInsert = $connect->query($sqlInsert);



		if ($queryInsert) {

			$id_retiros_abonos = $connect->insert_id;

			$sql_total = "SELECT `monto_actual` FROM `caja` WHERE `id`=1";
			$query_total = $connect->query($sql_total);
			$data_totales = mysqli_fetch_assoc($query_total);
			$monto_actual = $data_totales['monto_actual'];

			if ($estado==1) {
				$nuevo_total = $monto_actual + $total;
				$estado_caja = 4;
			}else{
				$nuevo_total = $monto_actual - $total;
				$estado_caja = 5;
			}
			

			$sqlIn_n = "UPDATE `caja` SET `monto_actual`=$nuevo_total WHERE `id`=1";
			$queryIn = $connect->query($sqlIn_n);

			$sqlIn_log = "INSERT INTO `log_caja`(`decripcion`, `estado`, `id_proceso_caja`, `total`, `caja` ,`fecha`) VALUES ('$Decripcion','$estado_caja','$id_retiros_abonos','$total','$nuevo_total',NOW())";
			$queryIn_log = $connect->query($sqlIn_log);

			
			echo "insert_ok";
		}else{
			echo "error";
		}
		break;

		case 'lista_ingreso_retiro':

		$sql = "SELECT `id`, `descripcion`, `estado`, `total`, `fecha_creacion`, `fecha` FROM `retiros_abonos` ";
		$resultado = $connect->query($sql);


		while($fila =mysqli_fetch_assoc($resultado)){
			$array[] = new lista_ingreso_retiro($fila['id'],$fila['descripcion'],$fila['estado'],$fila['total'],$fila['fecha_creacion'],$fila['fecha']);

		}

		echo json_encode($array);
		break;


		case 'log_caja':

		$sql = "SELECT lc.id, lc.decripcion, lc.estado,elc.nombre AS tipo_estado ,lc.id_venta, lc.id_producto, lc.id_gasto, lc.id_proceso_caja, lc.total, lc.caja, lc.fecha FROM log_caja lc
		INNER JOIN estado_log_caja elc ON elc.id=lc.estado ORDER BY lc.id";
		$resultado = $connect->query($sql);

		//$fila =mysqli_fetch_assoc($resultado);

		while($fila =mysqli_fetch_assoc($resultado)){

			$array[] = new log_caja($fila['id'],$fila['decripcion'],$fila['tipo_estado'],$fila['total'],$fila['caja'],$fila['fecha'],$fila['estado']);

		}

		echo json_encode($array);
		break;

		case 'get_plazos':

		$sql = "SELECT `id`, `duracion` FROM `plazo_credito` WHERE `estado`=1";
		$resultado = $connect->query($sql);

		//$fila =mysqli_fetch_assoc($resultado);

		while($fila =mysqli_fetch_assoc($resultado)){

			$array[] = new plazas($fila['id'],$fila['duracion']);

		}

		echo json_encode($array);
		break;
	}
}


class lista_ingreso_retiro

{

	var $id;

	var $descripcion;

	var $estado;

	var $total;

	var $fecha_creacion;

	var $fecha;


	function __construct($id,$descripcion,$estado,$total,$fecha_creacion,$fecha)

	{

		$this->id = $id;

		$this->descripcion = $descripcion;

		$this->estado = $estado;

		$this->total = $total;

		$this->fecha_creacion = $fecha_creacion;

		$this->fecha = $fecha;

	}

}

class log_caja

{

	var $id;

	var $decripcion;
	
	var $tipo_estado;

	var $total;

	var $caja;

	var $fecha;

	var $estado;


	function __construct($id,$decripcion,$tipo_estado,$total,$caja,$fecha,$estado)

	{

		$this->id = $id;

		$this->decripcion = $decripcion;

		$this->tipo_estado = $tipo_estado;

		$this->total = $total;

		$this->caja = $caja;

		$this->fecha = $fecha;

		$this->estado = $estado;

	}

}

mysqli_close($connect) 


?>