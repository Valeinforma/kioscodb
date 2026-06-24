<?php
$campos = array('IdProveedor' => '', 'Nombre' => '', 'Telefono' => '', 'Email' => '');

if (isset($_POST['btnGuardar'])) {
    $id = !empty($_POST['IdProveedor']) ? intval($_POST['IdProveedor']) : 0;
    $nombre = trim($_POST['Nombre']);
    $telefono = trim($_POST['Telefono']);
    $email = trim($_POST['Email']);

    $errores = array();

    if (empty($nombre)) {
        $errores[] = "El nombre es requerido";
    }
    if (empty($telefono)) {
        $errores[] = "El teléfono es requerido";
    }
    if (empty($email)) {
        $errores[] = "El email es requerido";
    } elseif (!esEmailValido($email)) {
        $errores[] = "El email no es válido";
    }

    if (!empty($errores)) {
        $mensaje = implode("\n", $errores);
        echo "<script>alert('$mensaje');</script>";
    } else {
        if ($id == 0) {
            $sql = "INSERT INTO proveedores (Nombre, Telefono, Email) VALUES ('" . mysqli_real_escape_string($cnn, $nombre) . "', '" . mysqli_real_escape_string($cnn, $telefono) . "', '" . mysqli_real_escape_string($cnn, $email) . "')";
        } else {
            $sql = "UPDATE proveedores SET Nombre='" . mysqli_real_escape_string($cnn, $nombre) . "', Telefono='" . mysqli_real_escape_string($cnn, $telefono) . "', Email='" . mysqli_real_escape_string($cnn, $email) . "' WHERE IdProveedor=" . $id;
        }

        $resp = mysqli_query($cnn, $sql);
        if ($resp) {
            echo "<script>mostrarGuardado();</script>";
            if ($id == 0) {
                $id = mysqli_insert_id($cnn);
            }
        }
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

                <button type="submit" name="btnGuardar" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>
