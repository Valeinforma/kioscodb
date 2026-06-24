<?php
$campos = ['IdMovimientoStock'=>'', 'IdProducto'=>'', 'Tipo'=>'', 'Cantidad'=>'', 'Fecha'=>''];

if (isset($_POST['btnGuardar'])) {
    $id = intval($_POST['IdMovimientoStock']);
    $p = intval($_POST['IdProducto']);
    $t = mysqli_real_escape_string($cnn, $_POST['Tipo']);
    $c = intval($_POST['Cantidad']);
    $f = mysqli_real_escape_string($cnn, $_POST['Fecha']);

    if ($id == 0) {
        $sql = "INSERT INTO stockmovimientos (IdProducto, Tipo, Cantidad, Fecha) VALUES ($p, '$t', $c, '$f')";
    } else {
        $sql = "UPDATE stockmovimientos SET IdProducto=$p, Tipo='$t', Cantidad=$c, Fecha='$f' WHERE IdMovimientoStock=$id";
    }
    if (mysqli_query($cnn, $sql)) { echo "<script>mostrarGuardado();</script>"; }
}

if (isset($_GET['id'])) {
    $res = mysqli_query($cnn, "SELECT * FROM stockmovimiento WHERE IdMovimientoStock=".intval($_GET['id']));
    $campos = mysqli_fetch_assoc($res);
}
?>
<div class="container pt-4">
    <form method="POST">
        <input type="hidden" name="IdMovimientoStock" value="<?php echo $campos['IdMovimientoStock']; ?>">
        <div class="mb-3"><label>Tipo</label><input type="text" name="Tipo" class="form-control" value="<?php echo escaparTexto($campos['Tipo']); ?>" required></div>
        <div class="mb-3"><label>Cantidad</label><input type="number" name="Cantidad" class="form-control" value="<?php echo $campos['Cantidad']; ?>" required></div>
        <div class="mb-3"><label>Fecha</label><input type="datetime-local" name="Fecha" class="form-control" value="<?php echo str_replace(' ', 'T', $campos['Fecha']); ?>" required></div>
        <button type="submit" name="btnGuardar" class="btn btn-primary">Guardar</button>
    </form>
</div>