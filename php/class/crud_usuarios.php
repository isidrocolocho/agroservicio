<?php 
session_start();

include './connect.php';

$id_usuario = $_SESSION['id_usuario'];


if (isset($_POST['opc'])) {
	$opc = $_POST['opc'];

	switch ($opc) {
		case 'insert':

		$txtNombreC = $_POST['txtNombreC'];
		$txtEmail = $_POST['txtEmail'];
		$txtTelefono = $_POST['txtTelefono'];
		$txtusuario = $_POST['txtusuario'];
		$txtcontra = md5($_POST['txtcontra']);
		$txtDireccion = $_POST['txtDireccion'];


		$sqlInsert = "INSERT INTO `usuarios`(`nombre_completo`, `correo`, `clave`, `telefono`, `direccion`, `estado`, `fecha_registro`, `id_tipo_usuario`) VALUES ('$txtNombreC','$txtEmail','$txtcontra','$txtTelefono','$txtDireccion',1,NOW(),'$txtusuario')";
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

		$query="SELECT `id`, `nombre_completo`, `correo`, `telefono`, `direccion`, `estado`, `fecha_registro`, `id_tipo_usuario` FROM `usuarios` WHERE `estado`=1";

		$result = $connect->query($query);

		while (($fila = mysqli_fetch_array($result)) != NULL) {
			$array[] = new usuarios($fila['id'],$fila['nombre_completo'],$fila['correo'],$fila['telefono'],$fila['estado'],$fila['fecha_registro'],$fila['id_tipo_usuario'],$fila['direccion']);
		}
		echo json_encode($array);
		break;


		case 'get_un_usuarios':

		$id = $_POST['id'];

		$query="SELECT `id`, `nombre_completo`, `correo`, `telefono`, `direccion`, `estado`, `fecha_registro`, `id_tipo_usuario` FROM `usuarios` WHERE `estado`=1 AND id = '$id'";

		$result = $connect->query($query);

		while (($fila = mysqli_fetch_array($result)) != NULL) {
			$array[] = new usuarios($fila['id'],$fila['nombre_completo'],$fila['correo'],$fila['telefono'],$fila['estado'],$fila['fecha_registro'],$fila['id_tipo_usuario'],$fila['direccion']);
		}
		echo json_encode($array);
		break;

		case 'update':
		$id = $_POST['id'];
		$txtNombreC = $_POST['txtNombreC'];
		$txtEmail = $_POST['txtEmail'];
		$txtTelefono = $_POST['txtTelefono'];
		$txtusuario = $_POST['txtusuario'];
		$txtEstado = $_POST['txtEstado'];
		$txtDireccion = $_POST['txtDireccion'];


		$sqlInsert = "UPDATE `usuarios` SET `nombre_completo`='$txtNombreC',`correo`='$txtEmail',`telefono`='$txtTelefono',`direccion`='$txtDireccion',`estado`='$txtEstado',`id_tipo_usuario`='$txtusuario' WHERE `id`='$id'";
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

	var $correo;

	var $telefono;

	var $estado;

	var $fecha_registro;
	
	var $id_tipo_usuario;

	var $direccion;
	


	function __construct($id,$nombre_completo,$correo,$telefono,$estado,$fecha_registro,$id_tipo_usuario,$direccion)

	{

		$this->id = $id;

		$this->nombre_completo = $nombre_completo;

		$this->correo = $correo;

		$this->telefono = $telefono;

		$this->estado = $estado;
		
		$this->fecha_registro = $fecha_registro;
		
		$this->id_tipo_usuario = $id_tipo_usuario;

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