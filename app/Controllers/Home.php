<?php

namespace App\Controllers;

use App\Models\Consulta_model;
use App\Models\Videojuegos_Model;

class Home extends BaseController
{
    public function index(){
        return view('practico/header_view').view('contenido/nav_visitante').view('contenido/cont_principal').view('practico/footer_view');   
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
        $data['videojuegos'] = $modelo->findAll(); // Trae todos los registros

        return view('practico/header_view').view('contenido/nav_visitante').view('contenido/cont_galeria', $data).view('practico/footer_view');
    }
    public function login(){
        return view('practico/header_view').view('contenido/nav_visitante').view('contenido/login').view('practico/footer_view');
    }
    public function registrarse(){
        return view('practico/header_view').view('contenido/nav_visitante').view('contenido/registrarse').view('practico/footer_view');
    }
}   
