<?php
if (isset($_GET['ideliminar'])) {
    $idEliminar = $_GET['ideliminar'];
    $sql = 'DELETE FROM clientes WHERE IdCliente=' . intval($idEliminar);
    $resp = mysqli_query($cnn, $sql);
}
?>

<div class="container pt-4">
    <div class="row">
        <div class="col-6">
            <h1>Clientes - Listar</h1>
        </div>
        <div class="col-6 text-end">
            <a href="index.php?seccion=clientes&accion=modificar" class="btn btn-success">+ Agregar Cliente</a>
        </div>
        <div class="col-12 mt-4">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM clientes";
                    $result = mysqli_query($cnn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td><?php echo $row['IdCliente']; ?></td>
                                <td><?php echo escaparTexto($row['Nombre']); ?></td>
                                <td><?php echo escaparTexto($row['Telefono']); ?></td>
                                <td>
                                    <a href='index.php?seccion=clientes&accion=modificar&id=<?php echo $row['IdCliente']; ?>' class='btn btn-sm btn-primary'>Editar</a>
                                    <a href='index.php?seccion=clientes&accion=listar&ideliminar=<?php echo $row['IdCliente']; ?>' class='btn btn-sm btn-danger' onclick='mostrarConfirmacion(event)'>Eliminar</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="4" class="text-center">No hay registros</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
