<?php
namespace App\Controllers;

use App\Models\Videojuegos_model;
use App\Models\Categorias_model;
use App\Models\Ventas_model;
use App\Models\Detalle_Venta_model;

class Carrito_controller extends BaseController{

    public function ver_carrito(){
        $cart = \Config\Services::cart();
        return view('practico/header_view').view('contenido/nav_cliente').view('contenido/carrito').view('practico/footer_view');
    }

    public function agregar_carrito(){
        // Iniciar el registro de depuración
        log_message('debug', '=== INICIO agregar_carrito ===');
        
        // Obtener instancias de servicios
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();
        $response = service('response');
        
        // Verificar si es una solicitud AJAX
        $isAjax = $request->isAJAX();
        
        // Obtener el ID del juego
        $juegoId = $request->getPost('id');
        
        // Registrar todos los datos de la solicitud
        $debugInfo = [
            'method' => $_SERVER['REQUEST_METHOD'],
            'juego_id' => $juegoId,
            'post_data' => $_POST,
            'get_data' => $_GET,
            'raw_input' => file_get_contents('php://input'),
            'session' => session()->get()
        ];
        
        log_message('debug', 'Datos de la solicitud: ' . print_r($debugInfo, true));
        
        // Verificar si se recibió el ID del juego
        if(empty($juegoId)) {
            $error = 'No se recibió el ID del juego';
            log_message('error', $error);
            log_message('debug', '=== FIN agregar_carrito (error) ===');
            
            if($isAjax) {
                return $response->setJSON(['success' => false, 'message' => $error]);
            }
            return redirect()->back()->with('error', 'No se pudo agregar el juego al carrito: ' . $error);
        }
        
        // Obtener datos del juego
        $juegoModel = new \App\Models\Videojuegos_model();
        $juego = $juegoModel->find($juegoId);
        
        if(!$juego) {
            $error = 'El juego no existe o fue eliminado';
            log_message('error', $error . ' - ID: ' . $juegoId);
            log_message('debug', '=== FIN agregar_carrito (error) ===');
            
            if($isAjax) {
                return $response->setJSON(['success' => false, 'message' => $error]);
            }
            return redirect()->back()->with('error', 'No se pudo encontrar el juego');
        }
        
        // Verificar si el juego está activo
        if($juego['estado_videojuego'] != 1) {
            $error = 'El juego no está disponible actualmente';
            log_message('error', $error . ' - ID: ' . $juegoId);
            
            if($isAjax) {
                return $response->setJSON(['success' => false, 'message' => $error]);
            }
            return redirect()->back()->with('error', $error);
        }
        
        // Verificar stock
        if($juego['videojuego_stock'] <= 0) {
            $error = 'No hay stock disponible para este juego';
            log_message('error', $error . ' - ' . $juego['titulo_videojuego']);
            
            if($isAjax) {
                return $response->setJSON(['success' => false, 'message' => $error]);
            }
            return redirect()->back()->with('error', $error);
        }
        
        try {
            // Verificar si el juego ya está en el carrito
            $itemEnCarrito = false;
            foreach($cart->contents() as $item) {
                if($item['id'] == $juego['id_videojuego']) {
                    $itemEnCarrito = $item;
                    break;
                }
            }
            
            if($itemEnCarrito) {
                // Si ya está en el carrito, aumentar la cantidad
                $nuevaCantidad = $itemEnCarrito['qty'] + 1;
                $cart->update([
                    'rowid' => $itemEnCarrito['rowid'],
                    'qty' => $nuevaCantidad
                ]);
            } else {
                // Si no está en el carrito, agregarlo
                $cart->insert([
                    'id' => $juego['id_videojuego'],
                    'name' => $juego['titulo_videojuego'],
                    'price' => $juego['precio_videojuego'],
                    'qty' => 1
                ]);
            }
            
            // Actualizar stock
            $juegoModel->update($juego['id_videojuego'], [
                'videojuego_stock' => $juego['videojuego_stock'] - 1
            ]);
            
            log_message('debug', 'Juego agregado al carrito exitosamente: ' . $juego['titulo_videojuego']);
            log_message('debug', '=== FIN agregar_carrito (éxito) ===');
            
            if($isAjax) {
                return $response->setJSON([
                    'success' => true,
                    'message' => 'Juego agregado al carrito exitosamente',
                    'carrito_count' => count($cart->contents())
                ]);
            }
            
            return redirect()->to('ver_carrito')->with('mensaje', 'Juego agregado al carrito exitosamente');
            
        } catch (\Exception $e) {
            log_message('error', 'Error al agregar al carrito: ' . $e->getMessage());
            log_message('debug', '=== FIN agregar_carrito (error) ===');
            
            if($isAjax) {
                return $response->setJSON([
                    'success' => false,
                    'message' => 'Error al agregar al carrito: ' . $e->getMessage()
                ]);
            }
            
            return redirect()->back()->with('error', 'Error al agregar al carrito: ' . $e->getMessage());
        }
        
        if($juego['videojuego_stock'] <= 0) {
            $error = 'No hay stock disponible para este juego';
            log_message('error', $error);
            if($isAjax) {
                return $response->setJSON(['success' => false, 'message' => $error]);
            }
            return redirect()->back()->with('error', 'No se pudo agregar el juego al carrito: ' . $error);
        }
        
        // Verificar si el producto ya está en el carrito
        $producto_en_carrito = false;
        foreach($cart->contents() as $item) {
            if($item['id'] == $request->getPost('id')) {
                // Si el producto ya está en el carrito, actualizar la cantidad
                $cart->update([
                    'rowid' => $item['rowid'],
                    'qty' => $item['qty'] + 1
                ]);
                $producto_en_carrito = true;
                break;
            }
        }
        
        try {
            // Si el producto no está en el carrito, agregarlo
            if(!$producto_en_carrito) {
                $data = array(
                    'id' => $request->getPost('id'),
                    'name' => $request->getPost('titulo'),
                    'price' => $request->getPost('precio'),
                    'qty' => 1,
                );
                $cart->insert($data);
            }
            
            // Actualizar el stock del juego
            $nuevoStock = $juego['videojuego_stock'] - 1;
            $juegoModel->update($juego['id_videojuego'], ['videojuego_stock' => $nuevoStock]);
            
            log_message('info', 'Juego agregado al carrito: ' . $request->getPost('titulo'));
            
            if($isAjax) {
                return $response->setJSON([
                    'success' => true,
                    'message' => 'Juego agregado al carrito exitosamente',
                    'carrito_count' => count($cart->contents())
                ]);
            }
            
            return redirect()->route('ver_carrito')->with('mensaje', 'Se actualizó el carrito exitosamente!');
            
        } catch (\Exception $e) {
            log_message('error', 'Error al agregar al carrito: ' . $e->getMessage());
            
            if($isAjax) {
                return $response->setJSON([
                    'success' => false,
                    'message' => 'Error al agregar al carrito: ' . $e->getMessage()
                ]);
            }
            
            return redirect()->back()->with('error', 'Error al agregar al carrito: ' . $e->getMessage());
        }
    }

