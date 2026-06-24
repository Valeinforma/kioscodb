<?php
$campos = array('IdCategoria' => '', 'Nombre' => '');

if (isset($_POST['btnGuardar'])) {
    $id = !empty($_POST['IdCategoria']) ? intval($_POST['IdCategoria']) : 0;
    $nombre = trim($_POST['Nombre']);

    if (empty($nombre)) {
        echo "<script>alert('El nombre es requerido');</script>";
    } else {
        if ($id == 0) {
            $sql = "INSERT INTO categorias (Nombre) VALUES ('" . mysqli_real_escape_string($cnn, $nombre) . "')";
        } else {
            $sql = "UPDATE categorias SET Nombre='" . mysqli_real_escape_string($cnn, $nombre) . "' WHERE IdCategoria=" . $id;
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
    $idcategoria = intval($_GET['id']);
    $sql = "SELECT * FROM categorias WHERE IdCategoria=" . $idcategoria;
    $result = mysqli_query($cnn, $sql);
    $campos = mysqli_fetch_assoc($result);
}
?>

<div class="container pt-4">
    <div class="row">
        <div class="col-6">
            <h1>Categorías - Modificar</h1>
        </div>
        <div class="col-6 text-end">
            <a href="index.php?seccion=categorias&accion=listar" class="btn btn-secondary">Volver a la lista</a>
        </div>
        <div class="col-12">
            <form method="POST" action="" class="mt-4">
                <input type="hidden" id="IdCategoria" name="IdCategoria" value="<?php echo isset($campos['IdCategoria']) ? $campos['IdCategoria'] : ''; ?>">

                <div class="mb-3">
                    <label for="Nombre" class="form-label">Nombre de la Categoría</label>
                    <input type="text" class="form-control" id="Nombre" name="Nombre" value="<?php echo isset($campos['Nombre']) ? escaparTexto($campos['Nombre']) : ''; ?>" required>
                </div>

                <button type="submit" name="btnGuardar" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>
