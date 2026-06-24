<?php
$campos = ['IdDetalle'=>'', 'IdVenta'=>'', 'IdProducto'=>'', 'Cantidad'=>'', 'PrecioUnitario'=>'', 'Subtotal'=>''];

if (isset($_POST['btnGuardar'])) {
    $id = intval($_POST['IdDetalle']);
    $v = intval($_POST['IdVenta']);
    $p = intval($_POST['IdProducto']);
    $c = intval($_POST['Cantidad']);
    $pu = floatval($_POST['PrecioUnitario']);
    $s = floatval($_POST['Subtotal']);

    if ($id == 0) {
        $sql = "INSERT INTO detalleventas (IdVenta, IdProducto, Cantidad, PrecioUnitario, Subtotal) VALUES ($v, $p, $c, $pu, $s)";
    } else {
        $sql = "UPDATE detalleventas SET IdVenta=$v, IdProducto=$p, Cantidad=$c, PrecioUnitario=$pu, Subtotal=$s WHERE IdDetalle=$id";
    }
    if (mysqli_query($cnn, $sql)) { echo "<script>mostrarGuardado();</script>"; }
}

if (isset($_GET['id'])) {
    $res = mysqli_query($cnn, "SELECT * FROM detalleventas WHERE IdDetalle=".intval($_GET['id']));
    $campos = mysqli_fetch_assoc($res);
}
?>
<div class="container pt-4">
    <form method="POST">
        <input type="hidden" name="IdDetalle" value="<?php echo $campos['IdDetalle']; ?>">
        <div class="mb-3"><label>Cantidad</label><input type="number" name="Cantidad" class="form-control" value="<?php echo $campos['Cantidad']; ?>" required></div>
        <div class="mb-3"><label>Precio Unitario</label><input type="number" step="0.01" name="PrecioUnitario" class="form-control" value="<?php echo $campos['PrecioUnitario']; ?>" required></div>
        <div class="mb-3"><label>Subtotal</label><input type="number" step="0.01" name="Subtotal" class="form-control" value="<?php echo $campos['Subtotal']; ?>" required></div>
        <button type="submit" name="btnGuardar" class="btn btn-primary">Guardar</button>
    </form>
</div>