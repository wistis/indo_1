<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('LangController',LangController::class);
    $router->resource('AuthorController',AuthorController::class);
    $router->resource('ComapnyController',ComapnyController::class);
    $router->resource('LocationController',LocationController::class);
    $router->resource('SalaryController',SalaryController::class);
    $router->resource('PageController',PageController::class);
    $router->resource('PostController',PostController::class);
    $router->resource('AdController',AdController::class);
    $router->resource('TranslatesController',TranslatesController::class);
});
