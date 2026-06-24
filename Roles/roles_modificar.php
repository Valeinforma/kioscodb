<?php
$campos = array('IdRol' => '', 'Nombre' => '');

if (isset($_POST['btnGuardar'])) {
    $id = !empty($_POST['IdRol']) ? intval($_POST['IdRol']) : 0;
    $nombre = trim($_POST['Nombre']);

    if (empty($nombre)) {
        echo "<script>alert('El nombre es requerido');</script>";
    } else {
        if ($id == 0) {
            $sql = "INSERT INTO roles (Nombre) VALUES ('" . mysqli_real_escape_string($cnn, $nombre) . "')";
        } else {
            $sql = "UPDATE roles SET Nombre='" . mysqli_real_escape_string($cnn, $nombre) . "' WHERE IdRol=" . $id;
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
    $idrol = intval($_GET['id']);
    $sql = "SELECT * FROM roles WHERE IdRol=" . $idrol;
    $result = mysqli_query($cnn, $sql);
    $campos = mysqli_fetch_assoc($result);
}
?>

<div class="container pt-4">
    <div class="row">
        <div class="col-6">
            <h1>Roles - Modificar</h1>
        </div>
        <div class="col-6 text-end">
            <a href="index.php?seccion=roles&accion=listar" class="btn btn-secondary">Volver a la lista</a>
        </div>
        <div class="col-12">
            <form method="POST" action="" class="mt-4">
                <input type="hidden" id="IdRol" name="IdRol" value="<?php echo isset($campos['IdRol']) ? $campos['IdRol'] : ''; ?>">

                <div class="mb-3">
                    <label for="Nombre" class="form-label">Nombre del Rol</label>
                    <input type="text" class="form-control" id="Nombre" name="Nombre" value="<?php echo isset($campos['Nombre']) ? escaparTexto($campos['Nombre']) : ''; ?>" required>
                </div>

                <button type="submit" name="btnGuardar" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>
