<?php
$campos = ['idcaja'=>'', 'fechaapertura'=>'', 'fechacierre'=>'', 'saldoinicial'=>'', 'saldofinal'=>'', 'idusuario'=>''];
if (isset($_POST['btnGuardar'])) {
    $id = intval($_POST['idcaja']);
    $fa = mysqli_real_escape_string($cnn, $_POST['fechaapertura']);
    $si = floatval($_POST['saldoinicial']);
    $sf = floatval($_POST['saldofinal']);
    $u = intval($_POST['idusuario']);
    if ($id == 0) {
        $sql = "INSERT INTO cajas (fechaapertura, saldoinicial, saldofinal, idusuario) VALUES ('$fa', $si, $sf, $u)";
    } else {
        $sql = "UPDATE cajas SET fechaapertura='$fa', saldoinicial=$si, saldofinal=$sf, idusuario=$u WHERE idcaja=$id";
    }
    if (mysqli_query($cnn, $sql)) { echo "<script>mostrarGuardado();</script>"; }
}
if (isset($_GET['id'])) {
    $res = mysqli_query($cnn, "SELECT * FROM cajas WHERE idcaja=".intval($_GET['id']));
    $campos = mysqli_fetch_assoc($res);
}
?>
<div class="container pt-4">
    <form method="POST">
        <input type="hidden" name="idcaja" value="<?php echo $campos['idcaja']; ?>">
        <div class="mb-3"><label>Fecha Apertura</label><input type="datetime-local" name="fechaapertura" class="form-control" value="<?php echo str_replace(' ', 'T', $campos['fechaapertura']); ?>" required></div>
        <div class="mb-3"><label>Saldo Inicial</label><input type="number" step="0.01" name="saldoinicial" class="form-control" value="<?php echo $campos['saldoinicial']; ?>" required></div>
        <div class="mb-3"><label>Saldo Final</label><input type="number" step="0.01" name="saldofinal" class="form-control" value="<?php echo $campos['saldofinal']; ?>" required></div>
        <div class="mb-3"><label>Usuario</label>
            <select name="idusuario" class="form-control">
                <?php
                $resU = mysqli_query($cnn, "SELECT IdUsuario, usuario FROM usuarios");
                while ($u = mysqli_fetch_assoc($resU)) {
                    $selected = ($u['IdUsuario'] == $campos['idusuario']) ? 'selected' : '';
                    echo "<option value='{$u['IdUsuario']}' $selected>{$u['usuario']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" name="btnGuardar" class="btn btn-primary">Guardar</button>
    </form>
</div>
