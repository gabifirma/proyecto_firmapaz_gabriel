<?php

namespace App\Controllers;

use App\Models\Consulta_model;
use App\Models\Videojuegos_model;
use App\Models\Detalle_Venta_model;

class Home extends BaseController
{
    public function index(){
        $modelo = new Videojuegos_model();
        $detalleVenta = new Detalle_Venta_Model();

        $videojuegosMasPopulares = $detalleVenta->obtenerVideojuegosMasPopulares();

        return view('practico/header_view').view('contenido/nav_visitante').view('contenido/cont_principal', ['masPopulares' => $videojuegosMasPopulares]).view('practico/footer_view');   
    }
    public function comercializacion(){
        return view('practico/header_view').view('contenido/nav_visitante').view('contenido/cont_comercializacion').view('practico/footer_view');
    }
    public function quienes_somos(){
        return view('practico/header_view').view('contenido/nav_visitante').view('contenido/quienes_somos').view('practico/footer_view');
    }
    public function contacto(){
        return view('practico/header_view').view('contenido/nav_visitante').view('contenido/contacto').view('practico/footer_view');
    }
    public function terminos(){
        return view('practico/header_view').view('contenido/nav_visitante').view('contenido/terminos_y_condiciones').view('practico/footer_view');
    }
    public function galeria(){
        $modelo = new Videojuegos_Model();
        $data['videojuegos'] = $modelo->where('estado_videojuego', 1)->findAll();// Trae todos los registros

        return view('practico/header_view').view('contenido/nav_visitante').view('contenido/cont_galeria', $data).view('practico/footer_view');
    }
    public function login(){
        return view('practico/header_view').view('contenido/nav_visitante').view('contenido/login').view('practico/footer_view');
    }
    public function registrarse(){
        return view('practico/header_view').view('contenido/nav_visitante').view('contenido/registrarse').view('practico/footer_view');
    }
}   
