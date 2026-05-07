<section class="mt-4 container">

    <div class="row row-cols-1 row-cols-md-5 g-1 mt-2" id="botones">
      <div class="col">
        <a href="<?php echo base_url('ver_categoria/4'); ?>"><button type="button" class="btn btn-outline-success btn-lg"><span class="fa-solid--chess"></span><br>Estrategia</button></a>
      </div>
      <div class="col">
        <a href="<?php echo base_url('ver_categoria/1'); ?>"><button type="button" class="btn btn-outline-success btn-lg"><span class="lucide--swords"></span><br>Acción</button></a>
      </div>
      <div class="col">
        <a href="<?php echo base_url('ver_categoria/3'); ?>"><button type="button" class="btn btn-outline-success btn-lg"><span class="mdi--compass"></span><br>Aventura</button></a>
      </div>
      <div class="col">
        <a href="<?php echo base_url('ver_categoria/5'); ?>"><button type="button" class="btn btn-outline-success btn-lg"><span class="iconoir--boxing-glove"></span><br>Pelea</button></a>
      </div>
      <div class="col">
        <a href="<?php echo base_url('ver_categoria/2'); ?>"><button type="button" class="btn btn-outline-success btn-lg"><span class="iconoir--soccer-ball"></span><br>Deportes</button></a>
      </div>
    </div>

    <div class="mt-3 mb-3 ms-1">
        <?php if (session('login')): ?>
            <a class="btn btn-outline-success" href="<?php echo base_url('catalogo_cliente'); ?>" role="button">Volver a catálogo</a>
        <?php else: ?>
            <a class="btn btn-outline-success" href="<?php echo base_url('galeria'); ?>" role="button">Volver a galería</a>
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