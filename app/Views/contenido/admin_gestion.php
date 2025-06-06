    
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Juegos</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

         <?php if(session('mensaje')): ?>
            <div class="alert alert-success">
                <?= session('mensaje'); ?>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Título</th>
                        <th>Desarrollador</th>
                        <th>Distribuidor</th>
                        <th>Precio</th>
                        <th>Categoría</th>
                        <th>Editar</th>
                        <th>Desactivar/Activar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($juegos)): ?>
                        <?php foreach ($juegos as $c): ?>
                            <tr>
                                <td><?= esc($c['titulo_videojuego']) ?></td>
                                <td><?= esc($c['desarrollador_videojuego']) ?></td>
                                <td><?= esc($c['distribuidor_videojuego']) ?></td>                                
                                <td>$<?= esc($c['precio_videojuego']) ?></td>
                                <td><?= esc($c['categoria_descripcion'] ?? 'Sin categoría') ?></td> 
                                <td> 
                                    <form method="get" action=" <?= base_url('editar_videojuego/' .$c['id_videojuego'])?>">
                                        <?php csrf_field()?>
                                        <button type="submit" class="btn btn-sm btn-success">Editar</button>
                                    </form>
                                </td>                        
                                <td> 
                                    <form method="post" action="<?= base_url('cambiar_estado_videojuego/' .$c['id_videojuego'])?>" 
                                        onsubmit="return confirm('¿Estás seguro de cambiar el estado del juego?');">
                                        <?= csrf_field() ?>
                                        <?php if ($c['estado_videojuego'] == 1): ?>
                                            <button type="submit" class="btn btn-sm btn-danger">Desactivar</button>
                                        <?php else: ?>
                                            <button type="submit" class="btn btn-sm btn-success">Activar</button>
                                        <?php endif; ?>
                                    </form>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay juegos subidos.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>










