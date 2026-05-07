    <div class="container mt-5">
        <h1 class="mb-4" style="color: #32cd32;">Lista de Juegos</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        
        <style>
            /* Estilos para los placeholders */
            input::placeholder, textarea::placeholder {
                color: #aaa !important;
                opacity: 1 !important;
            }
            
            input::-ms-input-placeholder, textarea::-ms-input-placeholder {
                color: #aaa !important;
            }
            
            input:-ms-input-placeholder, textarea:-ms-input-placeholder {
                color: #aaa !important;
            }
            
            /* Asegurar que el texto sea blanco cuando hay contenido */
            input, textarea, select {
                color: #fff !important;
            }
        </style>

        <!-- Formulario de búsqueda avanzada -->
        <div class="card mb-4" style="background-color: #1a1a1a; border: 1px solid #333; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.3);">
            <div class="card-header" style="background-color: #2f2f2f; border-bottom: 2px solid #32cd32; color: #32cd32; font-weight: bold; padding: 10px 15px;">
                <i class="fas fa-search me-2"></i> Búsqueda Avanzada
                <small class="float-end" style="font-size: 0.8em; color: #aaa;">
                    Ejemplo: ID: 1, Título: Mario, Categoría: Aventura
                </small>
            </div>
            <div class="card-body" style="padding: 20px;">
                <form action="<?= base_url('listar_videojuegos') ?>" method="get" class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <label for="id" class="form-label" style="color: #fff; font-weight: 500; margin-bottom: 5px; display: block;">ID</label>
                        <input type="number" name="id" id="id" class="form-control" 
                               value="<?= esc($busqueda['id'] ?? '') ?>" 
                               style="background-color: #2f2f2f; border: 1px solid #444; color: #fff; height: 38px;"
                               placeholder="Ej: 1">
                    </div>
                    <div class="col-md-2">
                        <label for="titulo" class="form-label" style="color: #fff; font-weight: 500; margin-bottom: 5px; display: block;">Título</label>
                        <input type="text" name="titulo" id="titulo" class="form-control" 
                               value="<?= esc($busqueda['titulo'] ?? '') ?>" 
                               style="background-color: #2f2f2f; border: 1px solid #444; color: #fff; height: 38px;"
                               placeholder="Ej: Mario">
                    </div>
                    <div class="col-md-2">
                        <label for="desarrollador" class="form-label" style="color: #fff; font-weight: 500; margin-bottom: 5px; display: block;">Desarrollador</label>
                        <input type="text" name="desarrollador" id="desarrollador" class="form-control" 
                               value="<?= esc($busqueda['desarrollador'] ?? '') ?>" 
                               style="background-color: #2f2f2f; border: 1px solid #444; color: #fff; height: 38px;"
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
                            <a href="<?= base_url('listar_videojuegos') ?>" class="btn" style="background-color: #444; border: none; padding: 8px 15px; color: #fff; font-weight: 500; border-radius: 0 4px 4px 0; transition: all 0.3s ease; height: 38px; line-height: 22px;" 
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
                        <th>Categoría</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($juegos)): ?>
                        <?php foreach ($juegos as $juego): ?>
                            <tr>
                                <td><?= esc($juego['id_videojuego']) ?></td>
                                <td><?= esc($juego['titulo_videojuego']) ?></td>
                                <td><?= esc($juego['desarrollador_videojuego']) ?></td>
                                <td><?= esc($juego['distribuidor_videojuego']) ?></td>                                
                                <td>$<?= number_format(esc($juego['precio_videojuego']), 2) ?></td>
                                <td><?= esc($juego['categoria_descripcion'] ?? 'Sin categoría') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center" style="color: #fff;">No se encontraron juegos con los criterios de búsqueda seleccionados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div> <!-- Cierre del container principal -->
