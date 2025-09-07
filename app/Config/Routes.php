<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Rutas: LIBROS
$routes->get('/libros', 'LibroController::index');

$routes->get('/libros/buscar', 'LibroController::buscar'); //Búsqueda asíncrona
$routes->post('/public/api/buscarlibro', 'LibroController::buscarLibro');

$routes->get('/libros/crear', 'LibroController::crear'); //Renderiza el FORM
$routes->get('/libros/editar/(:num)', 'LibroController::editar/$1');
$routes->post('/libros/guardar', 'LibroController::guardar'); //<form method="POST">
$routes->post('/libros/actualizar', 'LibroController::actualizar'); 
$routes->get('/libros/borrar/(:num)', 'LibroController::borrar/$1');

//Rutas: AUTORES
$routes->get('/editoriales', 'EditorialController::index');
$routes->get('/editoriales/crear', 'EditorialController::crear');
$routes->get('/editoriales/editar', 'EditorialController::editar');

//Rutas: PERSONAS
$routes->get('/personas', 'PersonaController::index');
$routes->get('/personas/crear', 'PersonaController::crear');
$routes->get('/personas/editar/(:num)', 'PersonaController::editar/$1');
$routes->post('/personas/guardar', 'PersonaController::guardar');
$routes->post('/personas/actualizar', 'PersonaController::actualizar');
$routes->get('/personas/borrar/(:num)', 'PersonaController::borrar/$1');

// Recursos CRUD
$routes->get('recursos', 'RecursoController::index');
$routes->get('recursos/crear', 'RecursoController::crear');
$routes->post('recursos/guardar', 'RecursoController::guardar');
$routes->get('recursos/editar/(:num)', 'RecursoController::editar/$1');
$routes->post('recursos/actualizar/(:num)', 'RecursoController::actualizar/$1');
$routes->get('recursos/borrar/(:num)', 'RecursoController::borrar/$1');

// API subcategorías
$routes->get('api/subcategorias/(:num)', 'Api\SubcategoriaController::porCategoria/$1');

//API
$routes->get('/api/personas/buscardni/(:num)', 'PersonaController::searchByDNI/$1');
$routes->get('/api/ubigeo/provincias/(:num)', 'ProvinciaController::getProvinciasByDepartamento/$1');
$routes->get('/api/ubigeo/distritos/(:num)', 'DistritoController::getDistritosByProvincia/$1');



