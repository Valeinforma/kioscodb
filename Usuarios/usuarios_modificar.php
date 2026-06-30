<?php
$campos = ['IdUsuario'=>'', 'usuario'=>'', 'Email'=>'', 'Password'=>'', 'IdRol'=>'', 'activo'=>'1', 'deleted'=>'0'];
if (isset($_POST['btnGuardar'])) {
    $id = intval($_POST['IdUsuario']);
    $u = mysqli_real_escape_string($cnn, $_POST['usuario']);
    $e = mysqli_real_escape_string($cnn, $_POST['Email']);
    $p = mysqli_real_escape_string($cnn, $_POST['Password']);
    $r = intval($_POST['IdRol']);
    if ($id == 0) {
        $sql = "INSERT INTO usuarios (usuario, Email, Password, IdRol) VALUES ('$u', '$e', '$p', $r)";
    } else {
        $sql = "UPDATE usuarios SET usuario='$u', Email='$e', Password='$p', IdRol=$r WHERE IdUsuario=$id";
    }
    if (mysqli_query($cnn, $sql)) { echo "<script>mostrarGuardado();</script>"; }
}
if (isset($_GET['id'])) {
    $res = mysqli_query($cnn, "SELECT * FROM usuarios WHERE IdUsuario=".intval($_GET['id']));
    $campos = mysqli_fetch_assoc($res);
}
?>
<div class="container pt-4">
    <form method="POST">
        <input type="hidden" name="IdUsuario" value="<?php echo $campos['IdUsuario']; ?>">
        <div class="mb-3"><label>Usuario</label><input type="text" name="usuario" class="form-control" value="<?php echo escaparTexto($campos['usuario']); ?>" required></div>
        <div class="mb-3"><label>Email</label><input type="email" name="Email" class="form-control" value="<?php echo escaparTexto($campos['Email']); ?>" required></div>
        <div class="mb-3"><label>Password</label><input type="password" name="Password" class="form-control" value="<?php echo escaparTexto($campos['Password']); ?>" required></div>
        <div class="mb-3"><label>Rol</label>
            <select name="IdRol" class="form-control">
                <?php
                $resR = mysqli_query($cnn, "SELECT * FROM roles");
                while ($r = mysqli_fetch_assoc($resR)) {
                    $selected = ($r['IdRol'] == $campos['IdRol']) ? 'selected' : '';
                    echo "<option value='{$r['IdRol']}' $selected>{$r['Nombre']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" name="btnGuardar" class="btn btn-primary">Guardar</button>
    </form>
</div>
