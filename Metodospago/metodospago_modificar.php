<?php
$campos = array('IdMetodoPago' => '', 'Nombre' => '');

if (isset($_POST['btnGuardar'])) {
    $id = !empty($_POST['IdMetodoPago']) ? intval($_POST['IdMetodoPago']) : 0;
    $nombre = trim($_POST['Nombre']);

    if (empty($nombre)) {
        echo "<script>alert('El nombre es requerido');</script>";
    } else {
        if ($id == 0) {
            $sql = "INSERT INTO metodospago (Nombre) VALUES ('" . mysqli_real_escape_string($cnn, $nombre) . "')";
        } else {
            $sql = "UPDATE metodospago SET Nombre='" . mysqli_real_escape_string($cnn, $nombre) . "' WHERE IdMetodoPago=" . $id;
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
    $idmetodo = intval($_GET['id']);
    $sql = "SELECT * FROM metodospago WHERE IdMetodoPago=" . $idmetodo;
    $result = mysqli_query($cnn, $sql);
    $campos = mysqli_fetch_assoc($result);
}
?>

<div class="container pt-4">
    <div class="row">
        <div class="col-6">
            <h1>Métodos de Pago - Modificar</h1>
        </div>
        <div class="col-6 text-end">
            <a href="index.php?seccion=metodospago&accion=listar" class="btn btn-secondary">Volver a la lista</a>
        </div>
        <div class="col-12">
            <form method="POST" action="" class="mt-4">
                <input type="hidden" id="IdMetodoPago" name="IdMetodoPago" value="<?php echo isset($campos['IdMetodoPago']) ? $campos['IdMetodoPago'] : ''; ?>">

                <div class="mb-3">
                    <label for="Nombre" class="form-label">Nombre del Método de Pago</label>
                    <input type="text" class="form-control" id="Nombre" name="Nombre" value="<?php echo isset($campos['Nombre']) ? escaparTexto($campos['Nombre']) : ''; ?>" required>
                </div>

                <button type="submit" name="btnGuardar" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>
