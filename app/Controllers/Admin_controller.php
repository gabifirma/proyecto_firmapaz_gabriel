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
        $ventasModel = new Ventas_Model();
        $correoModel = new Personas_Model();

        $ventas = $ventasModel->findAll();

        // Obtener nombres de juegos
        foreach ($ventas as &$venta) {
            $correo = $correoModel->find($venta['id_persona']); 
            $venta['persona_mail'] = $correo ? $correo['persona_mail'] : 'Sin email';
        }

        return view('practico/header_view')
        .view('contenido/nav_admin')
        .view('contenido/admin_ventas', ['ventas' => $ventas])
        .view('practico/footer_view');
    }

    public function detalle_venta($id){
        $detalleModel = new Detalle_Venta_Model();
        $juegosModel = new Videojuegos_Model();

        $detalles = $detalleModel->where('id_venta', $id)->findAll();

        // Obtener nombres de juegos
        foreach ($detalles as &$juego) {
            $titulo = $juegosModel->find($juego['id_videojuego']); 
            $juego['titulo_videojuego'] = $titulo ? $titulo['titulo_videojuego'] : 'Sin título';
        }

        return view('practico/header_view')
            .view('contenido/nav_admin')
            .view('contenido/admin_detalle_venta', ['detalles' => $detalles])
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

    public function marcar_leido($id_mensaje)
    {
        $modelo = new \App\Models\Consultas_model();
        $modelo->update($id_mensaje, ['leido' => 1]);
        return redirect()->back()->with('mensaje', 'Mensaje marcado como leído');
    }

    public function marcar_no_leido($id_mensaje)
    {
        $modelo = new \App\Models\Consultas_model();
        $modelo->update($id_mensaje, ['leido' => 0]);
        return redirect()->back()->with('mensaje', 'Mensaje marcado como no leído');
    }

}
