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
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();

        $data = array(
            'id' => $request->getPost('id'),
            'name' => $request->getPost('titulo'),
            'price' => $request->getPost('precio'),
            'qty' => 1,
        );

        $cart->insert($data);
        return redirect() -> route('ver_carrito')->with('mensaje', 'Se agregó al carrito exitosamente!');
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
                'detalle_cantidad' => 1,
                'detalle_precio' => $item['price'],
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
        return redirect()->route('catalogo_cliente');
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
        $item = $cart->getItem($rowid);
        $juegoModel = new \App\Models\Videojuegos_model();
        $juego = $juegoModel->find($item['id']);
        $stock = $juego ? $juego['videojuego_stock'] : 1;
        if ($qty > $stock) {
            return redirect()->route('ver_carrito')->with('mensaje', 'No hay suficiente stock disponible para este producto.');
        }
        $cart->update([
            'rowid' => $rowid,
            'qty' => $qty
        ]);
        return redirect()->route('ver_carrito');
    }
}