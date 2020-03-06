<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//Niveles
$router->get('nivel', 'NivelController@index');
$router->post('nivel/store', 'NivelController@store');
$router->get('nivel/{id_nivel}/show', 'NivelController@show');
$router->get('nivel/{id_nivel}/update', 'NivelController@update');
$router->get('nivel/{id_nivel}/delete', 'NivelController@destroy');

//Tipo
$router->get('tipo', 'TipoController@index');
$router->post('tipo/store', 'TipoController@store');
$router->get('tipo/{id_tipo}/show', 'TipoController@show');
$router->get('tipo/{id_tipo}/update', 'TipoController@update');
$router->get('tipo/{id_tipo}/delete', 'TipoController@destroy');

//Usuario
$router->get('usuario', 'UsersController@index');
$router->post('usuario/store', 'UsersController@store');
$router->get('usuario/{id_users}/show', 'UsersController@show');
$router->get('usuario/{id_users}/update', 'UsersController@update');
$router->get('usuario/{id_users}/delete', 'UsersController@destroy');

//Restaurante
$router->get('restaurante', 'RestaurantController@index');
$router->post('restaurante/store', 'RestaurantController@store');
$router->get('restaurante/{id_restaurant}/show', 'RestaurantController@show');
$router->get('restaurante/{id_restaurant}/update', 'RestaurantController@update');
$router->get('restaurante/{id_restaurant}/delete', 'RestaurantController@destroy');

//Menu
$router->get('menu', 'MenuController@index');
$router->post('menu/store', 'MenuController@store');
$router->get('menu/{id_menu}/show', 'MenuController@show');
$router->get('menu/{id_menu}/update', 'MenuController@update');
$router->get('menu/{id_menu}/delete', 'MenuController@destroy');

//Pedido
$router->get('pedido', 'PedidoController@index');
$router->post('pedido/store', 'PedidoController@store');
$router->get('pedido/{id_pedido}/show', 'PedidoController@show');
$router->get('pedido/{id_pedido}/update', 'PedidoController@update');
$router->get('pedido/{id_pedido}/delete', 'PedidoController@destroy');