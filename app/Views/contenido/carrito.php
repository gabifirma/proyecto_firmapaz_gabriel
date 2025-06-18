<?php $cart = \Config\Services::cart(); ?>

<div class="container mt-5">
    <h1 class="mb-4">Carrito de compras</h1>
    <a href="<?php echo base_url('catalogo_cliente') ?>" class="btn btn-success" role="button">Continuar comprando</a>

    <?php if ($cart->contents() == NULL): ?>
        <h2 class="text-center alert alert-danger">Carrito vacío</h2>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <?php if ($cart1 = $cart->contents()): ?>
                <thead class="table-light">
                    <tr>
                        <th>N° de Item</th>
                        <th>Nombre</th>
                        <th>Precio ($)</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $total = 0;
                        $i = 1;
                    foreach ($cart1 as $item): 
                        $juegoModel = new \App\Models\Videojuegos_model();
                        $juego = $juegoModel->find($item['id']);
                        $stock = $juego ? $juego['videojuego_stock'] : 1;
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $item['name']; ?></td>
                            <td>$<?php echo $item['price']; ?></td>
                            <td>
                                <form action="<?php echo base_url('actualizar_cantidad'); ?>" method="post" style="display:inline-block;">
                                    <input type="hidden" name="rowid" value="<?php echo $item['rowid']; ?>">
                                    <input type="number" name="qty" value="<?php echo $item['qty']; ?>" min="1" max="<?php echo $stock; ?>" class="form-control" style="width:80px; display:inline-block;">
                                    <span style="font-size:12px; color:#aaa;">Stock: <?php echo $stock; ?></span>
                                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                </form>
                            </td>
                            <td>$<?php echo $item['subtotal'] ; $total = $total + $item['subtotal'] ?></td>
                            <td><?php echo anchor('eliminar_item/' .$item['rowid'], 'Eliminar', "class='btn btn-success'; style='text-center'");?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php session()->set('total', $total); ?>
                    <tr>
                        <td>Total Compra: $<?php echo $total; ?></td>
                        <td><a href="<?php echo base_url('vaciar_carrito/all'); ?>" class="btn btn-success" role="button">Vaciar carrito</a></td>
                        <td><a href="<?php echo base_url('completar_datos_cliente'); ?>" class="btn btn-success" role="button">Ordenar compra</a></td>
                    </tr>
                </tbody>
            <?php endif; ?>
        </table>
    </div>
</div>