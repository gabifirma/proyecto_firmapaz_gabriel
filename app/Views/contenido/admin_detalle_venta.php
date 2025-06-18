<!-- Agregar el CSS personalizado -->
<link rel="stylesheet" href="<?= base_url('assets/css/estilos.css') ?>">

<div class="detalle-venta-container">
    <!-- Barra superior -->
    <div class="top-bar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="<?= base_url('listar_ventas') ?>" class="text-decoration-none text-primary">
                    <i class="fas fa-arrow-left me-2"></i> Volver al listado
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
            <h1>Resumen de la compra</h1>
            <div class="d-flex align-items-center justify-content-center gap-3 mb-2">
                <span class="badge bg-success bg-opacity-10 text-success">
                    <i class="fas fa-check-circle me-1"></i> Pago Aprobado
                </span>
                <span class="text-muted">#<?= esc($venta['id_venta']) ?></span>
                <span class="text-muted">•</span>
                <span class="text-muted"><?= $fecha ?></span>
            </div>
            <span class="badge bg-light text-dark border">
                <?= esc(ucfirst($venta['metodo_pago'] ?? 'No especificado')) ?>
            </span>
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
                                    <div class="bg-light p-2 text-center rounded">
                                        <i class="fas fa-gamepad text-muted"></i>
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
                                    <span class="d-block fw-bold">$<?= number_format($item['subtotal'], 2) ?></span>
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
                                <span>$<?= number_format($subtotal, 2) ?></span>
                            </div>
                            <div class="d-flex justify-content-between fw-bold pt-2 mt-2 border-top">
                                <span>Total</span>
                                <span class="total">$<?= number_format($venta['total_venta'] ?? $subtotal, 2) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                        <h4><?= esc($venta['persona_nombre'] . ' ' . $venta['persona_apellido']) ?></h4>
                        <p>DNI: <?= esc($venta['dni']) ?></p>
                    </div>
                </div>
                <div class="info-comprador">
                    <div class="icono">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="texto">
                        <h4>Correo electrónico</h4>
                        <p><a href="mailto:<?= esc($venta['email'] ?? '') ?>" class="text-decoration-none"><?= esc($venta['email'] ?? 'No especificado') ?></a></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detalles de la compra -->
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="h5 mb-0">
                    <i class="fas fa-info-circle me-2 text-primary"></i>
                    Detalles de la compra
                </h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-2">
                            <strong>Número de orden:</strong><br>
                            <span class="text-muted">#<?= esc($venta['id_venta']) ?></span>
                        </p>
                        <p class="mb-0">
                            <strong>Fecha de compra:</strong><br>
                            <span class="text-muted"><?= $fecha ?></span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2">
                            <strong>Método de pago:</strong><br>
                            <span class="text-muted"><?= esc(ucfirst($venta['metodo_pago'] ?? 'No especificado')) ?></span>
                        </p>
                        <p class="mb-0">
                            <strong>Estado:</strong><br>
                            <span class="badge bg-success bg-opacity-10 text-success">Completada</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie de página -->
        <div class="pie-pagina">
            <div class="iconos">
                <div>
                    <i class="fas fa-shield-alt"></i>
                    <span>Compra segura</span>
                </div>
                <div>
                    <i class="fas fa-headset"></i>
                    <span>Soporte 24/7</span>
                </div>
            </div>
            <p class="mb-1">FCBox - Tu tienda de videojuegos de confianza</p>
            <p class="mb-0">
                <i class="fas fa-envelope me-1"></i> soporte@fcbox.com.ar
            </p>
        </div>
    </div>
</div>
