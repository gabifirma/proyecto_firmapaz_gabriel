<?php
namespace App\Controllers;

use App\Models\Consultas_model;
use App\Models\Personas_model;

class Usuarios_controller extends BaseController
{
    public function añadir_consulta(){
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();

        $validation->setRules(
            [
                'nombre' => 'required|max_length[150]',
                'apellido' => 'required|max_length[150]',
                'correo' => 'required|valid_email',
                'motivo' => 'required|max_length[100]',
                'consulta' => 'required|max_length[200]|min_length[10]',
            ],
            [   //Errores
                'nombre' => [
                    'required' => 'El nombre es requerido',
                ],
                'apellido' => [
                    'required' => 'El apellido es requerido',
                ],
                'correo' => [
                    'required' => 'El correo electrónico es obligatorio',
                    'valid_mail' => 'La dirección de correo debe ser válida'
                ],
                'motivo' => [
                    'required' => 'El motivo es obligatorio',                   
                    'max_length' => 'El motivo de la consulta debe tener como máximo 100 carácteres',
                ],
                'consulta' => [
                    'required' => 'La consulta es requerida',
                    'min_length' => 'La consulta debe tener como mínimo 10 carácteres',
                    'max_length' => 'La consulta debe tener como máximo 200 carácteres',
                ],
            ]
        );

        if ( $validation->withRequest($request)->run() ) {
            $data = [
                'nombre_mensaje' => $request->getPost('nombre'),
                'apellido_mensaje' => $request->getPost('apellido'),
                'correo_mensaje' => $request->getPost('correo'),
                'motivo_mensaje' => $request->getPost('motivo'),
                'mensaje_mensaje' => $request->getPost('consulta'),
            ];

            $consulta = new Consultas_model();
            $consulta->insert($data);

            if (session('login')) {
                return redirect()->route('contacto_cliente')->with('mensaje_consulta', 'Su consulta se envió exitosamente!');
            } else {
                return redirect()->route('contacto')->with('mensaje_consulta', 'Su consulta se envió exitosamente!');
            }

        }else{
            $data['titulo'] = 'Contacto';
            $data['validation'] = $validation->getErrors();

            if(session('login')){
                return view('practico/header_view')
                .view('contenido/nav_cliente')
                .view('contenido/contacto', ['validation' => $validation])
                .view('practico/footer_view');
            }else{
                return view('practico/header_view')
                .view('contenido/nav_visitante')
                .view('contenido/contacto', ['validation' => $validation])
                .view('practico/footer_view');
            }
            
        }
    }

    public function buscar_usuario(){
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();
        $session = session();

        $validation->setRules(
            [
                'correo' => 'required|valid_email',
                'pass' => 'required|min_length[8]',
            ],
            [   //Errores
                'correo' => [
                    'required' => 'El correo electrónico es obligatorio',
                    'valid_email' => 'La dirección de correo no está registrada',
                ],
                'pass' => [
                    'required' => 'La contraseña es obligatoria',
                    'min_length' => 'La contraseña es incorrecta, debe tener mínimo 8 carácteres',
                ],
            ]
        );

        if ( !$validation->withRequest($request)->run() ) {
            $data['titulo'] = 'Login';
            $data['validation'] = $validation->getErrors();
            
            return view('practico/header_view').view('contenido/nav_visitante').view('contenido/login', ['validation' => $validation]).view('practico/footer_view');
        }

        $mail = $request->getPost('correo');
        $pass = $request->getPost('pass');

        $user_Model = new Personas_model();

        $user = $user_Model->where('persona_mail', $mail)->where('persona_estado', 1)->first();

        if($user && password_verify($pass, $user['persona_password'])){
            $data = [
                'id' => $user['id'],
                'nombre' => $user['persona_nombre'],
                'apellido' => $user['persona_apellido'],
                'perfil' => $user['id_perfil'],
                'login' => TRUE,
            ];
            $session->set($data);
            switch($user['id_perfil']){
                case '1': return redirect()->route('user_admin');
                break;
                case '2': return redirect()->route('user_cliente');
                break;
            }
        }else{
            return redirect()->route('login')->with('mensaje_login', 'Usuario y/o contraseña incorrecto');
        }
    }

    public function cerrar_sesion(){
    
        $session = session();
        $session->destroy();
        return redirect()->route('login');
    
    }

    public function admin(){
        $data['titulo'] = 'Index';
        return view('practico/header_view').view('contenido/nav_admin').view('Backend/contenido_admin').view('practico/footer_view');
    }

    public function cliente(){

        $data['titulo'] = 'Index';
        return view('practico/header_view').view('contenido/nav_cliente').view('Backend/contenido_cliente').view('practico/footer_view');
    
    }

    public function ver_perfil()
    {
        $usuario_id = session()->get('id'); // Usar siempre 'id' como clave de sesión
        $modelo = new \App\Models\Personas_Model();

        $datos['usuario'] = $modelo->find($usuario_id);

        return view('practico/header_view')
            . view('contenido/perfil_view_admin', $datos)
            . view('practico/footer_view');
    }

    public function actualizar_perfil()
    {
        helper(['form']);

        $rules = [
            'nombre'    => 'required|min_length[3]',
            'apellido'  => 'required|min_length[3]',
            'correo'    => 'required|valid_email',
            'pais'      => 'required|min_length[2]',
        ];

        if ($this->request->getPost('password')) {
            $rules['password'] = 'required|min_length[6]';
            $rules['password_confirm'] = 'matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $model = new \App\Models\Personas_Model();

        $data = [
            'persona_nombre'   => $this->request->getPost('nombre'),
            'persona_apellido' => $this->request->getPost('apellido'),
            'persona_mail'     => $this->request->getPost('correo'),
            'persona_pais'     => $this->request->getPost('pais'),
        ];

        if ($this->request->getPost('password')) {
            $data['persona_password'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );
        }

        $model->update(session()->get('id'), $data);

        return redirect()->back()->with('mensaje', 'Perfil actualizado correctamente');
    }

    public function ver_perfil_cliente()
    {
        $usuario_id = session()->get('id');
        $modelo = new \App\Models\Personas_Model();
        $datos['usuario'] = $modelo->find($usuario_id);
        return view('practico/header_view')
            . view('contenido/perfil_view_cliente', $datos)
            . view('practico/footer_view');
    }

    public function actualizar_perfil_cliente()
    {
        helper(['form']);
        $rules = [
            'nombre'    => 'required|min_length[3]',
            'apellido'  => 'required|min_length[3]',
            'correo'    => 'required|valid_email',
            'pais'      => 'required|min_length[2]',
        ];
        if ($this->request->getPost('password')) {
            $rules['password'] = 'required|min_length[6]';
            $rules['password_confirm'] = 'matches[password]';
        }
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }
        $model = new \App\Models\Personas_Model();
        $data = [
            'persona_nombre'   => $this->request->getPost('nombre'),
            'persona_apellido' => $this->request->getPost('apellido'),
            'persona_mail'     => $this->request->getPost('correo'),
            'persona_pais'     => $this->request->getPost('pais'),
        ];
        if ($this->request->getPost('password')) {
            $data['persona_password'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );
        }
        $model->update(session()->get('id'), $data);
        return redirect()->back()->with('mensaje', 'Perfil actualizado correctamente');
    }
}
