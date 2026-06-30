<?php
if (isset($_GET['ideliminar'])) {
    $id = intval($_GET['ideliminar']);
    mysqli_query($cnn, "DELETE FROM usuarios WHERE IdUsuario=$id");
}
?>
<div class="container pt-4">
    <div class="d-flex justify-content-between mb-4">
        <h1>Usuarios</h1>
        <a href="index.php?seccion=usuarios&accion=modificar" class="btn btn-success">+ Nuevo Usuario</a>
    </div>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr><th>ID</th><th>Usuario</th><th>Email</th><th>Rol</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT u.*, r.Nombre as RolNombre FROM usuarios u LEFT JOIN roles r ON u.IdRol = r.IdRol";
            $res = mysqli_query($cnn, $sql);
            while ($row = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
                <td><?php echo $row['IdUsuario']; ?></td>
                <td><?php echo escaparTexto($row['usuario']); ?></td>
                <td><?php echo escaparTexto($row['Email']); ?></td>
                <td><?php echo escaparTexto($row['RolNombre'] ?? 'N/A'); ?></td>
                <td>
                    <a href='index.php?seccion=usuarios&accion=modificar&id=<?php echo $row['IdUsuario']; ?>' class='btn btn-sm btn-primary'>Editar</a>
                    <a href='index.php?seccion=usuarios&accion=listar&ideliminar=<?php echo $row['IdUsuario']; ?>' class='btn btn-sm btn-danger' onclick='mostrarConfirmacion(event)'>Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
