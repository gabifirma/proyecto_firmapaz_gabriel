<?php
// Vista: Historial de compras del cliente
?>
<div class="container mt-5">
    <h2 class="titulo-contacto">Mis compras</h2>
    <?php if (empty($compras)): ?>
        <div class="alert alert-info">No tienes compras registradas.</div>
    <?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($compras as $compra): ?>
                <tr>
                    <td><?= esc($compra['id_venta']) ?></td>
                    <td><?= date('d/m/Y', strtotime($compra['fecha_venta'])) ?></td>
                    <td>$<?= esc($compra['total_venta']) ?></td>
                    <td>
                        <a href="<?= base_url('ver_factura/' . $compra['id_venta']) ?>" class="btn btn-success btn-sm">Ver factura</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>