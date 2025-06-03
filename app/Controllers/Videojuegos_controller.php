<?php
namespace App\Controllers;

use App\Models\Videojuegos_model;
use App\Models\Categorias_model;

class Videojuegos_controller extends BaseController{

    public function form_agregar_juego(){
        $categoria = new Categorias_model();
        $data['categoria'] = $categoria->findAll();
        $data['titulo'] = 'agregar videojuego';
        return view('practico/header_view').view('contenido/nav_admin').view('Backend/agregar_juego', $data).view('practico/footer_view');
    }

    public function registrar_juego(){
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();

        $validation->setRules(
            [
                'titulo' => 'required|max_length[150]',
                'descripcion' => 'required|max_length[650]',
                'desarrollador' => 'required|max_length[100]',
                'distribuidor' => 'required|max_length[100]',
                'precio' => 'required|max_length[30]',
                'categoria' => 'required|is_not_unique[categorias.id_categoria]',
                'imagen' => 'uploaded[imagen]',
            ],
            [   //Errores
                'titulo' => [
                    'required' => 'El título es obligatorio',
                ],
                'descripcion' => [
                    'required' => 'La decripción es obligatoria',
                ],
                'desarrollador' => [
                    'required' => 'El desarrollador es obligatorio',
                ],
                'distribuidor' => [
                    'required' => 'El distribuidor es obligatorio',                   
                ],
                'precio' => [
                    'required' => 'El precio es obligatorio',
                ],
                'categoria' => [
                    'required' => 'La categoría es obligatoria',
                    'is_not_unique' => 'Debe seleccionar la categoría',
                ],
                'imagen' => [
                    'uploaded' => 'Debe seleccionar una imagen',
                ],
            ]
        );

        if ( $validation->withRequest($request)->run() ) {
            $img = $this->request->getFile('imagen');
            $nom_aleatorio = $img->getRandomName();
            $img->move(ROOTPATH.'assets/uploads', $nom_aleatorio);

            $data = [
                'titulo_videojuego' => $request->getPost('titulo'),
                'descripcion_videojuego' => $request->getPost('descripcion'),
                'desarrollador_videojuego' => $request->getPost('desarrollador'),
                'distribuidor_videojuego' => $request->getPost('distribuidor'),
                'precio_videojuego' => $request->getPost('precio'),
                'imagen_videojuego' => $nom_aleatorio,
                'categoria_id' => $request->getPost('categoria'),
                'estado_videojuego' => 1,
            ];

            $juego = new Videojuegos_model();
            $juego->insert($data);

            return redirect() -> route('agregar_juego')->with('mensaje', 'Se subió el juego exitosamente!');
        }else{
            $categoria = new Categorias_model();      
            $data['validation'] = $validation->getErrors();
            $data['categoria'] = $categoria->findAll();
            $data['titulo'] = "Agregar juego";

            return view('practico/header_view').view('contenido/nav_admin').view('Backend/agregar_juego', $data).view('practico/footer_view');
        }
    }

    public function gestionar_juegos(){
        $juego_Model = new Videojuegos_model();
        $categoria = new Categorias_model();

        $data['juego'] = $juego_Model->join('videojuegos', 'videojuegos.id_categoria = videojuegos.id_categoria')->findAll();

        $data['titulo'] = 'listar juego';

        return view('practico/header_view').view('contenido/nav_admin').view('Backend/admin_juegos').view('practico/footer_view');
    }
}
