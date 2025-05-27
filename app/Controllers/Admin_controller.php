<?php namespace App\Controllers;

use App\Models\Consultas_Model;
use App\Models\Personas_Model;
use App\Models\Videojuegos_Model;

class Admin_controller extends BaseController
{
    public function mostrar_consultas(){
        $model = new Consultas_Model();
        $consultas = $model->findAll();

        return view('practico/header_view').view('contenido/nav_admin').view('contenido/admin_consultas', ['consultas' => $consultas]).view('practico/footer_view');
    }

    public function eliminar_consulta($id){
        $model = new Consultas_Model();
        $model->delete($id);
        return redirect()->route('mostrar_consultas');
    }

    public function listar_usuarios(){
        $model = new Personas_Model();
        $usuarios = $model->findAll();

        return view('practico/header_view').view('contenido/nav_admin').view('contenido/admin_usuarios', ['usuarios' => $usuarios]).view('practico/footer_view');
    }

    public function eliminar_usuario($id){
        $model = new Personas_Model();
        $model->delete($id);
        return redirect()->route('listar_usuarios');
    }

    public function listar_videojuegos(){
        $model = new Videojuegos_Model();
        $juegos = $model->findAll();

        return view('practico/header_view').view('contenido/nav_admin').view('contenido/admin_juegos', ['juegos' => $juegos]).view('practico/footer_view');
    }

    public function eliminar_videojuego($id){
        $model = new Personas_Model();
        $model->delete($id);
        return redirect()->route('listar_usuarios');
    }
}
