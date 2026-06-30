<div class="container pt-4">
    <h1>Reporte de Stock por Categoría</h1>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr><th>Categoría</th><th>Producto</th><th>Tipo</th><th>Cantidad</th><th>Fecha</th></tr>
        </thead>
        <tbody>
            <?php
            $res = mysqli_query($cnn, "SELECT c.Nombre as CategoriaNombre, p.Nombre as ProductoNombre, sm.Tipo, sm.Cantidad, sm.Fecha FROM stockmovimientos sm LEFT JOIN productos p ON sm.IdProducto = p.IdProducto LEFT JOIN categorias c ON p.IdCategoria = c.IdCategoria ORDER BY c.Nombre, p.Nombre");
            while ($row = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
                <td><?php echo escaparTexto($row['CategoriaNombre'] ?? 'Sin categoría'); ?></td>
                <td><?php echo escaparTexto($row['ProductoNombre'] ?? 'Desconocido'); ?></td>
                <td><?php echo escaparTexto($row['Tipo']); ?></td>
                <td><?php echo $row['Cantidad']; ?></td>
                <td><?php echo $row['Fecha']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
