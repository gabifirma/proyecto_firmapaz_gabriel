<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('comercializacion', 'Home::comercializacion');
$routes->get('quienes_somos', 'Home::quienes_somos');
$routes->get('terminos', 'Home::terminos');
$routes->get('galeria', 'Home::galeria');

$routes->get('login', 'Home::login');
$routes->post('buscar_usuario', 'Usuarios_controller::buscar_usuario');
$routes->get('user_admin', 'Usuarios_controller::admin');
$routes->get('user_cliente', 'Usuarios_controller::cliente');

$routes->get('mostrar_consultas', 'Consultas_controller::mostrar_consultas');
$routes->post('eliminar_consulta/(:num)', 'Consultas_controller::eliminar_consulta/$1');


$routes->get('contacto', 'Home::contacto');
$routes->post('consulta', 'Usuarios_controller::añadir_consulta');

$routes->get('registrarse', 'Home::registrarse');
$routes->post('registro_cliente', 'Clientes_controller::añadir_cliente');

$routes->get('logout', 'Usuarios_controller::cerrar_sesion');

