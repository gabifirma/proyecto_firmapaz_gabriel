<section>

    <form action="<?php echo base_url('registro_cliente') ?>" method="post" autocomplete="off" class="formulario-registrarse row g-3 mt-5 needs-validation container-fluid" novalidate>
        
        <h2><center><br>Registrarse</center></h2>

        <?php if (!empty($validation)) : ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach ($validation as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>


        <?php if (session('mensaje_consulta')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session('mensaje_consulta'); ?>
            </div>
        <?php endif; ?>

        <div class="col-md-5">
            <label for="nombre" class="form-check-label">Nombre</label>
            <?php echo form_input(['name' => 'nombre', 'id' => 'nombre1', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese nombre', 'value' => set_value('nombre')]); ?>
        </div>

        <div class="col-md-5">
            <label for="apelido" class="form-check-label">Apellido</label>
            <?php echo form_input(['name' => 'apellido', 'id' => 'apellido1', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese apellido', 'value' => set_value('apellido')]); ?>
        </div>
        
        <div class="col-md-6">
            <label for="email" class="form-check-label">Email</label>
            <?php echo form_input(['name' => 'correo', 'id' => 'correo1', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese correo electronico', 'value' => set_value('correo')]); ?>
        </div>
        
        <div class="col-md-5">
            <label for="pais" class="form-check-label">País</label>
            <?php echo form_input(['name' => 'pais', 'id' => 'pais1', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese pais', 'value' => set_value('pais')]); ?>
        </div>
        
        <div class="col-md-5"> 
            <label for="contraseña" class="form-check-label">Contraseña</label>
            <?php echo form_input(['name' => 'contraseña', 'id' => 'contraseña1', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Ingrese contraseña', 'value' => set_value('contraseña')]); ?>
        </div>
        
        <div class="col-md-5">
            <label for="reContraseña" class="form-check-label">Repetir contraseña</label>
            <?php echo form_input(['name' => 'reContraseña', 'id' => 'reContraseña1', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Repetir contraseña', 'value' => set_value('reContraseña')]); ?>
            <div class="invalid-feedback">
        </div>
        
 
            <div class="col-2">
                <?php echo form_submit('registro_cliente', 'Finalizar', "class='btn btn-primary' type='submit'"); ?>
            </div>


        
    </form>
    <br>
    <div style="margin-bottom: 10px; margin-top: 10px; margin-left: 45%">
        <a class="btn btn-primary" href="<?php echo base_url('/'); ?>" role="button">Volver al inicio</a>
    </div>
    
    </section>