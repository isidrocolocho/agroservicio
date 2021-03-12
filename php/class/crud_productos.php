<?php 
session_start();

include './connect.php';

$id_usuario = $_SESSION['id_usuario'];


if (isset($_POST['opc'])) {
	$opc = $_POST['opc'];

	switch ($opc) {
		case 'insert':

		$nombre_producto = $_POST['txtProducto'];
		if (isset($_POST['txtDescripcion'])) {
			$descripcion_producto = $_POST['txtDescripcion'];
		}else{
			$descripcion_producto = "";
		}
		$cantidad = $_POST['txtCantidad'];
		$precio_costo = $_POST['precio_costo'];
		$precio_venta = $_POST['precio_venta'];

		$sqlInsert = "insert into producto (nombre,descripcion,cantidad,precio_costo,precio_venta,fecha_registro,estado,id_usuario) VALUES ('$nombre_producto','$descripcion_producto','$cantidad','$precio_costo','$precio_venta',now(),1,$id_usuario)";
		$queryInsert = $connect->query($sqlInsert);

		if ($queryInsert) {

			$id_producto = $connect->insert_id;

			$sql_total = "SELECT `monto_actual` FROM `caja` WHERE `id`=1";
			$query_total = $connect->query($sql_total);
			$data_totales = mysqli_fetch_assoc($query_total);
			$monto_actual = $data_totales['monto_actual'];

			$cantidad_producto= $cantidad*$precio_costo;

			$nuevo_total = $monto_actual - $cantidad*$precio_costo;

			$sqlIn_n = "UPDATE `caja` SET `monto_actual`=$nuevo_total WHERE `id`=1";
			$queryIn = $connect->query($sqlIn_n);

			$sqlIn_log = "INSERT INTO `log_caja`(`decripcion`, `estado`, `id_producto`, `total`, `caja`, `fecha`) VALUES ('Se registro el producto $nombre_producto',2,'$id_producto','$cantidad_producto','$nuevo_total',NOW())";
			$queryIn_log = $connect->query($sqlIn_log);

			echo "insert_ok";
		}else{
			echo "error";
		}
		break;

		case 'del':
		$id_producto = $_POST['id_producto'];

		$sqlDel = "update producto set estado = 0 where id = $id_producto";
		$queryDel = $connect->query($sqlDel);

		if ($queryDel) {
			echo "deleted";
		}else{
			echo "errordel";
		}
		break;

		case 'upd':

		$id_producto = $_POST['id_producto'];
		$nombre_producto = $_POST['txtProducto'];
		if (isset($_POST['txtDescripcion'])) {
			$descripcion_producto = $_POST['txtDescripcion'];
		}else{
			$descripcion_producto = "";
		}
		$cantidad = $_POST['txtCantidad'];
		$precio_costo = $_POST['precio_costo'];
		$precio_venta = $_POST['precio_venta'];

		$sqlUpd = "update producto set nombre = '$nombre_producto', descripcion = '$descripcion_producto', cantidad = '$cantidad', precio_costo = '$precio_costo', precio_venta = '$precio_venta' where id = '$id_producto'";
		$queryUpd = $connect->query($sqlUpd);

		if ($queryUpd) {
			echo "update_ok";
		}else{
			echo "errorupd";
		}
		break;
	}
}





?>