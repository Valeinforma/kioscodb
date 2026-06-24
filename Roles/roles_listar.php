<?php
if (isset($_GET['ideliminar'])) {
    $idEliminar = $_GET['ideliminar'];
    $sql = 'DELETE FROM roles WHERE IdRol=' . intval($idEliminar);
    $resp = mysqli_query($cnn, $sql);
}
?>

<div class="container pt-4">
    <div class="row">
        <div class="col-6">
            <h1>Roles - Listar</h1>
        </div>
        <div class="col-6 text-end">
            <a href="index.php?seccion=roles&accion=modificar" class="btn btn-success">+ Agregar Rol</a>
        </div>
        <div class="col-12 mt-4">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM roles";
                    $result = mysqli_query($cnn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td><?php echo $row['IdRol']; ?></td>
                                <td><?php echo escaparTexto($row['Nombre']); ?></td>
                                <td>
                                    <a href='index.php?seccion=roles&accion=modificar&id=<?php echo $row['IdRol']; ?>' class='btn btn-sm btn-primary'>Editar</a>
                                    <a href='index.php?seccion=roles&accion=listar&ideliminar=<?php echo $row['IdRol']; ?>' class='btn btn-sm btn-danger' onclick='mostrarConfirmacion(event)'>Eliminar</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="3" class="text-center">No hay registros</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
