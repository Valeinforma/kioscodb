<?php
if (isset($_GET['ideliminar'])) {
    $idEliminar = $_GET['ideliminar'];
    $sql = 'DELETE FROM metodospago WHERE IdMetodoPago=' . intval($idEliminar);
    $resp = mysqli_query($cnn, $sql);
}
?>

<div class="container pt-4">
    <div class="row">
        <div class="col-6">
            <h1>Métodos de Pago - Listar</h1>
        </div>
        <div class="col-6 text-end">
            <a href="index.php?seccion=metodospago&accion=modificar" class="btn btn-success">+ Agregar Método de Pago</a>
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
                    $sql = "SELECT * FROM metodospago";
                    $result = mysqli_query($cnn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td><?php echo $row['IdMetodoPago']; ?></td>
                                <td><?php echo escaparTexto($row['Nombre']); ?></td>
                                <td>
                                    <a href='index.php?seccion=metodospago&accion=modificar&id=<?php echo $row['IdMetodoPago']; ?>' class='btn btn-sm btn-primary'>Editar</a>
                                    <a href='index.php?seccion=metodospago&accion=listar&ideliminar=<?php echo $row['IdMetodoPago']; ?>' class='btn btn-sm btn-danger' onclick='mostrarConfirmacion(event)'>Eliminar</a>
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
