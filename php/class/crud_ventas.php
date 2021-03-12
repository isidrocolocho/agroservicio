<?php 
session_start();

include './connect.php';

$id_usuario = $_SESSION['id_usuario'];


if (isset($_POST['opc'])) {
	$opc = $_POST['opc'];

	switch ($opc) {
		case 'insert':

		$total = 0;

		$nombre_producto = $_POST['selectProducto'];
		$reservada = $_POST['reservada'];
		
		$cantidad = $_POST['txtCantidad'];
		$contador = count($cantidad);

		$nuevo_total;

		$sqlInsert = "INSERT INTO `ventas`(`reservada`, `fecha`, `id_usuario`,`eliminado`) VALUES ('$reservada',NOW(),'$id_usuario','0')";
		$queryInsert = $connect->query($sqlInsert);

		$totalventa=0;
		$total_venta = 0;

		if ($queryInsert) {

			$id_venta = $connect->insert_id;
			
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

				$totalventa = $totalventa+$precio_venta*$cantidad_producto;

				$sqlIn = "INSERT INTO `detalles_venta`(`id_venta`, `id_producto`, `cantidad`, `precio`, `fecha_venta`) VALUES ('$id_venta','$id_producto','$cantidad_producto','$precio_venta',NOW())";
				$queryIn = $connect->query($sqlIn);

				if ($queryIn) {
					$total++;
				}
			}
			

			if ($reservada==0) {
				$sql_total = "SELECT `monto_actual` FROM `caja` WHERE `id`=1";
				$query_total = $connect->query($sql_total);
				$data_totales = mysqli_fetch_assoc($query_total);
				$monto_actual = $data_totales['monto_actual'];
				$nuevo_total = $monto_actual + (floatval($totalventa));
				$sqlIn_n = "UPDATE `caja` SET `monto_actual`=$nuevo_total WHERE `id`=1";
				$queryIn = $connect->query($sqlIn_n);
				$sqlIn_log = "INSERT INTO `log_caja`(`decripcion`, `estado`, `id_venta`, `total`,`caja`, `fecha`) VALUES ('Se registro la venta # $id_venta',3,'$id_venta','$totalventa','$nuevo_total',NOW())";
				$queryIn_log = $connect->query($sqlIn_log);
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

		$sql = "SELECT `id`,`reservada`, `fecha` FROM `ventas` WHERE `eliminado` = 0";
		$resultado = $connect->query($sql);

		//$fila =mysqli_fetch_assoc($resultado);

		while($fila =mysqli_fetch_assoc($resultado)){
			$id_venta = $fila['id'];

			$sql = "SELECT SUM(cantidad) AS total_productos,SUM(cantidad*precio) AS total_precio FROM detalles_venta WHERE id_venta='$id_venta'";
			$query = $connect->query($sql);
			$data = mysqli_fetch_assoc($query);
			$total_productos = $data['total_productos'];
			$total_precio = $data['total_precio'];

			$array[] = new Producto($id_venta,$total_productos,$total_precio,$fila['fecha'],$fila['reservada']);

		}

		echo json_encode($array);
		break;


		case 'lista_venta':

		$id = $_POST['id'];

		$sql = "SELECT CONCAT(p.nombre,' ',p.descripcion) AS product,dv.cantidad,dv.precio AS precio_unitario,dv.cantidad*dv.precio as precio FROM detalles_venta dv
		INNER JOIN producto p ON p.id=dv.id_producto
		WHERE dv.id_venta='$id'";
		$resultado = $connect->query($sql);

		//$fila =mysqli_fetch_assoc($resultado);

		while($fila =mysqli_fetch_assoc($resultado)){

			$array[] = new lista_venta($fila['product'],$fila['cantidad'],$fila['precio'],$fila['precio_unitario']);

		}

		echo json_encode($array);
		break;

		case 'lista_ganancia':

		$sql = "SELECT `id`,`reservada`, `fecha` FROM `ventas` WHERE `reservada` = 0";
		$resultado = $connect->query($sql);

		while($fila =mysqli_fetch_assoc($resultado)){
			$id_venta = $fila['id'];

			$sql = "SELECT SUM(dv.cantidad*dv.precio) AS total_precio,SUM(p.precio_costo*dv.cantidad) AS costo_venta,(SUM(dv.cantidad*dv.precio)-SUM(p.precio_costo*dv.cantidad)) AS ganancia FROM detalles_venta dv
			INNER JOIN producto p ON p.id=dv.id_producto WHERE dv.id_venta='$id_venta'";
			$query = $connect->query($sql);
			$data = mysqli_fetch_assoc($query);
			$total_precio = $data['total_precio'];
			$costo_venta = $data['costo_venta'];
			$ganancia = $data['ganancia'];
			$nombre_producto = '';

			$sql = "SELECT p.nombre AS nombre_producto FROM detalles_venta dv
			INNER JOIN producto p ON p.id=dv.id_producto WHERE dv.id_venta='$id_venta'";
			$resultado_p = $connect->query($sql);
			$n = 0;
			while($nombre =mysqli_fetch_assoc($resultado_p)){
				if ($n==0) {
					$nombre_producto .=$nombre['nombre_producto'];
				}else{
					$nombre_producto .=', '.$nombre['nombre_producto'];
				}
				$n++;
			}


			$array[] = new Ganacia($id_venta,$nombre_producto,$total_precio,$costo_venta,$ganancia);

		}

		echo json_encode($array);
		break;

		case 'eliminar_venta':

		$id = $_POST['id'];

		$sqlInsert = "UPDATE `ventas` SET `eliminado`=1 WHERE `id`='$id'";
		$queryInsert = $connect->query($sqlInsert);

		if ($queryInsert) {
			echo "insert_ok";
		}else{
			echo "error";
		}
		break;

		case 'quitar_reserva':

		$id = $_POST['id'];

		$sqlInsert = "UPDATE `ventas` SET `reservada`=0 WHERE `id`='$id'";
		$queryInsert = $connect->query($sqlInsert);

		if ($queryInsert) {
			echo "insert_ok";
		}else{
			echo "error";
		}
		break;

		case 'poner_reserva':

		$id = $_POST['id'];

		$sqlInsert = "UPDATE `ventas` SET `reservada`=1 WHERE `id`='$id'";
		$queryInsert = $connect->query($sqlInsert);

		if ($queryInsert) {
			echo "insert_ok";
		}else{
			echo "error";
		}
		break;

	}
}

class Ganacia

{

	var $id_venta;

	var $nombre_producto;

	var $total_precio;

	var $costo_venta;

	var $ganancia;


	function __construct($id_venta,$nombre_producto,$total_precio,$costo_venta,$ganancia)

	{

		$this->id_venta = $id_venta;

		$this->nombre_producto = $nombre_producto;

		$this->total_precio = $total_precio;

		$this->costo_venta = $costo_venta;

		$this->ganancia = $ganancia;


	}

}

class Producto

{

	var $id_venta;

	var $total_productos;

	var $total_precio;

	var $fecha;

	var $reservada;


	function __construct($id_venta,$total_productos,$total_precio,$fecha,$reservada)

	{

		$this->id_venta = $id_venta;

		$this->total_productos = $total_productos;

		$this->total_precio = $total_precio;

		$this->fecha = $fecha;

		$this->reservada = $reservada;


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