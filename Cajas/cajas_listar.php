<?php
if (isset($_GET['ideliminar'])) {
    $id = intval($_GET['ideliminar']);
    mysqli_query($cnn, "DELETE FROM cajas WHERE idcaja=$id");
}
?>
<div class="container pt-4">
    <div class="d-flex justify-content-between mb-4">
        <h1>Cajas</h1>
        <a href="index.php?seccion=cajas&accion=modificar" class="btn btn-success">+ Nueva Caja</a>
    </div>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr><th>ID</th><th>Apertura</th><th>Cierre</th><th>Saldo Inicial</th><th>Saldo Final</th><th>Usuario</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT c.*, u.usuario as UsuarioNombre FROM cajas c LEFT JOIN usuarios u ON c.idusuario = u.IdUsuario";
            $res = mysqli_query($cnn, $sql);
            while ($row = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
                <td><?php echo $row['idcaja']; ?></td>
                <td><?php echo $row['fechaapertura']; ?></td>
                <td><?php echo $row['fechacierre'] ?? 'Abierta'; ?></td>
                <td>$<?php echo $row['saldoinicial']; ?></td>
                <td>$<?php echo $row['saldofinal']; ?></td>
                <td><?php echo escaparTexto($row['UsuarioNombre'] ?? 'N/A'); ?></td>
                <td>
                    <a href='index.php?seccion=cajas&accion=modificar&id=<?php echo $row['idcaja']; ?>' class='btn btn-sm btn-primary'>Editar</a>
                    <a href='index.php?seccion=cajas&accion=listar&ideliminar=<?php echo $row['idcaja']; ?>' class='btn btn-sm btn-danger' onclick='mostrarConfirmacion(event)'>Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
