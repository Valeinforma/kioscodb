<?php
$campos = ['IdProducto'=>'', 'Nombre'=>'', 'Precio'=>'', 'Stock'=>'', 'IdCategoria'=>'', 'IdProveedor'=>''];

if (isset($_POST['btnGuardar'])) {
    $id = intval($_POST['IdProducto']);
    $n = mysqli_real_escape_string($cnn, $_POST['Nombre']);
    $p = floatval($_POST['Precio']);
    $s = intval($_POST['Stock']);
    $cat = intval($_POST['IdCategoria']);
    $prov = isset($_POST['IdProveedor']) ? intval($_POST['IdProveedor']) : 0;

    if ($id == 0) {
        $sql = "INSERT INTO productos (Nombre, Precio, Stock, IdCategoria, IdProveedor) VALUES ('$n', $p, $s, $cat, $prov)";
    } else {
        $sql = "UPDATE productos SET Nombre='$n', Precio=$p, Stock=$s, IdCategoria=$cat, IdProveedor=$prov WHERE IdProducto=$id";
    }
    if (mysqli_query($cnn, $sql)) { echo "<script>mostrarGuardado();</script>"; }
}

if (isset($_GET['id'])) {
    $res = mysqli_query($cnn, "SELECT * FROM productos WHERE IdProducto=".intval($_GET['id']));
    $campos = mysqli_fetch_assoc($res);
}
?>
<div class="container pt-4">
    <form method="POST">
        <input type="hidden" name="IdProducto" value="<?php echo $campos['IdProducto']; ?>">
        <div class="mb-3"><label>Nombre</label><input type="text" name="Nombre" class="form-control" value="<?php echo escaparTexto($campos['Nombre']); ?>" required></div>
        <div class="mb-3"><label>Precio</label><input type="number" step="0.01" name="Precio" class="form-control" value="<?php echo $campos['Precio']; ?>" required></div>
        <div class="mb-3"><label>Stock</label><input type="number" name="Stock" class="form-control" value="<?php echo $campos['Stock']; ?>" required></div>
        <div class="mb-3">
            <label>Categoría</label>
            <select name="IdCategoria" class="form-control">
                <option value="0">Sin categoría</option>
                <?php
                $resCat = mysqli_query($cnn, "SELECT * FROM categorias");
                while ($cat = mysqli_fetch_assoc($resCat)) {
                    $selected = (isset($campos['IdCategoria']) && $cat['IdCategoria'] == $campos['IdCategoria']) ? 'selected' : '';
                    echo "<option value='{$cat['IdCategoria']}' $selected>{$cat['Nombre']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Proveedor</label>
            <select name="IdProveedor" class="form-control">
                <option value="0">Sin proveedor</option>
                <?php
                $resProv = mysqli_query($cnn, "SELECT * FROM proveedores");
                while ($prov = mysqli_fetch_assoc($resProv)) {
                    $selected = (isset($campos['IdProveedor']) && $prov['IdProveedor'] == $campos['IdProveedor']) ? 'selected' : '';
                    echo "<option value='{$prov['IdProveedor']}' $selected>{$prov['Nombre']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" name="btnGuardar" class="btn btn-primary">Guardar</button>
    </form>
</div>