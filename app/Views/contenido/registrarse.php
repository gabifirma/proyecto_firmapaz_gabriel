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
            <input type="text" class="form-control" id="validationCustom01" value="" required>
        </div>

        <div class="col-md-5">
            <label for="apelido" class="form-check-label">Apellido</label>
            <input type="text" class="form-control" id="validationCustom02" value="" required>
        </div>
        
        <div class="col-md-6">
            <label for="email" class="form-check-label">Email</label>
            <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>            
        </div>
        
        <div class="col-md-5">
            <label for="pais" class="form-check-label">País</label>
            <input type="text" class="form-control" id="validationDefault01" value="" required>
        </div>
        
        <div class="col-md-5"> 
            <label for="contraseña" class="form-check-label">Contraseña</label>
            <input type="text" class="form-control" id="validationCustom03" required>
        </div>
        
        <div class="col-md-5">
            <label for="reContraseña" class="form-check-label">Repetir contraseña</label>
            <input type="text" class="form-control" id="validationCustom03" required>
            <div class="invalid-feedback">
        </div>
        
        <div class="col-2">
            <button class="btn btn-primary" type="submit">Finalizar</button>
        </div>
    </form>
    <br>
    <div style="margin-bottom: 10px; margin-top: 10px; margin-left: 45%">
        <a class="btn btn-primary" href="<?php echo base_url('/'); ?>" role="button">Volver al inicio</a>
    </div>
    
    </section>