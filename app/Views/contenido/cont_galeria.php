  <section class="mt-4 container">
    
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($videojuegos as $juego): ?>
          <div class="col">
              <div class="card">
                <?php
                  $imagenBase64 = base64_encode($juego['imagen_videojuego']);
                  $mimeType = 'image/jpeg';
                ?>
                <img src="data:<?= $mimeType ?>;base64,<?= $imagenBase64 ?>" class="img-fluid card-img-top" alt="">
                <div class="capa">
                    <h3><strong><?= esc($juego['titulo_videojuego']) ?></strong></h3><br>
                    <p><strong>Desarrollador:</strong> <?= esc($juego['desarrollador_videojuego']) ?></p>
                    <p><strong>Publicado por:</strong> <?= esc($juego['distribuidor_videojuego']) ?></p>
                </div>
                <a href="<?= base_url('galeria') ?>" class="stretched-link"></a>
              </div>
              <br>
              <?php if(session('login')){
                  echo form_open('add_cart');
                    echo form_hidden('id', $juego['id_videojuego']);
                    echo form_hidden('titulo', $juego['titulo_videojuego']);
                    echo form_hidden('precio', $juego['precio_videojuego']);
                    echo form_submit('comprar', 'Agregar al carrito', "class='btn btn-success'; style='text-center'");
                    echo form_close();
                } ?>
          </div>
        <?php endforeach; ?>
    </div>
  
  </section>