    public function borrar($rowid){
        $cart = \Config\Services::cart();

        $cart->remove($rowid);
        return redirect()->route('ver_carrito');
    }

     public function vaciar_carrito(){
        $cart = \Config\Services::cart();
        $cart->destroy();
        return redirect()->route('ver_carrito');
    }

    public function guardar_venta(){
        $cart = \Config\Services::cart();
        $venta = new Ventas_model();
        $detalle = new Detalle_Venta_model();
        $juegos = new Videojuegos_model();

        $cart1 = $cart->contents();

        foreach($cart1 as $item){
            $juego = $juegos->where('id_videojuego', $item['id'])->first();

            if($juego['videojuego_stock'] < $item['qty']){
                return redirect()->route('ver_carrito');
            }
        }

        $data = array(
            'id_persona' => session('id'),
            'fecha_venta' => date('Y-m-d H:i:s'),
            'total_venta' => session('total'),
            'metodo_pago' => session('metodo_pago'),
        );

        $venta_id = $venta->insert($data);

        foreach($cart1 as $item){
            $detalle_venta = array(
                'id_venta' => $venta_id,
                'id_videojuego' => $item['id'],
                'detalle_cantidad' => $item['qty'],
                'detalle_precio' => $item['price'] * $item['qty'],
            );

            $juego = $juegos->where('id_videojuego', $item['id'])->first();

            $data = [
                'videojuego_stock' => $juego['videojuego_stock'] - $item['qty'],
            ];

            $juegos->update($item['id'], $data);

            $detalle->insert($detalle_venta);
        }

        $cart->destroy();
        session()->remove('metodo_pago');
        
        // Redirigir a la vista de compra exitosa
        return view('practico/header_view')
            . view('contenido/nav_cliente')
            . view('contenido/compra_exitosa')
            . view('practico/footer_view');
    }

    public function completar_datos_cliente() {
        $personasModel = new \App\Models\Personas_model();
        $usuario = $personasModel->find(session('id'));
        return view('contenido/formulario_datos_cliente', ['usuario' => $usuario]);
    }

