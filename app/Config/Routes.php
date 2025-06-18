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
$routes->get('contacto', 'Home::contacto');
$routes->post('consulta', 'Usuarios_controller::añadir_consulta');


$routes->get('comercializacion_cliente', 'Clientes_controller::comercializacion_cliente');
$routes->get('quienes_somos_cliente', 'Clientes_controller::quienes_somos_cliente');
$routes->get('terminos_cliente', 'Clientes_controller::terminos_cliente');
$routes->get('galeria', 'Home::galeria');
$routes->get('contacto_cliente', 'Clientes_controller::contacto_cliente');


$routes->get('login', 'Home::login');
$routes->post('buscar_usuario', 'Usuarios_controller::buscar_usuario');
$routes->get('user_admin', 'Usuarios_controller::admin');
$routes->get('user_cliente', 'Usuarios_controller::cliente');
$routes->get('logout', 'Usuarios_controller::cerrar_sesion');


$routes->get('mostrar_consultas', 'Admin_controller::mostrar_consultas');
$routes->post('eliminar_consulta/(:num)', 'Admin_controller::eliminar_consulta/$1');
$routes->get('listar_usuarios', 'Admin_controller::listar_usuarios');
$routes->post('eliminar_usuario/(:num)', 'Admin_controller::eliminar_usuario/$1');
$routes->get('listar_videojuegos', 'Admin_controller::listar_videojuegos');
$routes->get('listar_ventas', 'Admin_controller::listar_ventas');
$routes->get('detalle_venta/(:num)', 'Admin_controller::detalle_venta/$1');


$routes->get('registrarse', 'Home::registrarse');
$routes->post('registro_cliente', 'Clientes_controller::registrar_usuario');


$routes->get('agregar_juego', 'Videojuegos_controller::form_agregar_juego');
$routes->post('insertar_juego', 'Videojuegos_controller::registrar_juego');
$routes->get('gestionar_juegos', 'Admin_controller::gestionar_juegos');
$routes->get('editar_videojuego/(:num)', 'Videojuegos_controller::form_editar_videojuego/$1');
$routes->post('actualizar_videojuego/(:num)', 'Videojuegos_controller::actualizar_videojuego/$1');
$routes->post('eliminar_videojuego/(:num)', 'Videojuegos_controller::eliminar_videojuego/$1');
$routes->post('cambiar_estado_videojuego/(:num)', 'Videojuegos_controller::cambiar_estado_videojuego/$1');
$routes->get('catalogo_cliente', 'Videojuegos_controller::catalogo_cliente');
$routes->get('ver_juego/(:num)', 'Videojuegos_controller::ver_juego/$1');


$routes->get('ver_carrito', 'Carrito_controller::ver_carrito');
$routes->post('add_cart', 'Carrito_controller::agregar_carrito');
$routes->get('eliminar_item/(:any)', 'Carrito_controller::borrar/$1');
$routes->get('vaciar_carrito/(:any)', 'Carrito_controller::vaciar_carrito');
$routes->get('ventas', 'Carrito_controller::guardar_venta');
$routes->post('actualizar_cantidad', 'Carrito_controller::actualizar_cantidad');


$routes->get('perfil_admin', 'Usuarios_controller::ver_perfil');
$routes->post('actualizar_perfil', 'Usuarios_controller::actualizar_perfil');
$routes->get('perfil_cliente', 'Usuarios_controller::ver_perfil_cliente');
$routes->post('actualizar_perfil_cliente', 'Usuarios_controller::actualizar_perfil_cliente');
$routes->post('marcar_leido/(:num)', 'Admin_controller::marcar_leido/$1');
$routes->post('marcar_no_leido/(:num)', 'Admin_controller::marcar_no_leido/$1');
$routes->get('completar_datos_cliente', 'Carrito_controller::completar_datos_cliente');
$routes->post('guardar_datos_cliente', 'Carrito_controller::guardar_datos_cliente');
$routes->get('formulario_pago', 'Carrito_controller::formulario_pago');
$routes->post('guardar_pago', 'Carrito_controller::guardar_pago');
$routes->get('mis_compras', 'Carrito_controller::mis_compras');
$routes->get('ver_factura/(:num)', 'Carrito_controller::ver_factura/$1');