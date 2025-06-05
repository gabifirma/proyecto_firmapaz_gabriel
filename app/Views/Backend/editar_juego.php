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

            <?php echo form_open_multipart('actualizar_videojuego')?>

                <input type="hidden" name="id_videojuego" value="<?= esc($videojuego['id_videojuego']) ?>">

                <div class="form-group mt-3">
                    <label for="titulo">Título del juego</label>
                    <?php echo form_input(['name' => 'titulo', 'id' => 'titulo', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese título del juego', 'value' => set_value('titulo')]); ?>
                </div>

                <div class="form-group mt-3">
                    <label for="descripcion">Descripción del juego</label>
                    <?php echo form_input(['name' => 'descripcion', 'id' => 'descripcion', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese la descripción del juego', 'value' => set_value('descripcion')]); ?>
                </div>

                <div class="form-group mt-3">
                    <label for="desarrollador">Desarrollador del juego</label>
                    <?php echo form_input(['name' => 'desarrollador', 'id' => 'desarrollador', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese el desarrollador del juego', 'value' => set_value('desarrollador')]); ?>
                </div>

                <div class="form-group mt-3">
                    <label for="distribuidor">Distribuidor del juego</label>
                    <?php echo form_input(['name' => 'distribuidor', 'id' => 'distribuidor', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese el distribuidor del juego', 'value' => set_value('distribuidor')]); ?>
                </div>

                <div class="form-group mt-3">
                    <label for="precio">Precio del juego ($)</label>
                    <?php echo form_input(['name' => 'precio', 'id' => 'precio', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese el precio del juego', 'value' => set_value('precio')]); ?>
                </div>

                <div class="form-group mt-3">
                    <label for="categoria">Categoria del juego</label>
                    <?php 
                        $lista['0'] = 'Seleccione la categoria';
                        foreach($categoria as $row){
                            $categoria_id = $row['id_categoria'];
                            $categoria_desc = $row['categoria_descripcion'];
                            $lista[$categoria_id] = $categoria_desc;
                        }
                        echo form_dropdown('categoria', $lista, '0', 'class="form-control"');
                    ?>
                </div>
                
                <div class="form-group mt-3">
                    <label for="imagen">Imagen del juego</label>
                    <?php echo form_upload(['name' => 'imagen', 'id' => 'imagen', 'class' => 'form-control']); ?>
                </div>
                
                <div class="form-group mt-3">
                    <?php echo form_submit('Actualizar', 'Actualizar', 'class="btn btn-success"'); ?>
                </div>

            <?php echo form_close();?>
        </div>
    </div>

   