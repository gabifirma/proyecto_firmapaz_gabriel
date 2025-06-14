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
                        <th>Total ($)</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($ventas)): ?>
                        <?php foreach ($ventas as $c): ?>
                            <tr>
                                <td><?= esc($c['id_persona']) ?></td>
                                <td><?= esc($c['fecha_venta']) ?></td>
                                <td>$<?= esc($c['total_venta']) ?></td>                                
                                <td>
                                    <form method="get" action="<?= base_url('' .$c['id_venta']) ?>">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Detalle de Venta</button>
                                    </form>
                                </td>
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