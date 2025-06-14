    <div class="container mt-5">
        <h1 class="mb-4">Lista de Usuarios</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>País</th>
                        <th>ID</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usuarios)): ?>
                        <?php foreach ($usuarios as $c): ?>
                            <tr>
                                <td><?= esc($c['persona_nombre']) ?></td>
                                <td><?= esc($c['persona_apellido']) ?></td>
                                <td><?= esc($c['persona_mail']) ?></td>                                
                                <td><?= esc($c['persona_pais']) ?></td>
                                <?php if ($c['id_perfil'] == 1): ?>
                                    <td><?php echo 'Administrador' ?></td>
                                <?php else: ?>
                                    <td><?php echo 'Cliente' ?></td>
                                <?php endif; ?>                              
                                <td>
                                    <form method="post" action="<?= base_url('eliminar_usuario/' .$c['id']) ?>" onsubmit="return confirm('¿Estás seguro de eliminar esta consulta?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay usuarios adheridos.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
