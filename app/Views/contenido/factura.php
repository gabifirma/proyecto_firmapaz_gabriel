<?php
// Vista: Factura de compra
$fecha = date('d/m/Y H:i:s', strtotime($compra['fecha_venta']));
?>
<link rel="stylesheet" href="<?= base_url('assets/css/estilos.css') ?>">

<div class="detalle-venta-container">
    <!-- Barra superior -->
    <div class="top-bar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="<?= base_url('mis_compras') ?>" class="text-decoration-none">
                    <i class="fas fa-arrow-left me-2"></i> Volver a mis compras
                </a>
                <button onclick="window.print()" class="btn btn-outline-secondary btn-sm no-print">
                    <i class="fas fa-print me-1"></i> Imprimir comprobante
                </button>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Encabezado -->
        <div class="encabezado">
            <img src="<?= base_url('app/img/icono.png') ?>" alt="FCBox" class="logo-venta">
            <h1>Resumen de tu compra</h1>
            <div class="d-flex align-items-center justify-content-center gap-3 mb-2">
                <span class="badge bg-success bg-opacity-10 text-success">
                    <i class="fas fa-check-circle me-1"></i> Pago Aprobado
                </span>
                <span class="text-muted">#<?= esc($compra['id_venta']) ?></span>
                <span class="text-muted">•</span>
                <span class="text-muted"><?= $fecha ?></span>
            </div>
            <span class="badge">
                <?= esc(ucfirst($compra['metodo_pago'] ?? 'No especificado')) ?>
            </span>
        </div>

        <!-- Información del comprador -->
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="h5 mb-0">
                    <i class="fas fa-user me-2 text-primary"></i>
                    Información del comprador
                </h2>
            </div>
            <div class="card-body">
                <div class="info-comprador">
                    <div class="icono">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="texto">
                        <h4><?= esc($cliente['persona_nombre']) ?> <?= esc($cliente['persona_apellido']) ?></h4>
                        <p class="mb-1">
                            <i class="fas fa-envelope me-2"></i>
                            <a href="mailto:<?= esc($cliente['persona_mail']) ?>"><?= esc($cliente['persona_mail']) ?></a>
                        </p>
                        <p class="mb-1"><i class="fas fa-id-card me-2"></i> DNI: <?= esc($cliente['dni']) ?></p>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i> <?= esc($cliente['domicilio']) ?></p>
                        <p class="mb-0"><i class="fas fa-mail-bulk me-2"></i> C.P. <?= esc($cliente['codigo_postal']) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de productos -->
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="h5 mb-0">
                    <i class="fas fa-gamepad me-2 text-primary"></i>
                    Juegos adquiridos
                </h2>
            </div>
            <div class="card-body p-0">
                <?php if (!empty($detalles)): ?>
                    <?php foreach ($detalles as $item): ?>
                        <div class="producto-item">
                            <div class="row align-items-center">
                                <div class="col-2 col-md-1">
                                    <div class="bg-dark p-2 text-center rounded">
                                        <i class="fas fa-gamepad"></i>
                                    </div>
                                </div>
                                <div class="col-10 col-md-7">
                                    <h3 class="h6 mb-1"><?= esc($item['titulo_videojuego']) ?></h3>
                                    <p class="mb-0 small text-muted">ID: <?= $item['id_videojuego'] ?></p>
                                </div>
                                <div class="col-6 col-md-2 text-md-center mt-2 mt-md-0">
                                    <span class="text-muted">Cantidad: </span>
                                    <span class="fw-bold"><?= $item['detalle_cantidad'] ?></span>
                                </div>
                                <div class="col-6 col-md-2 text-end">
                                    <span class="d-block fw-bold">$<?= number_format($item['detalle_precio'] * $item['detalle_cantidad'], 2) ?></span>
                                    <span class="small text-muted">$<?= number_format($item['detalle_precio'], 2) ?> c/u</span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Resumen de pago -->
                <div class="resumen-pago mt-3">
                    <div class="row justify-content-end">
                        <div class="col-12 col-md-5">
                            <h3>Resumen del pago</h3>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal</span>
                                <span>$<?= number_format($compra['total_venta'], 2) ?></span>
                            </div>
                            <div class="d-flex justify-content-between fw-bold pt-2 mt-2 border-top">
                                <span>Total</span>
                                <span class="total">$<?= number_format($compra['total_venta'], 2) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie de página -->
        <div class="pie-pagina">
            <div class="iconos mb-3">
                <div><i class="fas fa-headset me-1"></i> Soporte 24/7</div>
                <div><i class="fas fa-shield-alt me-1"></i> Pago Seguro</div>
            </div>
            <p class="mb-0">Gracias por tu compra en FCBox</p>
            <p class="small">Si tenés alguna consulta, no dudes en contactarnos a <a href="mailto:soporte@fcbox.com.ar">soporte@fcbox.com.ar</a></p>
        </div>
    </div>
</div>
