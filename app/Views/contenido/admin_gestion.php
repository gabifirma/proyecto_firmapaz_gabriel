    <style>
        /* Estilos para los placeholders */
        ::placeholder {
            color: #aaa !important;
            opacity: 1; /* Firefox */
        }
        
        :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: #aaa !important;
        }
        
        ::-ms-input-placeholder { /* Microsoft Edge */
            color: #aaa !important;
        }
        
        /* Estilo para el texto de los inputs */
        input, select, textarea {
            color: #fff !important;
        }
        
        /* Estilo para el texto del placeholder cuando el input tiene foco */
        input:focus::placeholder {
            color: #ddd !important;
        }
    </style>
    
    <div class="container mt-5">
        <h1 class="mb-4" style="color: #32cd32;">Gestión de Juegos</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if(session('mensaje')): ?>
            <div class="alert alert-success">
                <?= session('mensaje'); ?>
            </div>
        <?php endif; ?>

        <!-- Formulario de búsqueda avanzada -->
        <div class="card mb-4" style="background-color: #1a1a1a; border: 1px solid #333; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.3);">
            <div class="card-header" style="background-color: #2f2f2f; border-bottom: 2px solid #32cd32; color: #32cd32; font-weight: bold; padding: 10px 15px;">
                <i class="fas fa-search me-2"></i> Búsqueda Avanzada
            </div>
            <div class="card-body" style="padding: 20px;">
                <form action="<?= base_url('gestionar_juegos') ?>" method="get" class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <label for="id" class="form-label" style="color: #fff; font-weight: 500; margin-bottom: 5px; display: block;">ID</label>
                        <input type="number" name="id" id="id" class="form-control" 
                               value="<?= esc($busqueda['id'] ?? '') ?>" 
                               style="background-color: #2f2f2f; border: 1px solid #444; height: 38px;"
                               placeholder="Ej: 1">
                    </div>
                    <div class="col-md-2">
                        <label for="titulo" class="form-label" style="color: #fff; font-weight: 500; margin-bottom: 5px; display: block;">Título</label>
                        <input type="text" name="titulo" id="titulo" class="form-control" 
                               value="<?= esc($busqueda['titulo'] ?? '') ?>" 
                               style="background-color: #2f2f2f; border: 1px solid #444; height: 38px;"
                               placeholder="Ej: Mario">
                    </div>
                    <div class="col-md-2">
                        <label for="desarrollador" class="form-label" style="color: #fff; font-weight: 500; margin-bottom: 5px; display: block;">Desarrollador</label>
                        <input type="text" name="desarrollador" id="desarrollador" class="form-control" 
                               value="<?= esc($busqueda['desarrollador'] ?? '') ?>" 
                               style="background-color: #2f2f2f; border: 1px solid #444; height: 38px;"
                               placeholder="Ej: Nintendo">
                    </div>
                    <div class="col-md-2">
                        <label for="distribuidor" class="form-label" style="color: #fff; font-weight: 500; margin-bottom: 5px; display: block;">Distribuidor</label>
                        <input type="text" name="distribuidor" id="distribuidor" class="form-control" 
                               value="<?= esc($busqueda['distribuidor'] ?? '') ?>" 
                               style="background-color: #2f2f2f; border: 1px solid #444; height: 38px;"
                               placeholder="Ej: Nintendo">
                    </div>
                    <div class="col-md-2">
                        <label for="categoria" class="form-label" style="color: #fff; font-weight: 500; margin-bottom: 5px; display: block;">Categoría</label>
                        <select name="categoria" id="categoria" class="form-control" 
                                style="background-color: #2f2f2f; border: 1px solid #444; color: #fff; height: 38px;">
                            <option value="">Todas las categorías</option>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['id'] ?>" 
                                    <?= (isset($busqueda['categoria']) && $busqueda['categoria'] == $categoria['id']) ? 'selected' : '' ?>>
                                    <?= esc($categoria['categoria_descripcion']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex">
                        <div class="btn-group w-100" role="group">
                            <button type="submit" class="btn" style="background-color: #32cd32; border: none; padding: 8px 15px; color: #fff; font-weight: 500; border-radius: 4px 0 0 4px; transition: all 0.3s ease; height: 38px;">
                                <i class="fas fa-search me-1"></i> Buscar
                            </button>
                            <a href="<?= base_url('gestionar_juegos') ?>" class="btn" style="background-color: #444; border: none; padding: 8px 15px; color: #fff; font-weight: 500; border-radius: 0 4px 4px 0; transition: all 0.3s ease; height: 38px; line-height: 22px;" 
                               title="Limpiar filtros">
                                <i class="fas fa-undo"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive mb-4">
            <table class="table table-striped table-bordered align-middle" style="background-color: #2f2f2f; color: #fff; border-color: #444; margin-bottom: 20px;">
                <thead style="background-color: #1a1a1a; color: #32cd32;">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Desarrollador</th>
                        <th>Distribuidor</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($juegos)): ?>
                        <?php foreach ($juegos as $juego): ?>
                            <tr style="border-bottom: 1px solid #444;">
                                <td><?= esc($juego['id_videojuego']) ?></td>
                                <td><?= esc($juego['titulo_videojuego']) ?></td>
                                <td><?= esc($juego['desarrollador_videojuego']) ?></td>
                                <td><?= esc($juego['distribuidor_videojuego']) ?></td>
                                <td>$<?= number_format($juego['precio_videojuego'], 2, ',', '.') ?></td>
                                <td class="text-center">
                                    <span class="badge" style="background-color: <?= $juego['videojuego_stock'] > 0 ? '#28a745' : '#dc3545' ?>; font-size: 0.9em;">
                                        <?= $juego['videojuego_stock'] ?? '0' ?>
                                    </span>
                                </td>
                                <td><?= esc($juego['categoria_descripcion'] ?? 'Sin categoría') ?></td>
                                <td>
                                    <?php if ($juego['estado_videojuego'] == 1): ?>
                                        <span class="badge bg-success">Activo</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Inactivo</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-nowrap">
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('editar_videojuego/' . $juego['id_videojuego']) ?>" 
                                           class="btn btn-sm" 
                                           style="background-color: #32cd32; color: white; margin-right: 5px;"
                                           title="Editar juego">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="post" 
                                              action="<?= base_url('cambiar_estado_videojuego/' . $juego['id_videojuego']) ?>" 
                                              onsubmit="return confirm('¿Estás seguro de cambiar el estado del juego?');"
                                              style="display: inline-block;">
                                            <?= csrf_field() ?>
                                            <?php if ($juego['estado_videojuego'] == 1): ?>
                                                <button type="submit" class="btn btn-sm btn-danger" title="Desactivar juego">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            <?php else: ?>
                                                <button type="submit" class="btn btn-sm btn-success" title="Activar juego">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            <?php endif; ?>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center py-4" style="color: #aaa;">
                                <i class="fas fa-gamepad fa-2x mb-3 d-block"></i>
                                No se encontraron juegos que coincidan con los criterios de búsqueda
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Script para mantener el valor de los campos de búsqueda -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Asegurar que los placeholders se vean correctamente
        const inputs = document.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.style.color = '#fff';
            if (input.value) {
                input.style.color = '#fff';
            }
            input.addEventListener('focus', function() {
                this.style.color = '#fff';
            });
            input.addEventListener('blur', function() {
                if (this.value) {
                    this.style.color = '#fff';
                } else {
                    this.style.color = '#fff';
                }
            });
        });
    });
    </script>
