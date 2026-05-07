
<section id="contacto">
    
  <h1>Información de Contacto</h1>
      
  <div class="datos-contacto">
      <p><strong>Titular:</strong> Gabriel Firmapaz y Tomas Conti</p>
      <p><strong>Razón Social:</strong> FC Box S.A.</p>
      <p><strong>Domicilio Legal:</strong> Av. Gamer Digital 1234, Buenos Aires, Argentina</p>
      <p><strong>Teléfonos:</strong> +54 11 5555-1234 / +54 11 5555-5678</p>
      <p><strong>Correo Electrónico:</strong> <a href="mailto:contacto@fcbox.com.ar">contacto@fcbox.com.ar</a></p>
  </div>

  <div>
    <br>
    <h2><center>Ubicación</center></h2>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3540.0900624775923!2d-58.834789226832285!3d-27.46645537632145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456ca6d24ec0c9%3A0xb92ce3fedb0d7729!2sFacultad%20de%20Ciencias%20Exactas%20y%20Naturales%20y%20Agrimensura!5e0!3m2!1ses!2sar!4v1744844605126!5m2!1ses!2sar" width=100% height="450" style="border:0;" allowfullscreen="" loading="lazy" ></iframe>

  </div>

  <div class="formulario-registrarse row g-3 mt-5 needs-validation container-fluid" >
    <h2> <center><br>Contactanos</center></h2>
    
    <?php if (isset($validation)) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $validation->listErrors(); ?>
      </div>
    <?php endif; ?>

    <?php if (session('mensaje_consulta')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session('mensaje_consulta'); ?>
      </div>
    <?php endif; ?>

    <form action="<?php echo base_url('consulta') ?>" method="post" autocomplete="off">
      
      <div class="col-md-4">
        <label for="nombre" class="form-label">Nombre</label>
        <?php echo form_input(['name' => 'nombre', 'id' => 'nombre', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese nombre', 'value' => set_value('nombre')]); ?>
      </div>
      
      <div class="col-md-4">
        <label for="apellido" class="form-label">Apellido</label>
        <?php echo form_input(['name' => 'apellido', 'id' => 'apellido', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese apellido', 'value' => set_value('apellido')]); ?>
      </div>
      
      <div class="col-md-4">
        <label for="correo" class="form-label">Correo electrónico</label>
        <?php echo form_input(['name' => 'correo', 'id' => 'correo', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'name@example.com', 'value' => set_value('correo')]); ?>
      </div>
      
      <div class="col-md-6">
        <label for="motivo" class="form-label">Motivo</label>
        <?php echo form_input(['name' => 'motivo', 'id' => 'motivo', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese motivo', 'value' => set_value('motivo')]); ?>
      </div>
      
      <div class="col-md-12">
        <label for="consulta" class="form-label">Consulta</label>
        <?php echo form_input(['name' => 'consulta', 'id' => 'consulta', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ingrese consulta', 'value' => set_value('consulta')]); ?>
      </div>
      
      <div class="col-12 mt-4">
        <?php echo form_submit('Consulta', 'Enviar formulario', "class='btn btn-primary' type='submit'"); ?>
      </div>
    
    </form>
  
  </div>
</section>