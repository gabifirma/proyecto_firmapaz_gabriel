  <section class="mt-4 container">

    <?php if(session('login')){
      echo form_open('add_cart');
        echo form_hidden('id', $row['id_videojuego']);
        echo form_hidden('titulo', $row['titulo_videojuego']);
        echo form_hidden('precio', $row['precio_videojuego']);
        echo form_submit('comprar', 'Agrgar al carrito', "class='btn btn-success'");
        echo form_close();
    } ?>
    
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col">
        <div class="card">
          <img src="assets/img/juego16.jpg" class="img-fluid card-img-top" alt="...">
          <div class="capa">
            <h3><strong>Battlefield 2042</strong></h3><br>
            <p><strong>Desarrollador:</strong> DICE</p>
            <p><strong>Publicado por:</strong> Electronic Arts</p>
          </div>
          <a href="<?php echo base_url('galeria'); ?>" class="stretched-link"></a>
        </div>
      </div>
    
      <div class="col">
        <div class="card">
          <img src="assets/img/juego10.jpg" class="img-fluid card-img-top" alt="...">
          <div class="capa">
            <h3><strong>Farcry 5</strong></h3><br>
            <p><strong>Desarrollador:</strong> Ubisoft Montreál</p>
            <p><strong>Publicado por:</strong> Ubisoft</p>
          </div>
          <a href="<?php echo base_url('galeria'); ?>" class="stretched-link"></a>
        </div>
      </div>
    
      <div class="col">
        <div class="card">
          <img src="assets/img/juego6.jpg" class="img-fluid card-img-top" alt="...">
          <div class="capa">
            <h3><strong>Star Wars Jedi: Fallen Order</strong></h3><br>
            <p><strong>Desarrollador:</strong> Respawn Entertainment</p>
            <p><strong>Publicado por:</strong> Electronic Arts</p>
          </div>
          <a href="<?php echo base_url('galeria'); ?>" class="stretched-link"></a>            
        </div>
      </div>
    
      <div class="col">
        <div class="card">
          <img src="assets/img/juego7.jpg" class="img-fluid card-img-top" alt="...">
          <div class="capa">
            <h3><strong>FIFA 24</strong></h3><br>
            <p><strong>Desarrollador:</strong> EA Vancouver</p>
            <p><strong>Publicado por:</strong> Electronic Arts</p>
          </div>
          <a href="<?php echo base_url('galeria'); ?>" class="stretched-link"></a>
        </div>
      </div>
      
    
      <div class="col">
        <div class="card">
          <img src="assets/img/juego8.jpg" class="img-fluid card-img-top" alt="...">
          <div class="capa">
            <h3><strong>Halo Infinite</strong></h3><br><br>
            <p><strong>Desarrollador:</strong> 343 Industries</p>
            <p><strong>Publicado por:</strong> Xbox Game Studios</p>
          </div>
          <a href="<?php echo base_url('galeria'); ?>" class="stretched-link"></a>
        </div>
      </div>
    
      <div class="col">
        <div class="card">
          <img src="assets/img/juego9.jpg" class="img-fluid card-img-top" alt="...">
          <div class="capa">
            <h3><strong>Call of Duty Blacks Ops 6: Lote Multigeneración</strong></h3><br><br>
            <p><strong>Desarrollador:</strong> Infinity Ward</p>
            <p><strong>Publicado por:</strong> Activision Blizzard</p>
          </div>
          <a href="<?php echo base_url('galeria'); ?>" class="stretched-link"></a>
        </div>
      </div>
    
      <div class="col">
        <div class="card">
          <img src="assets/img/juego11.jpg" class="img-fluid card-img-top" alt="...">
          <div class="capa">
            <h3><strong>Forza Horizon 5</strong></h3><br><br>
            <p><strong>Desarrollador:</strong> Playground Games</p>
            <p><strong>Publicado por:</strong> Xbox Game Studios</p>
          </div>
          <a href="<?php echo base_url('galeria'); ?>" class="stretched-link"></a>
        </div>
      </div>
    
      <div class="col">
        <div class="card">
          <img src="assets/img/juego12.jpg" class="img-fluid card-img-top" alt="...">
          <div class="capa">
            <h3><strong>State of Decay 2: Juggernaut Edition</strong></h3><br><br>
            <p><strong>Desarrollador:</strong> Undead Labs</p>
            <p><strong>Publicado por:</strong> Xbox Game Studios</p>
          </div>
          <a href="<?php echo base_url('galeria'); ?>" class="stretched-link"></a>
        </div>
      </div>
    
      <div class="col">
        <div class="card">
          <img src="assets/img/juego14.jpg" class="img-fluid card-img-top" alt="...">
          <div class="capa">
            <h3><strong>Among Us</strong></h3><br><br>
            <p><strong>Desarrollador:</strong> Innersloth</p>
            <p><strong>Publicado por:</strong> Innersloth</p>
          </div>
          <a href="<?php echo base_url('galeria'); ?>" class="stretched-link"></a>
        </div>
      </div>

    </div>
  
  </section>