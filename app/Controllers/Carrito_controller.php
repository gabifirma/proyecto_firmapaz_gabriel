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
            'fecha_venta' => date('Y-m-d'),
            'total_venta' => session('total'),
        );

        $venta_id = $venta->insert($data);

        $cart1 = $cart->contents();

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
        // Aquí puedes guardar los datos de pago si lo deseas
        // Luego registrar la venta
        return $this->guardar_venta();
    }
}