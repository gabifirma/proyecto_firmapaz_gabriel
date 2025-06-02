<section >
        <h2><center><br>Registrarse</center></h2>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>

        <?php if (session('mensaje')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session('mensaje'); ?>
            </div>
        <?php endif; ?>

    <form action="<?php echo base_url('registro_cliente') ?>" method="post" autocomplete="off">

        <div class="col-md-5">
            <label for="nombre" class="form-label">Nombre</label>
            <?php echo form_input(['name' => 'nombre', 'id' => 'nombre1', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese nombre', 'value' => set_value('nombre')]); ?>
        </div>

        <div class="col-md-5">
            <label for="apelido" class="form-label">Apellido</label>
            <?php echo form_input(['name' => 'apellido', 'id' => 'apellido1', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese apellido', 'value' => set_value('apellido')]); ?>
        </div>
        
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <?php echo form_input(['name' => 'correo', 'id' => 'correo1', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese correo electronico', 'value' => set_value('correo')]); ?>
        </div>
        
        <div class="col-md-5">
            <label for="pais" class="form-label">País</label>
            <?php echo form_input(['name' => 'pais', 'id' => 'pais1', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese pais', 'value' => set_value('pais')]); ?>
        </div>
        
        <div class="col-md-5"> 
            <label for="contraseña" class="form-label">Contraseña</label>
            <?php echo form_input(['name' => 'contraseña', 'id' => 'contraseña1', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Ingrese contraseña', 'value' => set_value('contraseña')]); ?>
        </div>
        
        <div class="col-md-5">
            <label for="reContraseña" class="form-label">Repetir contraseña</label>
            <?php echo form_input(['name' => 'reContraseña', 'id' => 'reContraseña1', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Repetir contraseña', 'value' => set_value('reContraseña')]); ?>
        </div>
 
        <div class="col-2">
            <?php echo form_submit('registrarse', 'Finalizar', "class='btn btn-primary' type='submit'"); ?>
        </div>
        
    </form>
    <br>
    <div style="margin-bottom: 10px; margin-top: 10px; margin-left: 45%">
        <a class="btn btn-primary" href="<?php echo base_url('/'); ?>" role="button">Volver al inicio</a>
    </div>
    
</section>