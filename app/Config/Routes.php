<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->get('/noticias', 'Noticias::index');
$routes->get('/noticias/(:segment)', 'Noticias::show/$1');


service('auth')->routes($routes);
