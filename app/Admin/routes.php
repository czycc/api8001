<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->get('order', 'OrderController@index');
    $router->get('index', 'IndexController@index');
    $router->resource('stock', 'StockController');
    $router->resource('stock2', 'Stock2Controller');
    $router->resource('news', 'NewsController');
});
