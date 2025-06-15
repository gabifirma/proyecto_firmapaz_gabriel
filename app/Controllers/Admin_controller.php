<?php namespace App\Controllers;

use App\Models\Consultas_Model;
use App\Models\Personas_Model;
use App\Models\Videojuegos_Model;
use App\Models\Ventas_Model;
use App\Models\Detalle_Venta_Model;
use App\Models\Categorias_Model; 



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
        $categoriasModel = new Categorias_Model(); // Agregar el modelo de categorías

        $juegos = $model->findAll();

        // Obtener nombres de categorías
        foreach ($juegos as &$juego) {
            $categoria = $categoriasModel->find($juego['id_categoria']); 
            $juego['categoria_descripcion'] = $categoria ? $categoria['categoria_descripcion'] : 'Sin categoría';
        }

        return view('practico/header_view')
            .view('contenido/nav_admin')
            .view('contenido/admin_juegos', ['juegos' => $juegos])
            .view('practico/footer_view');
    }


    public function eliminar_videojuego($id){
        $model = new Personas_Model();
        $model->delete($id);
        return redirect()->route('listar_usuarios');
    }

    public function listar_ventas(){
        $model = new Ventas_Model();
        $ventas = $model->findAll();

        return view('practico/header_view')
        .view('contenido/nav_admin')
        .view('contenido/admin_ventas', ['ventas' => $ventas])
        .view('practico/footer_view');
    }

    public function detalle_venta($id){
        $model = new Detalle_Venta_Model();

        if($model['id_venta'] == $id){
            $dventas = $model->findAll();
        }

        return view('practico/header_view')
        .view('contenido/nav_admin')
        .view('contenido/admin_detalle_venta', ['dventas' => $dventas])
        .view('practico/footer_view');
    }

    public function gestionar_juegos(){
        $model = new Videojuegos_Model();
        $categoriasModel = new Categorias_Model(); // Usar el modelo de categorías

        $juegos = $model->findAll();

        // Obtener nombres de categorías
        foreach ($juegos as &$juego) {
            $categoria = $categoriasModel->find($juego['id_categoria']);

            // Verificar si la categoría existe y tiene el campo correcto
            if ($categoria && array_key_exists('categoria_descripcion', $categoria)) {
                $juego['categoria_descripcion'] = $categoria['categoria_descripcion'];
            } else {
                $juego['categoria_descripcion'] = 'Sin categoría';
            }
        }

        return view('practico/header_view')
            .view('contenido/nav_admin')
            .view('contenido/admin_gestion', ['juegos' => $juegos])
            .view('practico/footer_view');
    }

}
