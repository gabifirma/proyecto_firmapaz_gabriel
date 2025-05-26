 <section>
    <div class="card text-center formulario-login container-fluid mb-5" style="width: 45rem; margin-top: 5%">
      <div class="card-header">
        Iniciar Sesión
      </div>

      <div class="card-body">

        <?php if (isset($validation)) : ?>
          <div class="alert alert-danger" role="alert">
            <?= $validation->listErrors(); ?>
          </div>
        <?php endif; ?>

        <?php if (session('mensaje_login')) : ?>
          <div class="alert alert-success" role="alert">
            <?= session('mensaje_login'); ?>
          </div>
        <?php endif; ?>
        
        <form action="<?php echo base_url('buscar_usuario') ?>" method="post" autocomplete="off">
            
            <div class="form-floating mb-3">
                <?php echo form_input(['name' => 'correo', 'id' => 'correo', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'name@example.com', 'value' => set_value('correo')]); ?>
                <label for="floatingInput">Correo Electrónico</label>
            </div>
            <div class="form-floating">
                <?php echo form_input(['name' => 'pass', 'id' => 'pass', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Password', 'value' => set_value('pass')]); ?>
                <label for="floatingPassword">Password</label>
            </div>
            
            <div>
              <?php echo form_submit('Login', 'Entrar', "class='btn btn-primary mt-4' type='submit'"); ?>
            </div>

        </form>        
      </div>
      <p class="muted text-center">¿Nuevo usuario? <a href="<?php echo base_url('registrarse'); ?>" data-bs-toggle="tooltip" data-bs-title="Default tooltip">Registrarse</a></p>
    </div>
  </section>