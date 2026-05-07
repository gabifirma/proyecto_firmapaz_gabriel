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
        $categoriasModel = new Categorias_Model();

        // Obtener todos los parámetros de búsqueda
        $busqueda = [
            'id' => $this->request->getGet('id'),
            'titulo' => $this->request->getGet('titulo'),
            'desarrollador' => $this->request->getGet('desarrollador'),
            'distribuidor' => $this->request->getGet('distribuidor'),
            'categoria' => $this->request->getGet('categoria')
        ];

        // Obtener todas las categorías para el select
        $categorias = $categoriasModel->findAll();
        
        // Construir la consulta base
        $builder = $model->select('videojuegos.*, categorias.categoria_descripcion')
                       ->join('categorias', 'categorias.id = videojuegos.id_categoria', 'left');
        
        // Aplicar filtros si existen
        $filtrosAplicados = false;
        
        // Filtrar por ID (búsqueda exacta)
        if (!empty($busqueda['id'])) {
            $builder->where('videojuegos.id_videojuego', $busqueda['id']);
            $filtrosAplicados = true;
        }
        
        // Filtrar por título (búsqueda parcial)
        if (!empty($busqueda['titulo'])) {
            $builder->like('videojuegos.titulo_videojuego', $busqueda['titulo']);
            $filtrosAplicados = true;
        }
        
        // Filtrar por desarrollador (búsqueda parcial)
        if (!empty($busqueda['desarrollador'])) {
            $builder->like('videojuegos.desarrollador_videojuego', $busqueda['desarrollador']);
            $filtrosAplicados = true;
        }
        
        // Filtrar por distribuidor (búsqueda parcial)
        if (!empty($busqueda['distribuidor'])) {
            $builder->like('videojuegos.distribuidor_videojuego', $busqueda['distribuidor']);
            $filtrosAplicados = true;
        }
        
        // Filtrar por categoría (selección exacta)
        if (!empty($busqueda['categoria'])) {
            $builder->where('categorias.id', $busqueda['categoria']);
            $filtrosAplicados = true;
        }
        
        // Ordenar y obtener resultados
        $juegos = $builder->orderBy('videojuegos.titulo_videojuego', 'ASC')
                         ->findAll();

        return view('practico/header_view')
            .view('contenido/nav_admin')
            .view('contenido/admin_juegos', [
                'juegos' => $juegos,
                'categorias' => $categorias,
                'busqueda' => $busqueda
            ])
            .view('practico/footer_view');
    }


    public function eliminar_videojuego($id){
        $model = new Personas_Model();
        $model->delete($id);
        return redirect()->route('listar_usuarios');
    }

    public function listar_ventas(){
        $ventasModel = new Ventas_Model();

        // Obtener todos los parámetros de búsqueda
        $busqueda = [
            'id_venta' => $this->request->getGet('id_venta'),
            'dni' => $this->request->getGet('dni'),
            'nombre' => $this->request->getGet('nombre'),
            'apellido' => $this->request->getGet('apellido'),
            'fecha' => $this->request->getGet('fecha')
        ];
        
        // Construir la consulta base
        $builder = $ventasModel->select('venta.*, personas.dni, personas.persona_nombre, personas.persona_apellido')
                             ->join('personas', 'personas.id = venta.id_persona');
        
        // Aplicar filtros si existen
        $filtrosAplicados = false;
        
        // Filtrar por ID de venta (búsqueda exacta)
        if (!empty($busqueda['id_venta'])) {
            $builder->where('venta.id_venta', $busqueda['id_venta']);
            $filtrosAplicados = true;
        }
        
        // Filtrar por DNI (búsqueda parcial)
        if (!empty($busqueda['dni'])) {
            $builder->like('personas.dni', $busqueda['dni']);
            $filtrosAplicados = true;
        }
        
        // Filtrar por nombre (búsqueda parcial)
        if (!empty($busqueda['nombre'])) {
            $builder->like('personas.persona_nombre', $busqueda['nombre']);
            $filtrosAplicados = true;
        }
        
        // Filtrar por apellido (búsqueda parcial)
        if (!empty($busqueda['apellido'])) {
            $builder->like('personas.persona_apellido', $busqueda['apellido']);
            $filtrosAplicados = true;
        }
        
        // Filtrar por fecha (búsqueda exacta)
        if (!empty($busqueda['fecha'])) {
            $builder->where("DATE(venta.fecha_venta) = '" . $busqueda['fecha'] . "'");
            $filtrosAplicados = true;
        }
        
        // Si no hay filtros, obtener todas las ventas
        if (!$filtrosAplicados) {
            $ventas = $builder->orderBy('venta.fecha_venta', 'DESC')->findAll();
        } else {
            // Ordenar y obtener resultados filtrados
            $ventas = $builder->orderBy('venta.fecha_venta', 'DESC')
                             ->findAll();
        }

        return view('practico/header_view')
        .view('contenido/nav_admin')
        .view('contenido/admin_ventas', [
            'ventas' => $ventas,
            'busqueda' => $busqueda
        ])
        .view('practico/footer_view');
    }

    public function detalle_venta($id){
        $ventaModel = new Ventas_Model();
        $detalleModel = new Detalle_Venta_Model();
        $juegosModel = new Videojuegos_Model();
        $personaModel = new Personas_Model();

        // Obtener información de la venta
        $venta = $ventaModel->select('venta.*, personas.persona_nombre, personas.persona_apellido, personas.dni, personas.persona_mail as email, personas.domicilio, personas.codigo_postal')
                          ->join('personas', 'personas.id = venta.id_persona')
                          ->find($id);

        if (!$venta) {
            return redirect()->to('/listar_ventas')->with('error', 'Venta no encontrada');
        }

        // Obtener detalles de la venta
        $detalles = $detalleModel->where('id_venta', $id)->findAll();
        $subtotal = 0;

        // Obtener nombres de juegos y calcular subtotal
        foreach ($detalles as &$juego) {
            $titulo = $juegosModel->find($juego['id_videojuego']); 
            $juego['titulo_videojuego'] = $titulo ? $titulo['titulo_videojuego'] : 'Sin título';
            $juego['subtotal'] = $juego['detalle_cantidad'] * $juego['detalle_precio'];
            $subtotal += $juego['subtotal'];
        }

        $data = [
            'venta' => $venta,
            'detalles' => $detalles,
            'subtotal' => $subtotal,
            'fecha' => date('d/m/Y H:i:s', strtotime($venta['fecha_venta']))
        ];

        return view('practico/header_view')
            .view('contenido/nav_admin')
            .view('contenido/admin_detalle_venta', $data)
            .view('practico/footer_view');    
    }

    public function gestionar_juegos(){
        $model = new Videojuegos_Model();
        $categoriasModel = new Categorias_Model();
        
        // Obtener parámetros de búsqueda
        $busqueda = [
            'id' => $this->request->getGet('id'),
            'titulo' => $this->request->getGet('titulo'),
            'desarrollador' => $this->request->getGet('desarrollador'),
            'distribuidor' => $this->request->getGet('distribuidor'),
            'categoria' => $this->request->getGet('categoria')
        ];
        
        // Construir la consulta base con join a categorías
        $builder = $model->select('videojuegos.*, categorias.categoria_descripcion, COALESCE(videojuegos.videojuego_stock, 0) as videojuego_stock')
                       ->join('categorias', 'categorias.id = videojuegos.id_categoria', 'left');
        
        // Aplicar filtros si existen
        $filtrosAplicados = false;
        
        // Filtrar por ID (búsqueda exacta)
        if (!empty($busqueda['id'])) {
            $builder->where('videojuegos.id_videojuego', $busqueda['id']);
            $filtrosAplicados = true;
        }
        
        // Filtrar por título (búsqueda parcial)
        if (!empty($busqueda['titulo'])) {
            $builder->like('videojuegos.titulo_videojuego', $busqueda['titulo']);
            $filtrosAplicados = true;
        }
        
        // Filtrar por desarrollador (búsqueda parcial)
        if (!empty($busqueda['desarrollador'])) {
            $builder->like('videojuegos.desarrollador_videojuego', $busqueda['desarrollador']);
            $filtrosAplicados = true;
        }
        
        // Filtrar por distribuidor (búsqueda parcial)
        if (!empty($busqueda['distribuidor'])) {
            $builder->like('videojuegos.distribuidor_videojuego', $busqueda['distribuidor']);
            $filtrosAplicados = true;
        }
        
        // Filtrar por categoría (selección exacta)
        if (!empty($busqueda['categoria'])) {
            $builder->where('categorias.id', $busqueda['categoria']);
            $filtrosAplicados = true;
        }
        
        // Obtener todos los juegos (filtrados o no)
        $juegos = $builder->orderBy('videojuegos.titulo_videojuego', 'ASC')
                         ->findAll();
        
        // Obtener todas las categorías para el select
        $categorias = $categoriasModel->findAll();

        return view('practico/header_view')
            .view('contenido/nav_admin')
            .view('contenido/admin_gestion', [
                'juegos' => $juegos,
                'categorias' => $categorias,
                'busqueda' => $busqueda
            ])
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
