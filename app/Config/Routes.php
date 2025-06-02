<?php

use App\Controllers\ProdukController;
use App\Controllers\ProductCategory;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->group('produk', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});
$routes->group('produk-kategori', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'ProductCategory::index');
    $routes->post('', 'ProductCategory::create');
    $routes->post('edit/(:any)', 'ProductCategory::edit/$1');
    $routes->get('delete/(:any)', 'ProductCategory::delete/$1');
});


$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});
$routes->get('/faq', 'Home::faq', ['filter' => 'auth']);
$routes->get('/contact', 'Home::contact', ['filter' => 'auth']);


