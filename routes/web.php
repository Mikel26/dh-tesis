<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('clientes', 'ClienteController');

Route::post('/clientes/editar/{id}', 'ClienteController@update')->name('cliente_editar');

Route::resource('productos', 'ProductoController');

Route::resource('menu', 'MenuController');

Route::resource('pedidos', 'PedidoController');
Route::get('/pedidos/{id}', 'PedidoController@show')->name('ver_pedidos');;
Route::get('/printPedido/{id}', 'PedidoController@exportPDF')->name('pedidos.pdf');

Route::resource('galeria', 'GaleriaController');

Route::resource('reportes', 'ReporteController');

Route::get('reporteDH/{finicio}/{ffin}', 'ReporteController@exportPDF');

Route::resource('categorias', 'CategoriaController');



Route::post('cambio', 'ProductoController@cambiarEstado')->name('cambioEstado');
