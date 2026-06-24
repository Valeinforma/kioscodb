<?php
if (isset($_GET['ideliminar'])) {
    $id = intval($_GET['ideliminar']);
    mysqli_query($cnn, "DELETE FROM detalleventas WHERE IdDetalle=$id");
}
?>
<div class="container pt-4">
    <div class="d-flex justify-content-between mb-4">
        <h1>Detalle Ventas</h1>
        <a href="index.php?seccion=detalleventa&accion=modificar" class="btn btn-success">+ Nuevo Detalle</a>
    </div>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr><th>ID</th><th>Venta</th><th>Producto</th><th>Cantidad</th><th>Subtotal</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php
            $res = mysqli_query($cnn, "SELECT * FROM detalleventas");
            while ($row = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
                <td><?php echo $row['IdDetalle']; ?></td>
                <td><?php echo $row['IdVenta']; ?></td>
                <td><?php echo $row['IdProducto']; ?></td>
                <td><?php echo $row['Cantidad']; ?></td>
                <td>$<?php echo $row['Subtotal']; ?></td>
                <td>
                    <a href='index.php?seccion=detalleventa&accion=modificar&id=<?php echo $row['IdDetalle']; ?>' class='btn btn-sm btn-primary'>Editar</a>
                    <a href='index.php?seccion=detalleventa&accion=listar&ideliminar=<?php echo $row['IdDetalle']; ?>' class='btn btn-sm btn-danger' onclick='mostrarConfirmacion(event)'>Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>