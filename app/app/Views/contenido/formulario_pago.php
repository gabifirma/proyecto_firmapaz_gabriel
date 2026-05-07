<?php
// Formulario para seleccionar medio de pago y completar datos de tarjeta si corresponde
?>
<div class="container mt-5">
    <h2 class="titulo-contacto">Seleccionar medio de pago</h2>
    <?php if (session('validation')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach(session('validation') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <?= form_open('guardar_pago') ?>
        <div class="form-group mb-3">
            <label class="mb-2">Método de pago</label>
            <select name="metodo_pago" id="metodo_pago" class="form-control" onchange="mostrarCamposTarjeta()">
                <option value="efectivo">Efectivo</option>
                <option value="transferencia">Transferencia</option>
                <option value="tarjeta">Tarjeta</option>
            </select>
        </div>
        <div id="campos_tarjeta" style="display:none;">
            <div class="form-group mb-3">
                <label>Número de tarjeta</label>
                <input type="text" name="numero_tarjeta" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label>Nombre en la tarjeta</label>
                <input type="text" name="nombre_tarjeta" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label>Vencimiento</label>
                <input type="text" name="vencimiento" class="form-control" placeholder="MM/AA">
            </div>
            <div class="form-group mb-3">
                <label>CVV</label>
                <input type="text" name="cvv" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-success">Finalizar compra</button>
    <?= form_close() ?>
</div>
<script>
function mostrarCamposTarjeta() {
    var metodo = document.getElementById('metodo_pago').value;
    document.getElementById('campos_tarjeta').style.display = (metodo === 'tarjeta') ? 'block' : 'none';
}
</script>
