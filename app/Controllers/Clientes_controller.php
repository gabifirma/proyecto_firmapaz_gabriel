<?php
namespace App\Controllers;

use App\Models\Personas_model;

class Clientes_controller extends BaseController
{
    public function registrar_usuario()
    {
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();

        $validation->setRules(
            [
                'nombre' => 'required|max_length[150]',
                'apellido' => 'required|max_length[150]',
                'correo' => 'required|valid_email|is_unique[personas.correo]',
                'pais' => 'required|max_length[100]',
                'contraseña' => 'required|max_length[20]|min_length[8]',
                'reContraseña' => 'required|matches[contraseña]',
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
                    'valid_email' => 'La dirección de correo debe ser válida'
                ],
                'pais' => [
                    'required' => 'El pais es obligatorio',                   
                    'max_length' => 'El pais debe tener como máximo 100 carácteres',
                ],
                'contraseña' => [
                    'required' => 'La contraseña es requerida',
                    'min_length' => 'La contraseña debe tener como mínimo 10 carácteres',
                    'max_length' => 'La contraseña debe tener como máximo 200 carácteres',
                ],
                'reContraseña' => [
                    'required' => 'Repetir contraseña es requerida',
                    'min_length' => 'Repetir contraseña debe tener como mínimo 10 carácteres',
                    'max_length' => 'Repetir contraseña debe tener como máximo 200 carácteres',
                ],
            ]
        );

        if ($validation->withRequest($request)->run()) {
            $data = [
                'nombre' => htmlspecialchars($request->getPost('nombre')),
                'apellido' => htmlspecialchars($request->getPost('apellido')),
                'correo' => htmlspecialchars($request->getPost('correo')),
                'pais' => htmlspecialchars($request->getPost('pais')),
                'contraseña' => password_hash($request->getPost('contraseña'), PASSWORD_DEFAULT),
            ];

            $persona = new Personas_model();
            $persona->insert($data);

            return redirect()->to('registrarse')->with('mensaje', '¡Registro exitoso!');
        } else {
            $data['titulo'] = 'Registro';
            $data['validation'] = $validation->getErrors();
            return view('practico/header_view').view('contenido/nav_visitante').view('contenido/registrarse', ['validation' => $validation]).view('practico/footer_view');
        }
    }
}
