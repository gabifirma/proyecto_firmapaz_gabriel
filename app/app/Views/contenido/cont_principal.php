<section>
  <br>
  <div id="carouselExampleInterval" class="carousel slide text-center" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="4000">
        <img src="assets/img/imagen1.jpg" class="img-fluid" alt="...">
      </div>
      <div class="carousel-item" data-bs-interval="4000">
        <img src="assets/img/imagen2.jpg" class="img-fluid" alt="...">
      </div>
      <div class="carousel-item" data-bs-interval="4000">
        <img src="assets/img/imagen3.jpg" class="img-fluid" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</section>

<section class="mt-4 container">
  <hr style="border-top: 5px solid #32cd32; width: auto;">
  <h1>Top 3 Populares</h1>

  <div class="mt-3 mb-3">
    <a class="btn btn-outline-success" href="<?php echo base_url('galeria'); ?>" role="button">Mostrar todo</a>
  </div>
  
  <div class="row row-cols-1 row-cols-md-3 g-1">
    <?php foreach ($masPopulares as $juego): ?>
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

<section class="mt-3 container-xl">
  <hr style="border-top: 5px solid #32cd32; width: auto;">
  <div>
    <h1>Géneros</h1>
  </div>

  <div class="row row-cols-1 row-cols-md-5 g-1 mt-2" id="botones">
    <div class="col">
      <a href="<?php echo base_url('ver_categoria/' . 4); ?>"><button type="button" class="btn btn-outline-success btn-lg"><span class="fa-solid--chess"></span><br>Estrategia</button></a>
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
</section>