    <div class="container mt-5">
        <h1 class="mb-4">Lista de Juegos</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Título</th>
                        <th>Desarrolador</th>
                        <th>Distribuidor</th>
                        <th>Precio</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($juegos)): ?>
                        <?php foreach ($juegos as $c): ?>
                            <tr>
                                <td><?= esc($c['titulo_videojuego']) ?></td>
                                <td><?= esc($c['desarrollador_videojuego']) ?></td>
                                <td><?= esc($c['distribuidor_videojuego']) ?></td>                                
                                <td><?= esc($c['precio_videojuego']) ?></td>
                                <td><?= esc($c['categoria_id']) ?></td>                           
                                <!-- <td> 
                                    <form method="post" action="  /*base_url('eliminar_usuario/' .$c['id_persona']) */?>" onsubmit="return confirm('¿Estás seguro de eliminar esta consulta?');">
                                        <?php/* csrf_field() */?>
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </td>-->
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay consultas disponibles.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
