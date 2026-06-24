<?php
$campos = array('IdCliente' => '', 'Nombre' => '', 'Telefono' => '');

if (isset($_POST['btnGuardar'])) {
    $id = !empty($_POST['IdCliente']) ? intval($_POST['IdCliente']) : 0;
    $nombre = trim($_POST['Nombre']);
    $telefono = trim($_POST['Telefono']);

    if (empty($nombre)) {
        echo "<script>alert('El nombre es requerido');</script>";
    } elseif (empty($telefono)) {
        echo "<script>alert('El teléfono es requerido');</script>";
    } else {
        if ($id == 0) {
            $sql = "INSERT INTO clientes (Nombre, Telefono) VALUES ('" . mysqli_real_escape_string($cnn, $nombre) . "', '" . mysqli_real_escape_string($cnn, $telefono) . "')";
        } else {
            $sql = "UPDATE clientes SET Nombre='" . mysqli_real_escape_string($cnn, $nombre) . "', Telefono='" . mysqli_real_escape_string($cnn, $telefono) . "' WHERE IdCliente=" . $id;
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
    $idcliente = intval($_GET['id']);
    $sql = "SELECT * FROM clientes WHERE IdCliente=" . $idcliente;
    $result = mysqli_query($cnn, $sql);
    $campos = mysqli_fetch_assoc($result);
}
?>

<div class="container pt-4">
    <div class="row">
        <div class="col-6">
            <h1>Clientes - Modificar</h1>
        </div>
        <div class="col-6 text-end">
            <a href="index.php?seccion=clientes&accion=listar" class="btn btn-secondary">Volver a la lista</a>
        </div>
        <div class="col-12">
            <form method="POST" action="" class="mt-4">
                <input type="hidden" id="IdCliente" name="IdCliente" value="<?php echo isset($campos['IdCliente']) ? $campos['IdCliente'] : ''; ?>">

                <div class="mb-3">
                    <label for="Nombre" class="form-label">Nombre del Cliente</label>
                    <input type="text" class="form-control" id="Nombre" name="Nombre" value="<?php echo isset($campos['Nombre']) ? escaparTexto($campos['Nombre']) : ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="Telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="Telefono" name="Telefono" value="<?php echo isset($campos['Telefono']) ? escaparTexto($campos['Telefono']) : ''; ?>" required>
                </div>

                <button type="submit" name="btnGuardar" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>
