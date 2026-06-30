<?php
$campos = ['id_venta'=>'', 'fecha'=>'', 'total'=>'', 'id_usuario'=>'', 'id_cliente'=>'', 'id_metodopago'=>''];

if (isset($_POST['btnGuardar'])) {
    $id = intval($_POST['id_venta']);
    $f = mysqli_real_escape_string($cnn, $_POST['fecha']);
    $t = floatval($_POST['total']);
    $u = intval($_POST['id_usuario']);
    $c = intval($_POST['id_cliente']);
    $m = intval($_POST['id_metodopago']);

    if ($id == 0) {
        $sql = "INSERT INTO ventas (fecha, total, id_usuario, id_cliente, id_metodopago) VALUES ('$f', $t, $u, $c, $m)";
    } else {
        $sql = "UPDATE ventas SET fecha='$f', total=$t, id_usuario=$u, id_cliente=$c, id_metodopago=$m WHERE id_venta=$id";
    }
    if (mysqli_query($cnn, $sql)) { echo "<script>mostrarGuardado();</script>"; }
}

if (isset($_GET['id'])) {
    $res = mysqli_query($cnn, "SELECT * FROM ventas WHERE id_venta=".intval($_GET['id']));
    $campos = mysqli_fetch_assoc($res);
}
?>
<div class="container pt-4">
    <form method="POST">
        <input type="hidden" name="id_venta" value="<?php echo $campos['id_venta']; ?>">
        <div class="mb-3"><label>Fecha</label><input type="datetime-local" name="fecha" class="form-control" value="<?php echo str_replace(' ', 'T', $campos['fecha']); ?>" required></div>
        <div class="mb-3"><label>Total</label><input type="number" step="0.01" name="total" class="form-control" value="<?php echo $campos['total']; ?>" required></div>
        <div class="mb-3">
            <label>Usuario</label>
            <select name="id_usuario" class="form-control">
                <?php
                $resU = mysqli_query($cnn, "SELECT IdUsuario, usuario FROM usuarios");
                while ($u = mysqli_fetch_assoc($resU)) {
                    $selected = (isset($campos['id_usuario']) && $u['IdUsuario'] == $campos['id_usuario']) ? 'selected' : '';
                    echo "<option value='{$u['IdUsuario']}' $selected>{$u['usuario']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Cliente</label>
            <select name="id_cliente" class="form-control">
                <?php
                $resC = mysqli_query($cnn, "SELECT IdCliente, Nombre FROM clientes");
                while ($c = mysqli_fetch_assoc($resC)) {
                    $selected = (isset($campos['id_cliente']) && $c['IdCliente'] == $campos['id_cliente']) ? 'selected' : '';
                    echo "<option value='{$c['IdCliente']}' $selected>{$c['Nombre']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Método de Pago</label>
            <select name="id_metodopago" class="form-control">
                <?php
                $resM = mysqli_query($cnn, "SELECT IdMetodoPago, Nombre FROM metodospago");
                while ($m = mysqli_fetch_assoc($resM)) {
                    $selected = (isset($campos['id_metodopago']) && $m['IdMetodoPago'] == $campos['id_metodopago']) ? 'selected' : '';
                    echo "<option value='{$m['IdMetodoPago']}' $selected>{$m['Nombre']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" name="btnGuardar" class="btn btn-primary">Guardar</button>
    </form>
</div>