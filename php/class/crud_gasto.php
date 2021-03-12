<?php 
session_start();

include './connect.php';

$id_usuario = $_SESSION['id_usuario'];


if (isset($_POST['opc'])) {
	$opc = $_POST['opc'];

	switch ($opc) {
		case 'insert':

		$txtGasto = $_POST['txtGasto'];
		$estado = $_POST['slEstado'];


		$sqlInsert = "INSERT INTO `gastos`(`nombre`, `estado`, `id_usuario`, `fecha_registro`) VALUES ('$txtGasto','$estado','$id_usuario',NOW())";
		$queryInsert = $connect->query($sqlInsert);

		if ($queryInsert) {
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

mysqli_close($connect) 


?>