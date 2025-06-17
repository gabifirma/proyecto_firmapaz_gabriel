<h1 class="text-center mt-5">Mi perfil</h1>
<div class="container w-50">
  <?php if (session('mensaje')): ?>
    <div class="alert alert-success"><?= session('mensaje') ?></div>
  <?php endif; ?>
  <?php if (session('validation')): ?>
    <div class="alert alert-danger">
      <ul>
        <?php foreach(session('validation') as $error): ?>
          <li><?= esc($error) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>
  <?= form_open('actualizar_perfil_cliente') ?>
    <div class="form-group mt-3 mb-3">
      <label class="form-label fw-bold text-white">Nombre</label>
      <input type="text" name="nombre" class="form-control" value="<?= esc($usuario['persona_nombre']) ?>">
    </div>
    <div class="form-group mt-3 mb-3">
      <label class="form-label fw-bold text-white">Apellido</label>
      <input type="text" name="apellido" class="form-control" value="<?= esc($usuario['persona_apellido']) ?>">
    </div>
    <div class="form-group mt-3 mb-3">
      <label class="form-label fw-bold text-white">Email</label>
      <input type="email" name="correo" class="form-control" value="<?= esc($usuario['persona_mail']) ?>">
    </div>
    <div class="form-group mt-3 mb-3">
      <label class="form-label fw-bold text-white">País</label>
      <input type="text" name="pais" class="form-control" value="<?= esc($usuario['persona_pais']) ?>">
    </div>
    <div class="form-group mt-3 mb-3">
      <label class="form-label fw-bold text-white">Nueva contraseña</label>
      <input type="password" name="password" class="form-control" placeholder="(opcional)">
    </div>
    <div class="form-group mt-3 mb-3">
      <label class="form-label fw-bold text-white">Confirmar nueva contraseña</label>
      <input type="password" name="password_confirm" class="form-control" placeholder="(opcional)">
    </div>
    <div class="d-flex justify-content-end gap-2 mt-3">
      <button type="submit" class="btn btn-success">Guardar cambios</button>
      <button type="button" class="btn btn-secondary" onclick="window.location.href='<?= base_url('user_cliente') ?>';">Volver</button>
    </div>
  <?= form_close() ?>
</div>
