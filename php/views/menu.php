<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="?param=inicio">Cooperativa Cañera</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="?param=inicio">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Caja
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="?param=proceso_caja">Ingresos y salidas</a>
                    <a class="dropdown-item" href="?param=lista_ingresos_salidas">Lista de Ingresos y salidas</a>
                    <a class="dropdown-item" href="?param=reporte_caja">Reporte caja</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Productos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="?param=registrar_producto">Registrar producto</a>
                    <a class="dropdown-item" href="?param=lista_producto">Lista de productos</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTwo" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ventas
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownTwo">
                    <a class="dropdown-item" href="?param=registrar_venta">Registrar venta</a>
                    <a class="dropdown-item" href="?param=lista_ventas">Lista de ventas</a>
                    <a class="dropdown-item" href="?param=reporte_ventas">Reporte de ventas</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTwo" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Gastos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownTwo">
                    <a class="dropdown-item" href="?param=registrar_gasto">Registrar tipo gasto</a>
                    <a class="dropdown-item" href="?param=lista_gastos">Lista de tipo gasto</a>
                    <a class="dropdown-item" href="?param=registrar_gasto_reservado">Registrar gasto reservado</a>
                    <a class="dropdown-item" href="?param=lista_gastos_reservados">Lista de gasto reservado</a>
                </div>
            </li>
            <?php if ($_SESSION['id_tipo_usuario']==1 || $_SESSION['id_tipo_usuario']==3) {?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTwo" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Usuario
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownTwo">
                        <a class="dropdown-item" href="?param=registrar_usuario">Registrar usuario</a>
                        <a class="dropdown-item" href="?param=lista_usuarios">Lista de usuarios</a>
                    </div>
                </li>
            <?php } ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTwo" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Clientes
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownTwo">
                    <a class="dropdown-item" href="?param=registrar_cliente">Registrar cliente</a>
                    <a class="dropdown-item" href="?param=lista_clientes">Lista de clientes</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTwo" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Creditos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownTwo">
                    <a class="dropdown-item" href="?param=registrar_credito">Registrar credito</a>
                    <a class="dropdown-item" href="?param=lista_creditos">Lista de creditos</a>
                </div>
            </li>
        </ul>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo "Bienvenido(a) " . $_SESSION['nombre_usuario']; ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="./php/class/logout.php">Cerrar sesión</a>
            </div>
        </div>


    </div>
</nav>