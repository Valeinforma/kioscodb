<?php
session_start();
include "php/conexion.php";
include "php/funciones.php";

if (isset($_GET['accion']) && $_GET['accion'] == 'salir') {
  // Destruir la sesión para cerrar sesión
  //session_destroy();
  //header("Location: login/index.php");
  //exit();
}


if (!isset($_SESSION["usuarios_registrado"]) || $_SESSION["usuarios_registrado"] !== true) {
  //header("Location: login/index.php");
  //exit();
}

$seccion = '';
$accion = '';

if (isset($_GET['seccion'])) {
  $seccion = $_GET['seccion'];
}

if (isset($_GET['accion'])) {
  $accion = $_GET['accion'];
}

if (!empty($seccion)) {
  $archivo = $seccion . "/" . $seccion . "_" . $accion . ".php";
} else {
  $archivo = "inicio.php";
}

if (!file_exists($archivo)) {
  $archivo = "inicio.php";
}
?>

<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kiosco DB - CRUD</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    function mostrarGuardado() {
      Swal.fire({
        icon: 'success',
        title: '¡Guardado!',
        text: 'Registro guardado correctamente',
        confirmButtonColor: '#28a745'
      });
    }

    function mostrarConfirmacion(event) {
      event.preventDefault();

      Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Deseas eliminar este registro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = event.target.href;
        }
      });
    }
  </script>

  <style>
    :root { --primary: #0d6efd; --bg: #f3f4f6; }
    body { background-color: var(--bg); font-family: 'Inter', system-ui, sans-serif; }
    
    /* Contenedor principal de tarjetas */
    .pos-card { 
        background: white; border-radius: 1rem; 
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); 
        padding: 2rem; border: none;
    }
    
    /* Tablas estilo SaaS */
    .table { vertical-align: middle; }
    .table thead { background-color: #f8fafc; color: #475569; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; }
    
    .btn { border-radius: 0.5rem; font-weight: 500; transition: all 0.2s; }
    .btn:hover { transform: translateY(-1px); }
    h1 { color: #1e293b; font-weight: 700; font-size: 1.5rem; margin-bottom: 1.5rem; }
  </style>
</head>

<body>

  <div class="d-flex">
    <?php include "menu.php"; ?>
    <main class="flex-grow-1 p-4" style="overflow-y: auto; height: 100vh;">
      <?php include $archivo; ?>
    </main>
  </div>

</body>

</html>
