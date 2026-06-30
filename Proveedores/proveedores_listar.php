<?php
if (isset($_GET['ideliminar'])) {
    $idEliminar = $_GET['ideliminar'];
    $sql = 'DELETE FROM proveedores WHERE IdProveedor=' . intval($idEliminar);
    $resp = mysqli_query($cnn, $sql);
}
?>

<div class="container pt-4">
    <div class="row">
        <div class="col-6">
            <h1>Proveedores - Listar</h1>
        </div>
        <div class="col-6 text-end">
            <a href="index.php?seccion=proveedores&accion=modificar" class="btn btn-success">+ Agregar Proveedor</a>
        </div>
        <div class="col-12 mt-4">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Usamos JOIN para obtener la relación completa
                    $sql = "SELECT pr.*, p.Nombre as Producto, c.Nombre as Categoria 
                            FROM proveedores pr
                            LEFT JOIN productos p ON pr.IdProveedor = p.IdProveedor
                            LEFT JOIN categorias c ON p.IdCategoria = c.IdCategoria
                            ORDER BY pr.IdProveedor";
                    $result = mysqli_query($cnn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td><?php echo $row['IdProveedor']; ?></td>
                                <td><?php echo escaparTexto($row['Nombre']); ?></td>
                                <td><?php echo escaparTexto($row['Telefono']); ?></td>
                                <td><?php echo escaparTexto($row['Email']); ?></td>
                                <td><?php echo escaparTexto($row['Producto'] ?? '-'); ?></td>
                                <td><?php echo escaparTexto($row['Categoria'] ?? '-'); ?></td>
                                <td>
                                    <a href='index.php?seccion=proveedores&accion=modificar&id=<?php echo $row['IdProveedor']; ?>' class='btn btn-sm btn-primary'>Editar</a>
                                    <a href='index.php?seccion=proveedores&accion=listar&ideliminar=<?php echo $row['IdProveedor']; ?>' class='btn btn-sm btn-danger' onclick='mostrarConfirmacion(event)'>Eliminar</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="7" class="text-center">No hay registros</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
