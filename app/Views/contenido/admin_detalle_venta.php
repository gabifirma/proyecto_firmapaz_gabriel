    <div class="container mt-5">
        <h1 class="mb-4">Detalles de Venta</h1>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Orden</th>
                        <th>Videojuego</th>
                        <th>Cantidad</th>
                        <th>Precio ($)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($detalles)): ?>
                        <?php 
                            $i = 1;
                            foreach ($detalles as $c): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?= esc($c['id_videojuego']) ?></td>
                                <td><?= esc($c['detalle_cantidad']) ?></td>
                                <td><?= esc($c['detalle_precio']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay consultas disponibles.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
