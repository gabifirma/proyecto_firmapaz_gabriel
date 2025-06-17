<div class="container mt-5">
        <h1 class="mb-4">Consultas de Consumidores</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session('mensaje')): ?>
            <div class="alert alert-success"><?= session('mensaje') ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Motivo</th>
                        <th>Mensaje</th>
                        <th>Leído</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($consultas)): ?>
                        <?php foreach ($consultas as $c): ?>
                            <tr<?= $c['leido'] ? ' class="table-success"' : '' ?>>
                                <td><?= esc($c['nombre_mensaje']) ?></td>
                                <td><?= esc($c['correo_mensaje']) ?></td>
                                <td><?= esc($c['motivo_mensaje']) ?></td>
                                <td><?= esc($c['mensaje_mensaje']) ?></td>
                                <td>
                                    <?php if ($c['leido']): ?>
                                        <span class="badge bg-success">Leído</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">No leído</span>
                                    <?php endif; ?>
                                </td>
                                <td class="d-flex gap-1">
                                    <?php if (!$c['leido']): ?>
                                    <form method="post" action="<?= base_url('marcar_leido/' . $c['id_mensaje']) ?>">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-primary">Marcar como leído</button>
                                    </form>
                                    <?php else: ?>
                                    <form method="post" action="<?= base_url('marcar_no_leido/' . $c['id_mensaje']) ?>">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-secondary">Marcar como no leído</button>
                                    </form>
                                    <?php endif; ?>
                                    <form method="post" action="<?= base_url('eliminar_consulta/' .$c['id_mensaje']) ?>" onsubmit="return confirm('¿Estás seguro de eliminar esta consulta?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No hay consultas disponibles.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
