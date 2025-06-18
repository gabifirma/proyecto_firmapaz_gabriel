<section class="mt-4 container">
    <div class="mt-3 mb-3 ms-1">
        <?php if (session('login')): ?>
            <a class="btn btn-outline-success" href="<?php echo base_url('catalogo_cliente'); ?>" role="button">Volver atrás</a>
        <?php else: ?>
            <a class="btn btn-outline-success" href="<?php echo base_url('galeria'); ?>" role="button">Volver atrás</a>
        <?php endif; ?>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($videojuegos as $juego): ?>
            <div class="col">
                <div class="card">
                <img src="<?= base_url('assets/img/' . $juego['imagen_videojuego']) ?>" class="img-fluid card-img-top" alt="">
                <div class="capa">
                    <h3><strong><?= esc($juego['titulo_videojuego']) ?></strong></h3><br>
                </div>             
                </div>
                <a href="<?php echo base_url('ver_juego/'. $juego['id_videojuego']) ?>" class="btn btn-success mt-4" role="button">Ver detalles</a> 
                <br>
            </div>
        <?php endforeach; ?>
    </div>
    
</section>