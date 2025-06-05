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

    public function form_editar_videojuego($id){
        $model = new Videojuegos_model();
        $categoria = new Categorias_model();

        $data['videojuego'] = $model->find($id);
        $data['categoria'] = $categoria->findAll();

        if (!$data['videojuego']) {
            return redirect()->to('admin_gestion')->with('mensaje', 'Videojuego no encontrado');
        }

        return view('practico/header_view').view('contenido/nav_admin').view('Backend/editar_juego', $data).view('practico/footer_view');
    }


    public function actualizar_videojuego($id){
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();

        $validation->setRules(
            [
                'titulo' => 'required|max_length[150]',
                'descripcion' => 'max_length[650]',
                'desarrollador' => 'max_length[100]',
                'distribuidor' => 'max_length[100]',
                'precio' => 'max_length[30]',
                'categoria' => 'is_not_unique[categorias.id_categoria]',
            ],
            [   //Errores
                'titulo' => [
                    'max_length' => 'Se alcanzó el límite de carácteres',
                    'required' => 'Es obligatorio el nombre',
                ],
                'descripcion' => [
                    'max_length' => 'Se alcanzó el límite de carácteres',
                ],
                'desarrollador' => [
                    'max_length' => 'Se alcanzó el límite de carácteres',
                ],
                'distribuidor' => [
                    'max_length' => 'Se alcanzó el límite de carácteres',                   
                ],
                'precio' => [
                    'max_length' => 'Se alcanzó el límite de carácteres',
                ],
                'categoria' => [
                    'is_not_unique' => 'Debe seleccionar la categoría',
                ],
            ]
        );

        if ( $validation->withRequest($request)->run() ) {
            $juego = new Videojuegos_model();
            $videojuego = $juego->find($id);
            
            $data = [];

            $img = $this->request->getFile('imagen');
            if ($img && $img->isValid() && !$img->hasMoved()) {
                $nom_aleatorio = $img->getRandomName();
                $img->move(ROOTPATH.'assets/uploads', $nom_aleatorio);
                $data= ['imagen_videojuego' => $nom_aleatorio];
            }

            $data['titulo_videojuego'] = $request->getPost('titulo') ?: $videojuego['titulo_videojuego'];
            $data['descripcion_videojuego'] = $request->getPost('descripcion') ?: $videojuego['descripcion_videojuego'];
            $data['desarrollador_videojuego'] = $request->getPost('desarrollador') ?: $videojuego['desarrollador_videojuego'];
            $data['distribuidor_videojuego'] = $request->getPost('distribuidor') ?: $videojuego['distribuidor_videojuego'];
            $data['precio_videojuego'] = $request->getPost('precio') !== '' ? $request->getPost('precio') : $videojuego['precio_videojuego'];
            $data['categoria_id'] = $request->getPost('categoria') ?: $videojuego['categoria_id'];
            $data['estado_videojuego'] = 1;

            
            $juego->update($id, $data);

            return redirect() -> route('gestionar_juego')->with('mensaje', 'Se editó el juego exitosamente!');
        }else{
            $data['validation'] = $validation->getErrors();
            $data['titulo'] = "Editar juego";

            return view('practico/header_view').view('contenido/nav_admin').view('Backend/editar_juego', $data).view('practico/footer_view');
        }
    }
}
