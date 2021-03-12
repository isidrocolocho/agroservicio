<?php 
session_start();

include './connect.php';

$id_usuario = $_SESSION['id_usuario'];


if (isset($_POST['opc'])) {
	$opc = $_POST['opc'];

	switch ($opc) {
		case 'insert':

		$total = 0;

		$txtCliente = $_POST['txtCliente'];

		$txtPlazo = $_POST['txtPlazo'];		
		
		$nombre_producto = $_POST['selectProducto'];
		
		$cantidad = $_POST['txtCantidad'];
		$contador = count($cantidad);

		$sqlInsert = "INSERT INTO `credito`(`id_plazo`, `id_estado_credito`, `estado`, `fecha_venta`, `id_usuario`, `id_cliente`) VALUES ('$txtPlazo',1,1,NOW(),'$id_usuario','$txtCliente')";
		$queryInsert = $connect->query($sqlInsert);



		if ($queryInsert) {

			$id_credito = $connect->insert_id;
			
			for ($i = 0; $i < $contador; $i++) {

				$id_producto = $nombre_producto[$i];

				$cantidad_producto = $cantidad[$i];

				$sql = "SELECT precio_venta, cantidad FROM `producto` WHERE `id`='$id_producto'";
				$query = $connect->query($sql);
				$data = mysqli_fetch_assoc($query);
				$precio_venta = $data['precio_venta'];
				$stock_actual = $data['cantidad'];

				$newStock = $stock_actual - $cantidad_producto;

				$sqlStock = "update producto set cantidad = $newStock where id = $id_producto";
				$queryStock = $connect->query($sqlStock);

				$sqlIn = "INSERT INTO `detalles_creditos`(`id_credito`, `id_producto`, `cantidad`, `precio`, `fecha_venta`) VALUES ('$id_credito','$id_producto','$cantidad_producto','$precio_venta',NOW())";
				$queryIn = $connect->query($sqlIn);

				if ($queryIn) {
					$total++;
				}
			}
			
		}else{
			echo "error";
		}

		if ($contador==$total) {
			echo "insert_ok";
		}else{
			echo "error";
		}
		break;

		case 'lista':

		$sql = "SELECT c.id, c.fecha_venta,pc.duracion,ec.nombre AS estado_credito,cli.nombre_completo FROM credito c 
		INNER JOIN plazo_credito pc ON pc.id=c.id_plazo
		INNER JOIN estado_credito ec ON ec.id=c.id_estado_credito
		INNER JOIN cliente cli ON cli.id=c.id_cliente WHERE c.estado=1";
		$resultado = $connect->query($sql);

		//$fila =mysqli_fetch_assoc($resultado);

		while($fila =mysqli_fetch_assoc($resultado)){
			$id_venta = $fila['id'];

			$sql = "SELECT SUM(cantidad) AS total_productos,SUM(cantidad*precio) AS total_precio FROM detalles_creditos WHERE id_credito='$id_venta'";
			$query = $connect->query($sql);
			$data = mysqli_fetch_assoc($query);
			$total_productos = $data['total_productos'];
			$total_precio = $data['total_precio'];

			$array[] = new Producto($id_venta,$total_productos,$total_precio,$fila['fecha_venta'],$fila['duracion'],$fila['estado_credito'],$fila['nombre_completo']);

		}

		echo json_encode($array);
		break;


		case 'lista_venta':

		$id = $_POST['id'];

		$sql = "SELECT CONCAT(p.nombre,' ',p.descripcion) AS product,dv.cantidad,dv.precio AS precio_unitario,dv.cantidad*dv.precio as precio FROM detalles_creditos dv
		INNER JOIN producto p ON p.id=dv.id_producto
        WHERE dv.id_credito='$id'";
		$resultado = $connect->query($sql);

		//$fila =mysqli_fetch_assoc($resultado);

		while($fila =mysqli_fetch_assoc($resultado)){

			$array[] = new lista_venta($fila['product'],$fila['cantidad'],$fila['precio'],$fila['precio_unitario']);

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


class Producto

{

	var $id_venta;

	var $total_productos;

	var $total_precio;

	var $fecha;

	var $duracion;

	var $estado_credito;

	var $nombre_completo;


	function __construct($id_venta,$total_productos,$total_precio,$fecha,$duracion,$estado_credito,$nombre_completo)

	{

		$this->id_venta = $id_venta;

		$this->total_productos = $total_productos;

		$this->total_precio = $total_precio;

		$this->fecha = $fecha;

		$this->duracion = $duracion;

		$this->estado_credito = $estado_credito;

		$this->nombre_completo = $nombre_completo;


	}

}

class plazas

{

	var $id;

	var $duracion;


	function __construct($id,$duracion)

	{

		$this->id = $id;

		$this->duracion = $duracion;

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