<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('pagina/(:segment)', 'Pagina::index/$1');

$routes->get('/noticias', 'Noticias::index');
$routes->get('/noticias/(:segment)', 'Noticias::show/$1');

$routes->post('/contact', 'Home::receiveContact');

//Sitemap
$routes->get('sitemap.xml', 'Sitemap::index');
$routes->get('sitemap/generate', 'Sitemap::generate');

service('auth')->routes($routes);

$routes->group('admin', ['filter' => 'session'], function ($routes) {
    // Dashboard (Landing Page)
    $routes->get('/', 'admin\Dashboard::index');

    // Noticias
    $routes->get('noticias', 'admin\Noticias::index');
    $routes->get('noticias/create', 'admin\Noticias::create');
    $routes->post('noticias/store', 'admin\Noticias::store');
    $routes->get('noticias/edit/(:segment)', 'admin\Noticias::edit/$1');
    $routes->post('noticias/update/(:segment)', 'admin\Noticias::update/$1');
    $routes->get('noticias/destroy/(:segment)', 'admin\Noticias::destroy/$1');

    // Contatos
    $routes->get('contatos', 'admin\Contatos::index');
    $routes->get('contatos/show/(:num)', 'admin\Contatos::show/$1');
    $routes->post('contatos/updateStatus/(:num)', 'admin\Contatos::updateStatus/$1');
    $routes->get('contatos/destroy/(:num)', 'admin\Contatos::destroy/$1');
});
