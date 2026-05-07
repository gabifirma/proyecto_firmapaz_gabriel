<?php
// Formulario para completar datos del cliente antes de la compra
?>
<link rel="stylesheet" href="<?= base_url('assets/css/formulario_cliente.css') ?>">
<?= view('practico/header_view') ?>
<?= view('contenido/nav_cliente') ?>
<div class="container mt-5">
    <h2 class="titulo-verde">Completar datos del cliente</h2>
    <?php if (session('validation')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach(session('validation') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <?= form_open('guardar_datos_cliente') ?>
        <div class="form-group mb-3">
            <label>DNI</label>
            <input type="text" name="dni" class="form-control" value="<?= esc($usuario['dni'] ?? '') ?>">
        </div>
        <div class="form-group mb-3">
            <label>Domicilio</label>
            <input type="text" name="domicilio" class="form-control" value="<?= esc($usuario['domicilio'] ?? '') ?>">
        </div>
        <div class="form-group mb-3">
            <label>Código Postal</label>
            <input type="text" name="codigo_postal" class="form-control" value="<?= esc($usuario['codigo_postal'] ?? '') ?>">
        </div>
        <div class="form-group mb-3">
            <label>Nombre</label>
            <input type="text" name="persona_nombre" class="form-control" value="<?= esc($usuario['persona_nombre'] ?? '') ?>" readonly>
        </div>
        <div class="form-group mb-3">
            <label>Apellido</label>
            <input type="text" name="persona_apellido" class="form-control" value="<?= esc($usuario['persona_apellido'] ?? '') ?>" readonly>
        </div>
        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="persona_mail" class="form-control" value="<?= esc($usuario['persona_mail'] ?? '') ?>" readonly>
        </div>
        <button type="submit" class="btn btn-success">Continuar</button>
    <?= form_close() ?>
</div>
<?= view('practico/footer_view') ?>
