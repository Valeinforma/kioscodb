<?php
if (isset($_GET['ideliminar'])) {
    $id = intval($_GET['ideliminar']);
    mysqli_query($cnn, "DELETE FROM ventas WHERE id_venta=$id");
}
?>
<div class="container pt-4">
    <div class="d-flex justify-content-between mb-4">
        <h1>Ventas</h1>
        <a href="index.php?seccion=ventas&accion=modificar" class="btn btn-success">+ Nueva Venta</a>
    </div>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr><th>ID</th><th>Fecha</th><th>Total</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php
            $res = mysqli_query($cnn, "SELECT * FROM ventas");
            while ($row = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
                <td><?php echo $row['id_venta']; ?></td>
                <td><?php echo $row['fecha']; ?></td>
                <td>$<?php echo $row['total']; ?></td>
                <td>
                    <a href='index.php?seccion=ventas&accion=modificar&id=<?php echo $row['id_venta']; ?>' class='btn btn-sm btn-primary'>Editar</a>
                    <a href='index.php?seccion=ventas&accion=listar&ideliminar=<?php echo $row['id_venta']; ?>' class='btn btn-sm btn-danger' onclick='mostrarConfirmacion(event)'>Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>