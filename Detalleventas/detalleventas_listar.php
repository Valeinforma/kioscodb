<?php
if (isset($_GET['ideliminar'])) {
    $id = intval($_GET['ideliminar']);
    mysqli_query($cnn, "DELETE FROM detalleventas WHERE IdDetalle=$id");
}
?>
<div class="container pt-4">
    <div class="d-flex justify-content-between mb-4">
        <h1>Detalle Ventas</h1>
        <a href="index.php?seccion=detalleventas&accion=modificar" class="btn btn-success">+ Nuevo Detalle</a>
    </div>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr><th>ID</th><th>Venta</th><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Subtotal</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php
            $res = mysqli_query($cnn, "SELECT dv.*, p.Nombre as ProductoNombre FROM detalleventas dv LEFT JOIN productos p ON dv.IdProducto = p.IdProducto");
            while ($row = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
                <td><?php echo $row['IdDetalle']; ?></td>
                <td><?php echo $row['IdVenta']; ?></td>
                <td><?php echo escaparTexto($row['ProductoNombre'] ?? 'Desconocido'); ?></td>
                <td><?php echo $row['Cantidad']; ?></td>
                <td>$<?php echo $row['PrecioUnitario']; ?></td>
                <td>$<?php echo $row['Subtotal']; ?></td>
                <td>
                    <a href='index.php?seccion=detalleventas&accion=modificar&id=<?php echo $row['IdDetalle']; ?>' class='btn btn-sm btn-primary'>Editar</a>
                    <a href='index.php?seccion=detalleventas&accion=listar&ideliminar=<?php echo $row['IdDetalle']; ?>' class='btn btn-sm btn-danger' onclick='mostrarConfirmacion(event)'>Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>