    <div class="container mt-5">
        <h1 class="mb-4">Consultas de Consumidores</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Mensaje</th>
                        <th>Motivo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($consultas)): ?>
                        <?php foreach ($consultas as $c): ?>
                            <tr>
                                <td><?= esc($c['nombre_mensaje']) ?></td>
                                <td><?= esc($c['correo_mensaje']) ?></td>
                                <td><?= esc($c['motivo_mensaje']) ?></td>
                                <td><?= esc($c['mensaje_mensaje']) ?></td>                                
                                <td>
                                    <form method="post" action="<?= base_url('eliminar_consulta/' .$c['id_mensaje']) ?>" onsubmit="return confirm('¿Estás seguro de eliminar esta consulta?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </td>
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
