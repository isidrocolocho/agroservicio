<!DOCTYPE html>
<html>
<head>
	<title>Inicio de sesión | Tienda</title>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/sweetalert2.css">
	<link rel="stylesheet" type="text/css" href="../../css/style_login.css">
</head>
<body>
	<br>
	<center>
		<h2>Inicio de sesión</h2>
	</center>


	<form method="post" id="frmLogin" name="frmLogin">
		<div class="imgcontainer">
			<img src="../../img/img_avatar2.png" alt="Avatar" class="avatar" style="width: 8%;">
		</div>

		<div class="container col-md-4 text-center">
			<label for="uname"><b>Correo: </b></label>
			<input class="form-control" type="email" placeholder="escriba su correo" name="txtUser" id="txtUser" required="true" autocomplete="true">
			<br>
			<label for="psw"><b>Contraseña: </b></label>
			<input class="form-control" type="password" placeholder="escriba su contraseña" name="txtPass" id="txtPass" required="true">
			<br>
			<br>
			<button type="button" class="btn btn-success" onclick="autenticar();">Entrar</button>
		</div>
	</form>
	<footer style="position: absolute;
	bottom: 0;
	width: 100%;">
	<center><span>Derechos Reservados <?php echo date("Y"); ?> - Tienda / Cooperativa Cañera.</span></center>
</footer>

</body>
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../../js/sweetalert2.js"></script>
<script type="text/javascript" src="../../js/login.js"></script>
</html>