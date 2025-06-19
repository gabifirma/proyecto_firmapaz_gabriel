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
                'categoria' => 'required|is_not_unique[categorias.id]',
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
            $img->move(ROOTPATH.'assets/img', $nom_aleatorio);
 
            $data = [
                'titulo_videojuego' => $request->getPost('titulo'),
                'descripcion_videojuego' => $request->getPost('descripcion'),
                'desarrollador_videojuego' => $request->getPost('desarrollador'),
                'distribuidor_videojuego' => $request->getPost('distribuidor'),
                'precio_videojuego' => $request->getPost('precio'),
                'imagen_videojuego' => $nom_aleatorio,
                'id_categoria' => $request->getPost('categoria'),
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
        $data['videojuego'] = $model->find($id);
        
        if (empty($data['videojuego'])) {
            return redirect()->to('gestionar_juegos')->with('error', 'Videojuego no encontrado');
        }
        
        $model_cat = new Categorias_model();
        $data['categorias'] = $model_cat->findAll();
        $data['titulo'] = 'Editar Videojuego';
        
        // Cargar validación de la sesión si existe
        $validation = session()->getFlashdata('validation');
        if ($validation) {
            $data['validation'] = $validation;
        }
        
        return view('practico/header_view')
             . view('contenido/nav_admin')
             . view('Backend/editar_juego', $data)
             . view('practico/footer_view');
    }

    public function cambiar_estado_videojuego($id){
        $model = new Videojuegos_model();
        $videojuego = $model->find($id);

        if (!$videojuego) {
            return redirect()->to('gestionar_juegos')->with('error', 'Videojuego no encontrado');
        }

        // Alternar estado (1 -> 0, 0 -> 1)
        $nuevo_estado = ($videojuego['estado_videojuego'] == 1) ? 0 : 1;

        $model->update($id, ['estado_videojuego' => $nuevo_estado]);

        return redirect()->to('gestionar_juegos')->with('mensaje', 'Estado del videojuego actualizado correctamente');
    }



    public function actualizar_videojuego($id) {
        log_message('debug', 'Entró a actualizar_videojuego con ID: '.$id);
        
        // Verificar que la solicitud sea POST
        if ($this->request->getMethod() !== 'post') {
            return redirect()->back()->with('error', 'Método no permitido');
        }

        helper(['form', 'url']);
        $juegoModel = new Videojuegos_model();
        $validation = \Config\Services::validation();
        $request = service('request');

        // Obtener el videojuego actual
        $videojuegoActual = $juegoModel->find($id);
        if (!$videojuegoActual) {
            return redirect()->to('gestionar_juegos')->with('error', 'Videojuego no encontrado');
        }

        // Reglas de validación
        $validation->setRules([
            'titulo' => [
                'label' => 'Título',
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => 'El título es obligatorio',
                    'max_length' => 'El título no puede tener más de 150 caracteres',
                ]
            ],
            'descripcion' => [
                'label' => 'Descripción',
                'rules' => 'required|max_length[650]',
                'errors' => [
                    'required' => 'La descripción es obligatoria',
                    'max_length' => 'La descripción no puede tener más de 650 caracteres',
                ]
            ],
            'desarrollador' => [
                'label' => 'Desarrollador',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El desarrollador es obligatorio',
                    'max_length' => 'El desarrollador no puede tener más de 100 caracteres',
                ]
            ],
            'distribuidor' => [
                'label' => 'Distribuidor',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El distribuidor es obligatorio',
                    'max_length' => 'El distribuidor no puede tener más de 100 caracteres',
                ]
            ],
            'precio' => [
                'label' => 'Precio',
                'rules' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[999999.99]',
                'errors' => [
                    'required' => 'El precio es obligatorio',
                    'numeric' => 'El precio debe ser un número válido',
                    'greater_than_equal_to' => 'El precio no puede ser negativo',
                    'less_than_equal_to' => 'El precio no puede ser mayor a 999,999.99',
                ]
            ],
            'videojuego_stock' => [
                'label' => 'Stock',
                'rules' => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[999999]',
                'errors' => [
                    'required' => 'El stock es obligatorio',
                    'integer' => 'El stock debe ser un número entero',
                    'greater_than_equal_to' => 'El stock no puede ser negativo',
                    'less_than_equal_to' => 'El stock no puede ser mayor a 999,999',
                ]
            ],
            'categoria' => [
                'label' => 'Categoría',
                'rules' => 'required|is_not_unique[categorias.id]',
                'errors' => [
                    'required' => 'La categoría es obligatoria',
                    'is_not_unique' => 'Debe seleccionar una categoría válida',
                ]
            ],
            'imagen' => [
                'label' => 'Imagen',
                'rules' => 'permit_empty|mime_in[imagen,image/jpg,image/jpeg,image/png,image/gif]|max_size[imagen,2048]',
                'errors' => [
                    'mime_in' => 'El archivo debe ser una imagen (JPG, JPEG, PNG o GIF)',
                    'max_size' => 'La imagen no puede pesar más de 2MB',
                ]
            ]
        ]);

        log_message('debug', 'Datos del formulario: ' . print_r($this->request->getPost(), true));

            if ($validation->withRequest($this->request)->run()) {
                // Mantener la imagen actual por defecto
                $nombreImagen = $videojuegoActual['imagen_videojuego'];
                
                // Procesar la nueva imagen si se subió una
                $imagen = $this->request->getFile('imagen');
                if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
                    // Eliminar la imagen anterior si existe
                    if ($nombreImagen && file_exists(ROOTPATH . 'assets/img/' . $nombreImagen)) {
                        unlink(ROOTPATH . 'assets/img/' . $nombreImagen);
                    }
                    // Generar un nombre único para la nueva imagen
                    $nombreImagen = $imagen->getRandomName();
                    $imagen->move(ROOTPATH . 'assets/img', $nombreImagen);
                }
                
                // Preparar los datos para actualizar
                $datosActualizados = [
                    'titulo_videojuego' => $this->request->getPost('titulo'),
                    'descripcion_videojuego' => $this->request->getPost('descripcion'),
                    'desarrollador_videojuego' => $this->request->getPost('desarrollador'),
                    'distribuidor_videojuego' => $this->request->getPost('distribuidor'),
                    'precio_videojuego' => $this->request->getPost('precio'),
                    'videojuego_stock' => $this->request->getPost('videojuego_stock'),
                    'id_categoria' => $this->request->getPost('categoria'),
                    'imagen_videojuego' => $nombreImagen,
                    'estado_videojuego' => $this->request->getPost('activo') ?? 0 // Si no se envía, se establece en 0 (inactivo)
                ];
                // DEPURACIÓN TEMPORAL
                log_message('debug', 'Datos para update: ' . print_r($datosActualizados, true));
                echo '<div style="background:#222;color:#fff;padding:10px;">[DEPURACIÓN] Datos para update:<pre>'.print_r($datosActualizados, true).'</pre></div>';
                
                // Actualizar el videojuego
                try {
                    $resultadoUpdate = $juegoModel->update($id, $datosActualizados);
                    log_message('debug', 'Resultado update: ' . var_export($resultadoUpdate, true));
                    
                    if ($resultadoUpdate === false) {
                        log_message('error', 'Error al actualizar el videojuego: ' . print_r($juegoModel->errors(), true));
                        return redirect()->back()
                            ->with('error', 'Error al actualizar el videojuego')
                            ->withInput();
                    }
                    
                    return redirect()->to('gestionar_juegos')
                        ->with('mensaje', 'Videojuego actualizado correctamente');
                        
                } catch (\Exception $e) {
                    log_message('error', 'Excepción al actualizar videojuego: ' . $e->getMessage());
                    return redirect()->back()
                        ->with('error', 'Error al actualizar el videojuego: ' . $e->getMessage())
                        ->withInput();
                }
            } else {
                // Si hay errores de validación, redirigir de vuelta con los errores
                return redirect()->back()
                    ->with('validation', $validation->getErrors())
                    ->withInput();
            }

        // Si es la primera carga del formulario
        $categoriaModel = new Categorias_model();
        $data['categorias'] = $categoriaModel->findAll();
        $data['videojuego'] = $videojuegoActual;
        
        return view('practico/header_view')
             . view('contenido/nav_admin')
             . view('Backend/editar_juego', $data)
             . view('practico/footer_view');
    }

    public function catalogo_cliente(){
        $modelo = new Videojuegos_Model();

        $data['videojuegos'] = $modelo->where('estado_videojuego', 1)->findAll(); // Trae todos los juegos activos

        return view('practico/header_view').view('contenido/nav_cliente').view('contenido/cont_galeria', $data).view('practico/footer_view');
    }

    public function ver_juego($id){
        $juegoModel = new Videojuegos_model();
        $session = session();
        $juego = $juegoModel->find($id);
        
        // Depuración temporal
        log_message('debug', 'ID del juego: ' . $id);
        log_message('debug', 'Datos del juego: ' . print_r($juego, true));

        if($session->get('login')){
            return view('practico/header_view')
            .view('contenido/nav_cliente')
            .view('contenido/ver_juego', ['juego' => $juego])
            .view('practico/footer_view');
        }else{
            return view('practico/header_view')
            .view('contenido/nav_visitante')
            .view('contenido/ver_juego', ['juego' => $juego])
            .view('practico/footer_view');
        }
    }

    public function ver_categoria($id_cat){
        $modelo = new Videojuegos_model();
        $session = session();
        $data['videojuegos'] = $modelo->where('id_categoria', $id_cat)->findAll(); // Trae todos los juegos en categorias

        if($session->get('login')){
            return view('practico/header_view')
            .view('contenido/nav_cliente')
            .view('contenido/ver_categoria', $data)
            .view('practico/footer_view');
        }else{
            return view('practico/header_view')
            .view('contenido/nav_visitante')
            .view('contenido/ver_categoria', $data)
            .view('practico/footer_view');
        }
    }
}
