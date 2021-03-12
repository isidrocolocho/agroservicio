<?php 
session_start();

include './connect.php';

if (isset($_POST['txtUser']) && isset($_POST['txtPass'])) {
	$usuario = $_POST['txtUser'];
	$clave = $_POST['txtPass'];

	$sqlVerify = "SELECT id FROM `usuarios` WHERE correo = '$usuario'";
	$queryVerify = $connect->query($sqlVerify);

	if (mysqli_num_rows($queryVerify) == 0) {
		echo "NOEMAIL";
	}else{
		$sqlPass = "SELECT id, nombre_completo, correo, telefono, estado,id_tipo_usuario FROM `usuarios` WHERE correo = '$usuario' and clave = MD5('$clave') and estado=1";
		$queryPass = $connect->query($sqlPass);

		if (mysqli_num_rows($queryPass) == 0) {
			echo "NOPASS";
		}else{
			$data = mysqli_fetch_assoc($queryPass);

			$estado = $data['estado'];

			if ($estado == 0) {
				echo "USERBLOCK";
			}else{
				$nombre = $data['nombre_completo'];
				$id_usuario = $data['id'];
				$correo = $data['correo'];
				$telefono = $data['telefono'];
				$id_tipo_usuario = $data['id_tipo_usuario'];

				$_SESSION['nombre_usuario'] = $nombre;
				$_SESSION['id_usuario'] = $id_usuario;
				$_SESSION['correo_usuario'] = $correo;
				$_SESSION['telefono_usuario'] = $telefono;
				$_SESSION['id_tipo_usuario'] = $id_tipo_usuario;

				$_SESSION['CLIENT_AUTHENTICATION_OK'] = "success";

				echo "LOGUED";
			}
		}
	}


}else{
	echo "NODATA";
}




 ?>