<?php 

session_start();

include("./connect.php");



	// Obtenemos el json enviado

	$json = file_get_contents('php://input');

	// Los convertimos en un array

	$data = json_decode( $json, true );


	$sql = "SELECT `id`, `nombre`, `descripcion`, `cantidad`, `precio_costo`, `precio_venta`, `fecha_registro`, `estado` FROM `producto` where estado = 1 ORDER BY `producto`.`fecha_registro` DESC";


	$resultado = $connect->query($sql);

	//$fila =mysqli_fetch_assoc($resultado);

	while($fila =mysqli_fetch_assoc($resultado)){

		//echo $filaHoy['parserby']."<br>";

		$array[] = new Producto($fila['id'],$fila['nombre'],$fila['descripcion'],$fila['cantidad'],$fila['precio_costo'],$fila['precio_venta'],$fila['fecha_registro'],$fila['estado']);

	}

	echo json_encode($array);



	//var_dump(json_encode($resultadoHoy));





/**

* 

*/

class Producto

{

	var $id;

	var $nombre;

	var $descripcion;

	var $cantidad;

	var $precio_costo;

	var $precio_venta;

	var $fecha_registro;

	var $estado;




	function __construct($id,$nombre,$descripcion,$cantidad,$precio_costo,$precio_venta,$fecha_registro,$estado)

	{

		$this->id = $id;

		$this->nombre = $nombre;

		$this->descripcion = $descripcion;

		$this->cantidad = $cantidad;

		$this->precio_costo = $precio_costo;

		$this->precio_venta = $precio_venta;

		$this->fecha_registro = $fecha_registro;

		$this->estado = $estado;

	}

}


mysqli_close($connect) ?>