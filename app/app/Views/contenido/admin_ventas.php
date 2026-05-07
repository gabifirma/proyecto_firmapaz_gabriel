<div class="container mt-5">
        <h1 class="mb-4">Lista de Ventas</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <!-- Formulario de búsqueda avanzada -->
        <div class="card mb-4" style="background-color: #1a1a1a; border: 1px solid #333; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.3);">
            <div class="card-header" style="background-color: #2f2f2f; border-bottom: 2px solid #32cd32; color: #32cd32; font-weight: bold; padding: 10px 15px;">
                <i class="fas fa-search me-2"></i> Búsqueda Avanzada
            </div>
            <div class="card-body" style="padding: 20px;">
                <form action="<?= base_url('listar_ventas') ?>" method="get" class="row g-3">
                    <div class="col-md-2">
                        <label for="id_venta" class="form-label" style="color: #fff; font-weight: 500; margin-bottom: 5px; display: block;">ID Venta</label>
                        <input type="number" name="id_venta" id="id_venta" class="form-control" 
                               value="<?= esc($busqueda['id_venta'] ?? '') ?>" 
                               style="background-color: #2f2f2f; border: 1px solid #444; color: #fff;"
                               placeholder="Ej: 4">
                    </div>
                    <div class="col-md-2">
                        <label for="dni" class="form-label" style="color: #fff; font-weight: 500; margin-bottom: 5px; display: block;">DNI</label>
                        <input type="text" name="dni" id="dni" class="form-control" 
                               value="<?= esc($busqueda['dni'] ?? '') ?>" 
                               style="background-color: #2f2f2f; border: 1px solid #444; color: #fff;"
                               placeholder="Ej: 12345678">
                    </div>
                    <div class="col-md-2">
                        <label for="nombre" class="form-label" style="color: #fff; font-weight: 500; margin-bottom: 5px; display: block;">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" 
                               value="<?= esc($busqueda['nombre'] ?? '') ?>" 
                               style="background-color: #2f2f2f; border: 1px solid #444; color: #fff;"
                               placeholder="Ej: Juan">
                    </div>
                    <div class="col-md-2">
                        <label for="apellido" class="form-label" style="color: #fff; font-weight: 500; margin-bottom: 5px; display: block;">Apellido</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" 
                               value="<?= esc($busqueda['apellido'] ?? '') ?>" 
                               style="background-color: #2f2f2f; border: 1px solid #444; color: #fff;"
                               placeholder="Ej: Pérez">
                    </div>
                    <div class="col-md-2">
                        <label for="fecha" class="form-label" style="color: #fff; font-weight: 500; margin-bottom: 5px; display: block;">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" 
                               value="<?= esc($busqueda['fecha'] ?? '') ?>"
                               style="background-color: #2f2f2f; border: 1px solid #444; color: #fff; padding: 8px;">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="btn-group w-100" role="group" style="margin-top: 24px;">
                            <button type="submit" class="btn" style="background-color: #32cd32; border: none; padding: 8px 15px; color: #fff; font-weight: 500; border-radius: 4px 0 0 4px; transition: all 0.3s ease;">
                                <i class="fas fa-search me-1"></i> Buscar
                            </button>
                            <a href="<?= base_url('listar_ventas') ?>" class="btn" style="background-color: #444; border: none; padding: 8px 15px; color: #fff; font-weight: 500; border-radius: 0 4px 4px 0; transition: all 0.3s ease;">
                                <i class="fas fa-undo"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <style>
            /* Efecto hover para los inputs */
            .form-control:focus {
                border-color: #32cd32 !important;
                box-shadow: 0 0 0 0.2rem rgba(50, 205, 50, 0.25) !important;
                background-color: #3a3a3a !important;
            }
            
            /* Estilo para el botón de búsqueda al pasar el mouse */
            .btn[style*="background-color: #32cd32;"]:hover {
                background-color: #2a8a2a !important;
                transform: translateY(-1px);
            }
            
            /* Estilo para el botón de limpiar al pasar el mouse */
            .btn[style*="background-color: #444;"]:hover {
                background-color: #555 !important;
                transform: translateY(-1px);
            }
            
            /* Estilo para los placeholders */
            ::placeholder {
                color: #888 !important;
                opacity: 1;
            }
            
            /* Estilo para el input de fecha */
            input[type="date"]::-webkit-calendar-picker-indicator {
                filter: invert(1);
                opacity: 0.8;
                cursor: pointer;
            }
        </style>

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