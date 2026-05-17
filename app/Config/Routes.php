<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// API Pública
$routes->group('api', function ($routes) {
    $routes->get('areas', 'ApiController::areas');
    $routes->get('noticias', 'ApiController::noticias');
    $routes->get('noticias/(:segment)', 'ApiController::noticiaBySlug/$1');
    $routes->post('contact', 'ApiController::submitContact');
});

// Sitemap (Mantido dinâmico para SEO)
$routes->get('sitemap.xml', 'Sitemap::index');
$routes->get('sitemap/generate', 'Sitemap::generate');

// Autenticação (Shield)
service('auth')->routes($routes);

// SPA Fallback Híbrido (Metadados no Head para SEO)
$routes->get('/', 'Home::index');
$routes->get('noticias', 'Home::index');
$routes->get('noticias/(:segment)', 'Home::index');
$routes->get('pagina/(:segment)', 'Home::index');

// Área Administrativa (Inalterada no modelo atual)
$routes->group('admin', ['filter' => 'session'], function ($routes) {
    // Dashboard (Landing Page)
    $routes->get('/', 'admin\Dashboard::index', ['as' => 'admin_dashboard']);

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
