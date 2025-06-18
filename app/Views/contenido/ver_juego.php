<div class="mt-3 mb-3 ms-5">
    <?php if (session('login')): ?>
        <a class="btn btn-outline-success" href="<?php echo base_url('catalogo_cliente'); ?>" role="button">Volver atrás</a>
    <?php else: ?>
        <a class="btn btn-outline-success" href="<?php echo base_url('galeria'); ?>" role="button">Volver atrás</a>
    <?php endif; ?>
</div>
<div class="juego-detalle-flex">
    <aside>
        <div>
            <img src="<?= base_url('assets/img/' . $juego['imagen_videojuego']) ?>" class="img-fluid card-img-top" alt="">
        </div> 
    </aside>
    <section>
        <div">
            <h3><strong>Título:</strong> <?= esc($juego['titulo_videojuego']) ?></h3> 
            <h3><strong>Desarrollador:</strong> <?= esc($juego['desarrollador_videojuego']) ?></h3>
            <h3><strong>Distribuidor:</strong> <?= esc($juego['distribuidor_videojuego']) ?></h3>
            <h3><strong>Título:</strong> <?= esc($juego['titulo_videojuego']) ?></h3>
            <h3><strong>Precio:</strong> $<?= esc($juego['precio_videojuego']) ?></h3>
            <h3><strong>Categoria:</strong> <?= esc($juego['titulo_videojuego']) ?></h3>
            <h3><strong>Stock:</strong> <?= esc($juego['videojuego_stock']) ?> Unidades</h3>
            <h4><strong>Descripción:</strong> <?= esc($juego['descripcion_videojuego']) ?></h4>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <?php if(session('login')){
                echo form_open('add_cart');
                echo form_hidden('id', $juego['id_videojuego']);
                echo form_hidden('titulo', $juego['titulo_videojuego']);
                echo form_hidden('precio', $juego['precio_videojuego']);
                echo form_submit('comprar', 'Agregar al carrito', "class='btn btn-success'; style='text-center'");
                echo form_close();
            } ?>
        </div> 
    </section>
</div>
