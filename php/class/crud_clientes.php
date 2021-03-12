<?php 
session_start();

include './connect.php';

$id_usuario = $_SESSION['id_usuario'];


if (isset($_POST['opc'])) {
	$opc = $_POST['opc'];

	switch ($opc) {
		case 'insert':

		$txtNombreC = $_POST['txtNombreC'];
		
		$txtTelefono = $_POST['txtTelefono'];
	
		$txtDireccion = $_POST['txtDireccion'];


		$sqlInsert = "INSERT INTO `cliente`(`nombre_completo`, `telefono`, `direccion`, `fecha_registro`, `id_usuario`) VALUES ('$txtNombreC','$txtTelefono','$txtDireccion',NOW(),'$id_usuario')";
		$queryInsert = $connect->query($sqlInsert);

		if ($queryInsert) {
			echo "insert_ok";
		}else{
			echo "error";
		}
		
		break;

		case 'get_tipo_usuario':

		$query="SELECT `id`, `nombre` FROM `tipo_usuario` WHERE `estado`=1";

		$result = $connect->query($query);

		echo '<option selected="true" disabled="true" value="0">selecione una calificacion</option>';
		while (($fila = mysqli_fetch_array($result)) != NULL) {
			echo '<option value="'.$fila["id"].'">'. $fila["nombre"].'</option>';
		}

		break;

		case 'get_usuarios':

		$query="SELECT `id`, `nombre_completo`, `telefono`, `direccion`, `fecha_registro`, `id_usuario` FROM `cliente`";

		$result = $connect->query($query);

		while (($fila = mysqli_fetch_array($result)) != NULL) {
			$array[] = new usuarios($fila['id'],$fila['nombre_completo'],$fila['telefono'],$fila['fecha_registro'],$fila['direccion']);
		}
		echo json_encode($array);
		break;


		case 'get_un_usuarios':

		$id = $_POST['id'];

		$query="SELECT `id`, `nombre_completo`, `telefono`, `direccion`, `fecha_registro`, `id_usuario` FROM `cliente` WHERE id = '$id'";

		$result = $connect->query($query);

		while (($fila = mysqli_fetch_array($result)) != NULL) {
			$array[] = new usuarios($fila['id'],$fila['nombre_completo'],$fila['telefono'],$fila['fecha_registro'],$fila['direccion']);
		}
		echo json_encode($array);
		break;

		case 'update':
		$id = $_POST['id'];
		$txtNombreC = $_POST['txtNombreC'];

		$txtTelefono = $_POST['txtTelefono'];
		
		$txtDireccion = $_POST['txtDireccion'];


		$sqlInsert = "UPDATE `cliente` SET `nombre_completo`='$txtNombreC',`telefono`='$txtTelefono',`direccion`='$txtDireccion' WHERE `id`='$id'";
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


class usuarios

{

	var $id;

	var $nombre_completo;

	var $telefono;


	var $fecha_registro;
	
	var $direccion;
	


	function __construct($id,$nombre_completo,$telefono,$fecha_registro,$direccion)

	{

		$this->id = $id;

		$this->nombre_completo = $nombre_completo;

		$this->telefono = $telefono;

	
		
		$this->fecha_registro = $fecha_registro;
		
		
		$this->direccion = $direccion;


	}

}

class lista_venta

{

	var $product;

	var $cantidad;

	var $precio;

	var $precio_unitario;

	


	function __construct($product,$cantidad,$precio,$precio_unitario)

	{

		$this->product = $product;

		$this->cantidad = $cantidad;

		$this->precio = $precio;

		$this->precio_unitario = $precio_unitario;

	}

}


mysqli_close($connect) 


?>