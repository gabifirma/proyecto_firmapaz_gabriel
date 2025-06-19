

<h1 class="text-center mt-5">Editar Juegos</h1>
        <div class="container-fluid">
            <div class="w-50 mx-auto" id="contacto">
                
                <?php if (!empty($validation)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($validation as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <?php if(session('mensaje')): ?>
                    <div class="alert alert-success">
                        <?= session('mensaje'); ?>
                    </div>
                <?php endif; ?>

                <?php 
                $hidden = ['_method' => 'POST'];
                echo form_open_multipart(site_url('actualizar_videojuego/'.$videojuego['id_videojuego']), [], $hidden);
                echo csrf_field(); 
                ?>

                    <div class="form-group mt-3">
                        <label for="titulo">Título del juego</label>
                        <?php echo form_input(['name' => 'titulo', 'id' => 'titulo', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese título del juego', 'value' => $videojuego["titulo_videojuego"] ]);?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="descripcion">Descripción del juego</label>
                        <?php echo form_input(['name' => 'descripcion', 'id' => 'descripcion', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese la descripción del juego', 'value' => $videojuego["descripcion_videojuego"] ]); ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="desarrollador">Desarrollador del juego</label>
                        <?php echo form_input(['name' => 'desarrollador', 'id' => 'desarrollador', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese el desarrollador del juego', 'value' => $videojuego["desarrollador_videojuego"] ]); ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="distribuidor">Distribuidor del juego</label>
                        <?php echo form_input(['name' => 'distribuidor', 'id' => 'distribuidor', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese el distribuidor del juego', 'value' => $videojuego["distribuidor_videojuego"] ]); ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="precio">Precio del juego ($)</label>
                        <?php echo form_input(['name' => 'precio', 'id' => 'precio', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese el precio del juego', 'value' => $videojuego["precio_videojuego"] ]); ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="videojuego_stock">Stock disponible</label>
                        <?php echo form_input(['name' => 'videojuego_stock', 'id' => 'videojuego_stock', 'type' => 'number', 'class' => 'form-control', 'min' => '0', 'value' => $videojuego["videojuego_stock"] ]); ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="categoria">Categoría del juego</label>
                        <?php 
                            $lista = [];
                            foreach($categorias as $row){
                                $categoria_id = $row['id'];
                                $categoria_desc = $row['categoria_descripcion'];
                                $lista[$categoria_id] = $categoria_desc;
                            }
                            echo form_dropdown('categoria', $lista, $videojuego['id_categoria'], 'class="form-control"');
                        ?>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="imagen">Imagen del juego (dejar en blanco para mantener la actual)</label>
                        <?php echo form_upload(['name' => 'imagen', 'id' => 'imagen', 'class' => 'form-control']); ?>
                        <?php if(!empty($videojuego['imagen_videojuego'])): ?>
                            <small class="form-text text-muted">
                                Imagen actual: <?= $videojuego['imagen_videojuego'] ?>
                            </small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group form-check mt-3">
                        <?php 
                            $activo = isset($videojuego['estado_videojuego']) && $videojuego['estado_videojuego'] == 1 ? true : false;
                            echo form_checkbox('activo', '1', $activo, ['class' => 'form-check-input', 'id' => 'activo']);
                        ?>
                        <label class="form-check-label" for="activo">Activo</label>
                    </div>
                    
                    <div class="form-group mt-3">
                        <?php echo form_submit('Actualizar', 'Actualizar', 'class="btn btn-success"'); ?>
                        <a href="<?= base_url('gestionar_juegos') ?>" class="btn btn-secondary">Cancelar</a>
                    </div>

                <?php echo form_close();?>
            </div>
        </div>

