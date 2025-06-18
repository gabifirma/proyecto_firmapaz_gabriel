<?php
// Vista: Factura de compra
?>
<div class="container mt-5">
    <h2 class="titulo-contacto">Factura de compra</h2>
    <div class="card p-4">
        <h5>Datos del cliente</h5>
        <ul>
            <li><strong>Nombre:</strong> <?= esc($cliente['persona_nombre']) ?> <?= esc($cliente['persona_apellido']) ?></li>
            <li><strong>Email:</strong> <?= esc($cliente['persona_mail']) ?></li>
            <li><strong>DNI:</strong> <?= esc($cliente['dni']) ?></li>
            <li><strong>Domicilio:</strong> <?= esc($cliente['domicilio']) ?></li>
            <li><strong>Código Postal:</strong> <?= esc($cliente['codigo_postal']) ?></li>
        </ul>
        <h5>Detalle de la compra</h5>
        <ul>
            <li><strong>Fecha:</strong> <?= date('d/m/Y', strtotime($compra['fecha_venta'])) ?></li>
            <li><strong>Total:</strong> $<?= esc($compra['total_venta']) ?></li>
            <li><strong>Método de pago:</strong> <?= esc(ucfirst($compra['metodo_pago'])) ?></li>
        </ul>
        <h5>Productos</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Videojuego</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detalles as $item): ?>
                    <tr>
                        <td><?= esc($item['titulo_videojuego']) ?></td>
                        <td><?= esc($item['detalle_cantidad']) ?></td>
                        <td>$<?= esc($item['detalle_precio']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
