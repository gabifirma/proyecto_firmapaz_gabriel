<?php if (!isset($juego) || empty($juego)): ?>
    <div class="mt-3 mb-3 ms-5">
        <a class="btn btn-outline-success" href="<?php echo base_url('galeria'); ?>" role="button">Volver atrás</a>
    </div>
    <div class="alert alert-warning">Juego no encontrado.</div>
<?php else: ?>
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
                <img src="<?= base_url('assets/img/' . $juego['imagen_videojuego']) ?>" class="img-fluid card-img-top" alt="<?= esc($juego['titulo_videojuego']) ?>" onerror="this.src='<?= base_url('assets/img/icono.png') ?>'">
            </div>
        </aside>
        <section>
            <div>
                <h3><strong>Título:</strong> <?= esc($juego['titulo_videojuego']) ?></h3>
                <h3><strong>Desarrollador:</strong> <?= esc($juego['desarrollador_videojuego']) ?></h3>
                <h3><strong>Distribuidor:</strong> <?= esc($juego['distribuidor_videojuego']) ?></h3>
                <h3><strong>Precio:</strong> $<?= esc($juego['precio_videojuego']) ?></h3>
                <h3><strong>Categoria:</strong> <?= esc($juego['titulo_videojuego']) ?></h3>
                <h3><strong>Stock:</strong> <?= esc($juego['videojuego_stock']) ?> Unidades</h3>
                <h4><strong>Descripción:</strong> <?= esc($juego['descripcion_videojuego']) ?></h4>
            </div>
            <div style="text-align: center; margin-top: 20px;">
                <?php if(session('login')){
                    if($juego['videojuego_stock'] > 0) {
                        echo '<form action="'.base_url('add_cart').'" method="post" id="form-agregar-carrito">';
                        echo '<input type="hidden" name="id" value="'.$juego['id_videojuego'].'">';
                        echo '<input type="hidden" name="titulo" value="'.htmlspecialchars($juego['titulo_videojuego']).'">';
                        echo '<input type="hidden" name="precio" value="'.$juego['precio_videojuego'].'">';
                        echo '<button type="submit" class="btn btn-success" style="padding: 10px 20px; font-size: 16px;">';
                        echo '<i class="fas fa-cart-plus me-2"></i>Agregar al carrito';
                        echo '</button>';
                        echo '</form>';
                        
                        echo '<script>
                        document.getElementById("form-agregar-carrito").addEventListener("submit", function(e) {
                            console.log("Formulario enviado");
                            console.log("Datos del formulario:", {
                                id: this.querySelector("[name=id]").value,
                                titulo: this.querySelector("[name=titulo]").value,
                                precio: this.querySelector("[name=precio]").value
                            });
                        });
                        </script>';
                    } else {
                        echo '<div class="alert alert-warning" style="text-align: center;">
                                <i class="fas fa-exclamation-triangle me-2"></i>Producto sin stock
                              </div>';
                    }
                } else {
                    echo '<div class="alert alert-info" style="text-align: center;">
                            <i class="fas fa-info-circle me-2"></i>Inicia sesión para agregar al carrito
                          </div>';
                } ?>
            </div>
        </section>
    </div>
<?php endif; ?>
