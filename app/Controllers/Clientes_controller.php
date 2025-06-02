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
