<div class="d-flex flex-column flex-shrink-0 p-3 text-white" style="width: 250px; height: 100vh; background-color: #34495e;">
    <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <i class="fas fa-store me-2"></i><span class="fs-4 fw-bold">Kiosco Smart</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item"><a href="index.php" class="nav-link text-white"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
        <li><a href="index.php?seccion=roles&accion=listar" class="nav-link text-white"><i class="fas fa-user-shield me-2"></i>Roles</a></li>
        <li><a href="index.php?seccion=categorias&accion=listar" class="nav-link text-white"><i class="fas fa-tags me-2"></i>Categorías</a></li>
        <li><a href="index.php?seccion=metodospago&accion=listar" class="nav-link text-white"><i class="fas fa-credit-card me-2"></i>Métodos de Pago</a></li>
        <li><a href="index.php?seccion=clientes&accion=listar" class="nav-link text-white"><i class="fas fa-users me-2"></i>Clientes</a></li>
        <li><a href="index.php?seccion=proveedores&accion=listar" class="nav-link text-white"><i class="fas fa-truck me-2"></i>Proveedores</a></li>
        <li><a href="index.php?seccion=productos&accion=listar" class="nav-link text-white"><i class="fas fa-box me-2"></i>Productos</a></li>
        <li><a href="index.php?seccion=ventas&accion=listar" class="nav-link text-white"><i class="fas fa-shopping-cart me-2"></i>Ventas</a></li>
        <li><a href="index.php?seccion=detalleventas&accion=listar" class="nav-link text-white"><i class="fas fa-list me-2"></i>Detalle Ventas</a></li>
        <li><a href="index.php?seccion=stockmovimientos&accion=listar" class="nav-link text-white"><i class="fas fa-exchange-alt me-2"></i>Stock Mov.</a></li>
        <li><a href="index.php?seccion=movimientoscaja&accion=listar" class="nav-link text-white"><i class="fas fa-cash-register me-2"></i>Caja Mov.</a></li>
    </ul>
    <hr>
    <a href="login/index.php" class="btn btn-outline-light"><i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión</a>
</div>

<style>
    .nav-link:hover { background-color: #2c3e50; }
    .nav-link.active { background-color: #0d6efd; color: #fff; }
</style>