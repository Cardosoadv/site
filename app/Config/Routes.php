<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->get('/noticias', 'Noticias::index');
$routes->get('/noticias/(:segment)', 'Noticias::show/$1');

$routes->post('/contact', 'Home::receiveContact');


service('auth')->routes($routes);

$routes->group('admin', ['filter' => 'session'], function ($routes) {
    $routes->get('noticias', 'admin\Noticias::index');
    $routes->get('noticias/create', 'admin\Noticias::create');
    $routes->post('noticias/store', 'admin\Noticias::store');
    $routes->get('noticias/edit/(:segment)', 'admin\Noticias::edit/$1');
    $routes->post('noticias/update/(:segment)', 'admin\Noticias::update/$1');
    $routes->get('noticias/destroy/(:segment)', 'admin\Noticias::destroy/$1');
});
