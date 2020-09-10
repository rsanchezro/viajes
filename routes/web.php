<?php

Route::get('/', 'MainController@home')
    ->name('inicio');

/** Grupo de rutas de operadores */
Route::group(['middleware' => 'web'], function () {
    Route::match(['get', 'post'], 'lista-de-operadores', 'OperatorsController@index')
        ->name('operatorsList');
    Route::get('nuevo-operador', 'OperatorsController@create')
        ->name('operatorCreate');
    Route::post('grabar-operador', 'OperatorsController@store')
        ->name('operatorStore');
    Route::get('editar-operador/{operador}', 'OperatorsController@edit')
        ->name('operatorEdit');
    Route::post('grabar-cambios-operador', 'OperatorsController@update')
        ->name('operatorUpdate');
    Route::post('ver-operador', 'OperatorsController@show')
        ->name('operatorShow');
    Route::post('cambiar-estado-operador', 'OperatorsController@changeState')
        ->name('operatorChangeState');
});

/** Grupo de rutas de viajes */
Route::group(['middleware' => 'web'], function () {
    Route::match(['get', 'post'], 'lista-de-viajes', 'ToursController@index')
        ->name('toursList');
    Route::get('nuevo-viaje', 'ToursController@create')
        ->name('tourCreate');
    Route::post('grabar-viaje', 'ToursController@store')
        ->name('tourStore');
    Route::get('editar-viaje/{tour}', 'ToursController@edit')
        ->name('tourEdit');
    Route::post('actualizar-viaje', 'ToursController@update')
        ->name('tourUpdate');
    Route::post('desactivar-viaje', 'ToursController@destroy')
        ->name('tourDeactivate');
    Route::get('asociar-clientes/{tour}', 'ToursController@tourCustomers')
        ->name('tourCustomers');
    Route::post('actualizar-reservas', 'ToursController@setCustomers')
        ->name('setCustomers');
});

/** Grupo de rutas de clientes */
Route::group(['middleware' => 'web'], function () {
    Route::get('lista-de-clientes', 'CustomersController@index')
        ->name('customersList');
    Route::get('nuevo-cliente', 'CustomersController@create')
        ->name('customerCreate');
    Route::post('editar-cliente', 'CustomersController@store')
        ->name('customerStore');
    Route::get('editar-cliente', 'CustomersController@edit')
        ->name('customerEdit');
    Route::post('editar-cliente', 'CustomersController@update')
        ->name('customerUpdate');
    Route::post('desactivar-cliente', 'CustomersController@destroy')
        ->name('customerDeactivate');
});

