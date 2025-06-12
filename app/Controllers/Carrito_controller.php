<?php
namespace App\Controllers;

use App\Models\Videojuegos_model;
use App\Models\Categorias_model;

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


}