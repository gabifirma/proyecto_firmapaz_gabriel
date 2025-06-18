<div class="container mt-5">
        <h1 class="mb-4">Lista de Ventas</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID Venta</th>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha de Venta</th>
                        <th>Total ($)</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($ventas)): ?>
                        <?php foreach ($ventas as $venta): ?>
                            <tr>
                                <td><?= esc($venta['id_venta']) ?></td>
                                <td><?= esc($venta['dni']) ?></td>
                                <td><?= esc($venta['persona_nombre']) ?></td>
                                <td><?= esc($venta['persona_apellido']) ?></td>
                                <td><?= date('d/m/Y', strtotime($venta['fecha_venta'])) ?></td>
                                <td>$<?= number_format($venta['total_venta'], 2) ?></td>                                
                                <td>
                                    <a href="<?= base_url('detalle_venta/' . $venta['id_venta']) ?>" class="btn btn-sm btn-primary">
                                        Ver Detalle
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No hay ventas registradas.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>