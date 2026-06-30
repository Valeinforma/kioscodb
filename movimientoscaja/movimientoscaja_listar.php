<?php
if (isset($_GET['ideliminar'])) {
    $id = intval($_GET['ideliminar']);
    mysqli_query($cnn, "DELETE FROM movimientoscaja WHERE IdMovimiento=$id");
}
?>
<div class="container pt-4">
    <div class="d-flex justify-content-between mb-4">
        <h1>Movimientos Caja</h1>
        <a href="index.php?seccion=movimientoscaja&accion=modificar" class="btn btn-success">+ Nuevo Movimiento</a>
    </div>
    <table class="table table-striped">
            <thead class="table-dark">
                <tr><th>ID</th><th>Tipo</th><th>Monto</th><th>Descripción</th><th>Fecha</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($cnn, "SELECT * FROM movimientoscaja");
                while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                    <td><?php echo $row['IdMovimiento']; ?></td>
                    <td><?php echo escaparTexto($row['Tipo']); ?></td>
                    <td>$<?php echo $row['Monto']; ?></td>
                    <td><?php echo escaparTexto($row['Descripcion']); ?></td>
                    <td><?php echo $row['Fecha']; ?></td>
                <td>
                    <a href='index.php?seccion=movimientoscaja&accion=modificar&id=<?php echo $row['IdMovimiento']; ?>' class='btn btn-sm btn-primary'>Editar</a>
                    <a href='index.php?seccion=movimientoscaja&accion=listar&ideliminar=<?php echo $row['IdMovimiento']; ?>' class='btn btn-sm btn-danger' onclick='mostrarConfirmacion(event)'>Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>