    public function guardar_datos_cliente() {
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();
        $rules = [
            'dni' => 'required',
            'domicilio' => 'required',
            'codigo_postal' => 'required',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }
        $personasModel = new \App\Models\Personas_model();
        $personasModel->update(session('id'), [
            'dni' => $request->getPost('dni'),
            'domicilio' => $request->getPost('domicilio'),
            'codigo_postal' => $request->getPost('codigo_postal'),
        ]);
        return redirect()->to('formulario_pago');
    }

    public function formulario_pago() {
        return view('practico/header_view')
            .view('contenido/nav_cliente')
            .view('contenido/formulario_pago')
            .view('practico/footer_view');
    }

    public function guardar_pago() {
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();
        $metodo = $request->getPost('metodo_pago');
        $rules = [
            'metodo_pago' => 'required',
        ];
        if ($metodo === 'tarjeta') {
            $rules = array_merge($rules, [
                'numero_tarjeta' => 'required',
                'nombre_tarjeta' => 'required',
                'vencimiento' => 'required',
                'cvv' => 'required',
            ]);
        }
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }
        // Guardar el método de pago en sesión para usarlo en guardar_venta
        session()->set('metodo_pago', $metodo);
        return $this->guardar_venta();
    }

    public function mis_compras() {
        $ventasModel = new \App\Models\Ventas_model();
        $compras = $ventasModel
            ->where('id_persona', session('id'))
            ->orderBy('fecha_venta', 'DESC')
            ->orderBy('id_venta', 'DESC')
            ->findAll();
        return view('practico/header_view')
            .view('contenido/nav_cliente')
            .view('contenido/mis_compras', ['compras' => $compras])
            .view('practico/footer_view');
    }

    public function ver_factura($id_venta) {
        $ventasModel = new \App\Models\Ventas_model();
        $detalleModel = new \App\Models\Detalle_Venta_model();
        $juegosModel = new \App\Models\Videojuegos_model();
        $personasModel = new \App\Models\Personas_model();

        $compra = $ventasModel->where('id_venta', $id_venta)->where('id_persona', session('id'))->first();
        if (!$compra) {
            return redirect()->to('mis_compras')->with('mensaje', 'Compra no encontrada.');
        }
        $cliente = $personasModel->find($compra['id_persona']);
        $detalles = $detalleModel->where('id_venta', $id_venta)->findAll();
        // Agregar nombre de videojuego a cada detalle
        foreach ($detalles as &$item) {
            $juego = $juegosModel->find($item['id_videojuego']);
            $item['titulo_videojuego'] = $juego ? $juego['titulo_videojuego'] : 'Juego eliminado';
        }
        return view('practico/header_view')
            .view('contenido/nav_cliente')
            .view('contenido/factura', [
                'compra' => $compra,
                'cliente' => $cliente,
                'detalles' => $detalles
            ])
            .view('practico/footer_view');
    }

    public function actualizar_cantidad() {
        $cart = \Config\Services::cart();
        $rowid = $this->request->getPost('rowid');
        $qty = (int)$this->request->getPost('qty');
        
        // Validar que la cantidad sea al menos 1
        if ($qty < 1) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'La cantidad debe ser al menos 1.'
            ]);
        }
        
        $item = $cart->getItem($rowid);
        if (!$item) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'El ítem no se encontró en el carrito.'
            ]);
        }
        
        // Verificar stock
        $juegoModel = new \App\Models\Videojuegos_model();
        $juego = $juegoModel->find($item['id']);
        $stock = $juego ? $juego['videojuego_stock'] : 0;
        
        if ($qty > $stock) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No hay suficiente stock disponible para este producto.'
            ]);
        }
        
        // Actualizar la cantidad en el carrito
        $cart->update([
            'rowid' => $rowid,
            'qty' => $qty
        ]);
        
        // Si es una petición AJAX, devolver JSON
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => true,
                'subtotal' => number_format($item['price'] * $qty, 2),
                'total' => $this->calcularTotalCarrito()
            ]);
        }
        
        return redirect()->route('ver_carrito');
    }
    
    /**
     * Método para actualizar el total en la sesión (usado por AJAX)
     */
    public function actualizar_total() {
        $total = $this->request->getPost('total');
        session()->set('total', $total);
        return $this->response->setJSON(['success' => true]);
    }
    
    /**
     * Calcula el total del carrito
     */
    private function calcularTotalCarrito() {
        $cart = \Config\Services::cart();
        $total = 0;
        
        foreach ($cart->contents() as $item) {
            $total += $item['price'] * $item['qty'];
        }
        
        return $total;
    }
}