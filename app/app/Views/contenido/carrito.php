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
                <tbody id="carrito-body">
                    <?php 
                        $total = 0;
                        $i = 1;
                    foreach ($cart1 as $item): 
                        $juegoModel = new \App\Models\Videojuegos_model();
                        $juego = $juegoModel->find($item['id']);
                        $stock = $juego ? $juego['videojuego_stock'] : 1;
                        $subtotal = $item['price'] * $item['qty'];
                        $total += $subtotal;
                    ?>
                        <tr class="item-carrito" data-rowid="<?php echo $item['rowid']; ?>">
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $item['name']; ?></td>
                            <td class="precio-unitario">$<?php echo number_format($item['price'], 2); ?></td>
                            <td>
                                <div class="input-group" style="max-width: 200px;">
                                    <input type="number" 
                                           name="qty" 
                                           value="<?php echo $item['qty']; ?>" 
                                           min="1" 
                                           max="<?php echo $stock; ?>" 
                                           class="form-control cantidad" 
                                           data-rowid="<?php echo $item['rowid']; ?>"
                                           style="text-align: center;">
                                    <span class="input-group-text" style="font-size:12px;">Stock: <?php echo $stock; ?></span>
                                </div>
                            </td>
                            <td class="subtotal">$<?php echo number_format($subtotal, 2); ?></td>
                            <td>
                                <?php echo anchor('eliminar_item/' . $item['rowid'], 'Eliminar', "class='btn btn-danger btn-sm'"); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php session()->set('total', $total); ?>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Total Compra:</td>
                        <td id="total-carrito" class="fw-bold">$<?php echo number_format($total, 2); ?></td>
                        <td>
                            <a href="<?php echo base_url('vaciar_carrito/all'); ?>" class="btn btn-danger btn-sm" role="button">
                                Vaciar carrito
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-end">
                            <a href="<?php echo base_url('completar_datos_cliente'); ?>" class="btn btn-success" role="button">
                                <i class="fas fa-credit-card me-1"></i> Proceder al pago
                            </a>
                        </td>
                    </tr>
                </tbody>
            <?php endif; ?>
        </table>
    </div>
</div>

<script>
// Asegurarse de que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Verificar si el carrito tiene elementos
    const carritoBody = document.getElementById('carrito-body');
    if (!carritoBody) return; // Salir si no hay elementos en el carrito

    // Función para formatear números con separadores de miles
    function formatNumber(num) {
        return num.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Función para actualizar el subtotal y el total
    function actualizarTotales() {
        let total = 0;
        const filas = document.querySelectorAll('.item-carrito');
        
        // Verificar si hay filas en el carrito
        if (filas.length === 0) {
            window.location.reload(); // Recargar si no hay filas
            return;
        }
        
        // Recorrer cada fila del carrito
        filas.forEach(row => {
            const inputCantidad = row.querySelector('.cantidad');
            const celdaPrecio = row.querySelector('.precio-unitario');
            const celdaSubtotal = row.querySelector('.subtotal');
            
            // Verificar que los elementos existen
            if (inputCantidad && celdaPrecio && celdaSubtotal) {
                const cantidad = parseInt(inputCantidad.value) || 0;
                const precio = parseFloat(celdaPrecio.textContent.replace(/[^0-9.-]+/g,""));
                const subtotal = cantidad * precio;
                
                // Actualizar el subtotal en la fila
                celdaSubtotal.textContent = '$' + formatNumber(subtotal);
                
                // Sumar al total
                total += subtotal;
            }
        });
        
        // Actualizar el total en la página
        const totalElement = document.getElementById('total-carrito');
        if (totalElement) {
            totalElement.textContent = '$' + formatNumber(total);
        }
        
        // Actualizar el total en la sesión
        fetch('<?= base_url('actualizar_total') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'total=' + total
        }).catch(error => console.error('Error al actualizar el total:', error));
    }
    
    // Función para actualizar la cantidad de un ítem
    function actualizarCantidad(input) {
        const rowid = input.getAttribute('data-rowid');
        let cantidad = parseInt(input.value) || 1;
        
        // Validar cantidad mínima
        if (cantidad < 1) {
            input.value = 1;
            cantidad = 1;
        }
        
        // Validar stock máximo
        const maxStock = parseInt(input.getAttribute('max')) || 99;
        if (cantidad > maxStock) {
            input.value = maxStock;
            cantidad = maxStock;
        }
        
        // Mostrar indicador de carga
        const originalHTML = input.innerHTML;
        input.disabled = true;
        
        // Actualizar cantidad en el carrito
        fetch('<?= base_url('actualizar_cantidad') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'rowid=' + encodeURIComponent(rowid) + '&qty=' + cantidad
        })
        .then(response => {
            if (!response.ok) throw new Error('Error en la respuesta del servidor');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                actualizarTotales();
            } else {
                console.error('Error al actualizar cantidad:', data.message);
                // Revertir el valor si hay un error
                input.value = data.old_qty || 1;
                actualizarTotales();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Revertir el valor si hay un error
            input.value = input.defaultValue;
            actualizarTotales();
        })
        .finally(() => {
            input.disabled = false;
        });
    }
    
    // Manejar cambios en las cantidades
    carritoBody.addEventListener('change', function(e) {
        if (e.target.classList.contains('cantidad')) {
            actualizarCantidad(e.target);
        }
    });
    
    // Inicializar totales
    actualizarTotales();
});
</script>