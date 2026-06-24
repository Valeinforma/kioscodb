<?php
if (isset($_GET['ideliminar'])) {
    $id = intval($_GET['ideliminar']);
    mysqli_query($cnn, "DELETE FROM productos WHERE IdProducto=$id");
}
?>
<div class="container pt-4">
    <div class="d-flex justify-content-between mb-4">
        <h1>Productos</h1>
        <a href="index.php?seccion=productos&accion=modificar" class="btn btn-success">+ Nuevo</a>
    </div>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php
            $res = mysqli_query($cnn, "SELECT * FROM productos");
            while ($row = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
                <td><?php echo $row['IdProducto']; ?></td>
                <td><?php echo escaparTexto($row['Nombre']); ?></td>
                <td>$<?php echo $row['Precio']; ?></td>
                <td><?php echo $row['Stock']; ?></td>
                <td>
                    <a href='index.php?seccion=productos&accion=modificar&id=<?php echo $row['IdProducto']; ?>' class='btn btn-sm btn-primary'>Editar</a>
                    <a href='index.php?seccion=productos&accion=listar&ideliminar=<?php echo $row['IdProducto']; ?>' class='btn btn-sm btn-danger' onclick='mostrarConfirmacion(event)'>Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>