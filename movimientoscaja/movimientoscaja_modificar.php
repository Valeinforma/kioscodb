<?php
$campos = ['IdMovimiento'=>'', 'IdCaja'=>'', 'Tipo'=>'', 'Monto'=>'', 'Descripcion'=>'', 'Fecha'=>''];

if (isset($_POST['btnGuardar'])) {
    $id = intval($_POST['IdMovimiento']);
    $ic = isset($_POST['IdCaja']) ? intval($_POST['IdCaja']) : 0;
    $t = mysqli_real_escape_string($cnn, $_POST['Tipo']);
    $m = floatval($_POST['Monto']);
    $d = mysqli_real_escape_string($cnn, $_POST['Descripcion']);
    $f = mysqli_real_escape_string($cnn, $_POST['Fecha']);

    if ($id == 0) {
        $sql = "INSERT INTO movimientoscaja (IdCaja, Tipo, Monto, Descripcion, Fecha) VALUES ($ic, '$t', $m, '$d', '$f')";
    } else {
        $sql = "UPDATE movimientoscaja SET IdCaja=$ic, Tipo='$t', Monto=$m, Descripcion='$d', Fecha='$f' WHERE IdMovimiento=$id";
    }
    if (mysqli_query($cnn, $sql)) { echo "<script>mostrarGuardado();</script>"; }
}

if (isset($_GET['id'])) {
    $res = mysqli_query($cnn, "SELECT * FROM movimientoscaja WHERE IdMovimiento=".intval($_GET['id']));
    $campos = mysqli_fetch_assoc($res);
}
?>
<div class="container pt-4">
    <form method="POST">
        <input type="hidden" name="IdMovimiento" value="<?php echo $campos['IdMovimiento']; ?>">
        <div class="mb-3">
            <label>Caja</label>
            <select name="IdCaja" class="form-control" required>
                <?php
                $resC = mysqli_query($cnn, "SELECT idcaja FROM cajas");
                while ($c = mysqli_fetch_assoc($resC)) {
                    $selected = (isset($campos['IdCaja']) && $c['idcaja'] == $campos['IdCaja']) ? 'selected' : '';
                    echo "<option value='{$c['idcaja']}' $selected>{$c['idcaja']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3"><label>Tipo</label><input type="text" name="Tipo" class="form-control" value="<?php echo escaparTexto($campos['Tipo']); ?>" required></div>
        <div class="mb-3"><label>Monto</label><input type="number" step="0.01" name="Monto" class="form-control" value="<?php echo $campos['Monto']; ?>" required></div>
        <div class="mb-3"><label>Descripción</label><input type="text" name="Descripcion" class="form-control" value="<?php echo escaparTexto($campos['Descripcion']); ?>"></div>
        <div class="mb-3"><label>Fecha</label><input type="datetime-local" name="Fecha" class="form-control" value="<?php echo str_replace(' ', 'T', $campos['Fecha']); ?>" required></div>
        <button type="submit" name="btnGuardar" class="btn btn-primary">Guardar</button>
    </form>
</div>