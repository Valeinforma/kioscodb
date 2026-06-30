<?php
if (isset($_GET['ideliminar'])) {
    $id = intval($_GET['ideliminar']);
    mysqli_query($cnn, "DELETE FROM stockmovimientos WHERE IdMovimientoStock=$id");
}
?>
<div class="container pt-4">
    <div class="d-flex justify-content-between mb-4">
        <h1>Stock Movimientos</h1>
        <a href="index.php?seccion=stockmovimientos&accion=modificar" class="btn btn-success">+ Nuevo Movimiento</a>
    </div>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr><th>Producto</th><th>Tipo</th><th>Cantidad</th><th>Fecha</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php
            $res = mysqli_query($cnn, "SELECT sm.IdMovimientoStock, p.Nombre as ProductoNombre, sm.Tipo, sm.Cantidad, sm.Fecha FROM stockmovimientos sm INNER JOIN productos p ON sm.IdProducto = p.IdProducto");
            while ($row = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
                <td><?php echo escaparTexto($row['ProductoNombre']); ?></td>
                <td><?php echo escaparTexto($row['Tipo']); ?></td>
                <td><?php echo $row['Cantidad']; ?></td>
                <td><?php echo $row['Fecha']; ?></td>
                <td>
                    <a href='index.php?seccion=stockmovimientos&accion=modificar&id=<?php echo $row['IdMovimientoStock']; ?>' class='btn btn-sm btn-primary'>Editar</a>
                    <a href='index.php?seccion=stockmovimientos&accion=listar&ideliminar=<?php echo $row['IdMovimientoStock']; ?>' class='btn btn-sm btn-danger' onclick='mostrarConfirmacion(event)'>Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>