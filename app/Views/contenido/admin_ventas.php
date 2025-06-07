    <div class="container mt-5">
        <h1 class="mb-4">Lista de Ventas</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Cliente</th>
                        <th>Fecha de Venta</th>
                        <th>Juego</th>
                        <th>Precio ($)</th>
                        <th>Categoría</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($ventas)): ?>
                        <?php foreach ($ventas as $c): ?>
                            <tr>
                                <td><?= esc($c['titulo_videojuego']) ?></td>
                                <td><?= esc($c['desarrollador_videojuego']) ?></td>
                                <td><?= esc($c['distribuidor_videojuego']) ?></td>                                
                                <td>$<?= esc($c['precio_videojuego']) ?></td>
                                <td><?= esc($c['categoria_id']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay ventas registradas.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>