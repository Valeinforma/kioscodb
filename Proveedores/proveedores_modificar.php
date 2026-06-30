<?php
$campos = array('IdProveedor' => '', 'Nombre' => '', 'Telefono' => '', 'Email' => '');

if (isset($_POST['btnGuardar'])) {
    $id = !empty($_POST['IdProveedor']) ? intval($_POST['IdProveedor']) : 0;
    $nombre = mysqli_real_escape_string($cnn, trim($_POST['Nombre']));
    $telefono = mysqli_real_escape_string($cnn, trim($_POST['Telefono']));
    $email = mysqli_real_escape_string($cnn, trim($_POST['Email']));

    if ($id == 0) {
        $sql = "INSERT INTO proveedores (Nombre, Telefono, Email) VALUES ('$nombre', '$telefono', '$email')";
    } else {
        $sql = "UPDATE proveedores SET Nombre='$nombre', Telefono='$telefono', Email='$email' WHERE IdProveedor=$id";
    }

    if (mysqli_query($cnn, $sql)) {
        if ($id == 0) $id = mysqli_insert_id($cnn);
        
        // Reset productos for this supplier
        mysqli_query($cnn, "UPDATE productos SET IdProveedor = 0 WHERE IdProveedor = $id");
        
        // Assign selected product
        $prodId = intval($_POST['IdProducto']);
        if ($prodId > 0) {
            mysqli_query($cnn, "UPDATE productos SET IdProveedor = $id WHERE IdProducto = $prodId");
        }
        echo "<script>mostrarGuardado();</script>";
    }
}

if (isset($_GET['id'])) {
    $idproveedor = intval($_GET['id']);
    $sql = "SELECT * FROM proveedores WHERE IdProveedor=" . $idproveedor;
    $result = mysqli_query($cnn, $sql);
    $campos = mysqli_fetch_assoc($result);
}
?>

<div class="container pt-4">
    <div class="row">
        <div class="col-6">
            <h1>Proveedores - Modificar</h1>
        </div>
        <div class="col-6 text-end">
            <a href="index.php?seccion=proveedores&accion=listar" class="btn btn-secondary">Volver a la lista</a>
        </div>
        <div class="col-12">
            <form method="POST" action="" class="mt-4">
                <input type="hidden" id="IdProveedor" name="IdProveedor" value="<?php echo isset($campos['IdProveedor']) ? $campos['IdProveedor'] : ''; ?>">

                <div class="mb-3">
                    <label for="Nombre" class="form-label">Nombre del Proveedor</label>
                    <input type="text" class="form-control" id="Nombre" name="Nombre" value="<?php echo isset($campos['Nombre']) ? escaparTexto($campos['Nombre']) : ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="Telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="Telefono" name="Telefono" value="<?php echo isset($campos['Telefono']) ? escaparTexto($campos['Telefono']) : ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="Email" name="Email" value="<?php echo isset($campos['Email']) ? escaparTexto($campos['Email']) : ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Categoría</label>
                    <select id="catSelect" class="form-control" onchange="filtrarProductos()">
                        <option value="0">Todas las categorías</option>
                        <?php
                        $resC = mysqli_query($cnn, "SELECT * FROM categorias");
                        while ($c = mysqli_fetch_assoc($resC)) {
                            echo "<option value='{$c['IdCategoria']}'>{$c['Nombre']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Producto asociado</label>
                    <select name="IdProducto" id="prodSelect" class="form-control">
                        <option value="0">Ninguno</option>
                        <?php
                        $idProv = isset($campos['IdProveedor']) ? intval($campos['IdProveedor']) : 0;
                        $resP = mysqli_query($cnn, "SELECT p.IdProducto, p.Nombre as Producto, p.IdCategoria 
                                                    FROM productos p ORDER BY p.Nombre");
                        
                        while ($p = mysqli_fetch_assoc($resP)) {
                            $selected = "";
                            if ($idProv > 0) {
                                $resCheck = mysqli_query($cnn, "SELECT IdProveedor FROM productos WHERE IdProducto = " . $p['IdProducto']);
                                $rowCheck = mysqli_fetch_assoc($resCheck);
                                if ($rowCheck['IdProveedor'] == $idProv) {
                                    $selected = "selected";
                                }
                            }
                            echo "<option value='{$p['IdProducto']}' data-cat='{$p['IdCategoria']}' $selected>{$p['Producto']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <script>
                function filtrarProductos() {
                    var catId = document.getElementById("catSelect").value;
                    var prodSelect = document.getElementById("prodSelect");
                    var options = prodSelect.options;
                    
                    for (var i = 0; i < options.length; i++) {
                        var opt = options[i];
                        if (catId == 0 || opt.getAttribute('data-cat') == catId || opt.value == 0) {
                            opt.style.display = "";
                        } else {
                            opt.style.display = "none";
                        }
                    }
                    prodSelect.value = 0; // Reset product selection on filter change
                }
                </script>

                <button type="submit" name="btnGuardar" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>
