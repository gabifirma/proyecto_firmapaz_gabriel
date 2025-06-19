


<div class="container-fluid mt-4 bg-dark text-light min-vh-100 py-4">
    <?= form_open_multipart('actualizar_videojuego/'.$videojuego['id_videojuego']) ?>
    <div class="card shadow mb-4 bg-dark text-light border-secondary">
        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-secondary text-light">
            <h6 class="m-0 font-weight-bold text-primary">Editar Videojuego: <?= esc($videojuego['titulo_videojuego']) ?></h6>
            <a href="<?= site_url('gestionar_juegos') ?>" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Volver al Listado
            </a>
        </div>
        <div class="card-body bg-dark text-light">
            <?php if (session('mensaje')): ?>
                <div class="alert alert-success bg-success text-light border-success">
                    <?= session('mensaje') ?>
                </div>
            <?php endif; ?>
            <?php if (session('error')): ?>
                <div class="alert alert-danger bg-danger text-light border-danger">
                    <?= session('error') ?>
                </div>
            <?php endif; ?>
            <?php 
                $validation = session('validation') ?? null;
                if ($validation && method_exists($validation, 'getErrors')) {
                    $errors = $validation->getErrors();
                } elseif (is_array($validation)) {
                    $errors = $validation;
                } else {
                    $errors = [];
                }
            ?>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger bg-danger text-light border-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <div class="row">
                <!-- Columna principal del formulario -->
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="titulo"><strong>Título del juego</strong></label>
                        <?= form_input([
                            'name' => 'titulo',
                            'id' => 'titulo',
                            'class' => 'form-control' . (session('validation') && session('validation')->hasError('titulo') ? ' is-invalid' : ''),
                            'value' => set_value('titulo', $videojuego['titulo_videojuego']),
                            'required' => 'required'
                        ]) ?>
                        <?php if (session('validation') && session('validation')->hasError('titulo')): ?>
                            <div class="invalid-feedback"><?= session('validation')->getError('titulo') ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="descripcion"><strong>Descripción</strong></label>
                        <?= form_textarea([
                            'name' => 'descripcion',
                            'id' => 'descripcion',
                            'class' => 'form-control' . (session('validation') && session('validation')->hasError('descripcion') ? ' is-invalid' : ''),
                            'rows' => 5
                        ], set_value('descripcion', $videojuego['descripcion_videojuego'])) ?>
                        <?php if (session('validation') && session('validation')->hasError('descripcion')): ?>
                            <div class="invalid-feedback"><?= session('validation')->getError('descripcion') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="desarrollador"><strong>Desarrollador</strong></label>
                            <?= form_input([
                                'name' => 'desarrollador',
                                'id' => 'desarrollador',
                                'class' => 'form-control' . (session('validation') && session('validation')->hasError('desarrollador') ? ' is-invalid' : ''),
                                'value' => set_value('desarrollador', $videojuego['desarrollador_videojuego'])
                            ]) ?>
                            <?php if (session('validation') && session('validation')->hasError('desarrollador')): ?>
                                <div class="invalid-feedback"><?= session('validation')->getError('desarrollador') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="distribuidor"><strong>Distribuidor</strong></label>
                            <?= form_input([
                                'name' => 'distribuidor',
                                'id' => 'distribuidor',
                                'class' => 'form-control' . (session('validation') && session('validation')->hasError('distribuidor') ? ' is-invalid' : ''),
                                'value' => set_value('distribuidor', $videojuego['distribuidor_videojuego'])
                            ]) ?>
                            <?php if (session('validation') && session('validation')->hasError('distribuidor')): ?>
                                <div class="invalid-feedback"><?= session('validation')->getError('distribuidor') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="precio"><strong>Precio</strong></label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                <?= form_input([
                                    'name' => 'precio',
                                    'type' => 'number',
                                    'step' => '0.01',
                                    'min' => '0',
                                    'class' => 'form-control' . (session('validation') && session('validation')->hasError('precio') ? ' is-invalid' : ''),
                                    'value' => set_value('precio', $videojuego['precio_videojuego'])
                                ]) ?>
                                <?php if (session('validation') && session('validation')->hasError('precio')): ?>
                                    <div class="invalid-feedback"><?= session('validation')->getError('precio') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="videojuego_stock"><strong>Stock disponible</strong></label>
                            <?= form_input([
                                'name' => 'videojuego_stock',
                                'type' => 'number',
                                'min' => '0',
                                'class' => 'form-control' . (session('validation') && session('validation')->hasError('videojuego_stock') ? ' is-invalid' : ''),
                                'value' => set_value('videojuego_stock', $videojuego['videojuego_stock'])
                            ]) ?>
                            <?php if (session('validation') && session('validation')->hasError('videojuego_stock')): ?>
                                <div class="invalid-feedback"><?= session('validation')->getError('videojuego_stock') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Columna lateral -->
                <div class="col-md-4">
                    <div class="card mb-3 bg-dark text-light border-secondary">
                        <div class="card-header bg-secondary text-light">
                            <h6 class="m-0 font-weight-bold">Publicación</h6>
                        </div>
                        <div class="card-body bg-dark text-light">
                            <div class="form-group">
                                <label for="categoria"><strong>Categoría</strong></label>
                                <?php 
                                $options = [];
                                foreach($categorias as $cat) {
                                    $options[$cat['id']] = $cat['categoria_descripcion'];
                                }
                                echo form_dropdown('categoria', $options, set_value('categoria', $videojuego['id_categoria']), [
                                    'class' => 'form-control' . (session('validation') && session('validation')->hasError('categoria') ? ' is-invalid' : ''),
                                    'id' => 'categoria'
                                ]);
                                ?>
                                <?php if (session('validation') && session('validation')->hasError('categoria')): ?>
                                    <div class="invalid-feedback d-block"><?= session('validation')->getError('categoria') ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><strong>Estado</strong></label>
                                <div class="custom-control custom-switch">
                                    <?php 
                                    $activo = $videojuego['activo'] ?? 1;
                                    $checked = set_value('activo', $activo) == 1;
                                    echo form_checkbox([
                                        'name' => 'activo',
                                        'id' => 'activo',
                                        'class' => 'custom-control-input',
                                        'value' => '1',
                                        'checked' => $checked
                                    ]); 
                                    ?>
                                    <label class="custom-control-label" for="activo">Juego Activo</label>
                                </div>
                                <small class="form-text text-muted">Los juegos inactivos no se mostrarán en la tienda.</small>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-dark text-light border-secondary">
                        <div class="card-header bg-secondary text-light">
                            <h6 class="m-0 font-weight-bold">Imagen del Juego</h6>
                        </div>
                        <div class="card-body bg-dark text-light">
                            <div class="form-group">
                                <div class="custom-file">
                                    <?= form_upload([
                                        'name' => 'imagen',
                                        'id' => 'imagen',
                                        'class' => 'custom-file-input' . (session('validation') && session('validation')->hasError('imagen') ? ' is-invalid' : ''),
                                        'onchange' => 'previsualizarImagen(event)'
                                    ]) ?>
                                    <label class="custom-file-label" for="imagen">Elegir imagen...</label>
                                    <?php if (session('validation') && session('validation')->hasError('imagen')): ?>
                                        <div class="invalid-feedback d-block"><?= session('validation')->getError('imagen') ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <small class="form-text text-muted">Dejar en blanco para conservar la imagen actual.</small>
                            <div class="mt-3 text-center">
                                <p><strong>Imagen actual:</strong></p>
                                <img id="imagen-previsualizacion" 
                                     src="<?= base_url('assets/img/' . ($videojuego['imagen_videojuego'] ?: 'default-game.png')) ?>" 
                                     alt="Imagen del videojuego" 
                                     class="img-thumbnail" 
                                     style="max-width: 100%; height: auto;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right bg-secondary text-light border-secondary">
            <a href="<?= site_url('gestionar_juegos') ?>" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Guardar Cambios
            </button>
        </div>
    </div>
    <?= form_close() ?>
</div>

<script>
function previsualizarImagen(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('imagen-previsualizacion');
        output.src = reader.result;
    };
    if (event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
        // Actualizar el label del input file
        const fileName = event.target.files[0].name;
        $(event.target).next('.custom-file-label').html(fileName);
    }
}

// Para que el label del input file muestre el nombre del archivo si ya hay uno
$('.custom-file-input').on('change', function() {
   let fileName = $(this).val().split('\\').pop();
   $(this).next('.custom-file-label').addClass("selected").html(fileName);
});
</script>


