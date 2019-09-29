<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>'jwt.auth'], function(){

        //Todos los clientes
    Route::get('clientes', 'api\apiController@getClientes');

        //Toda la informacion de un cliente
    Route::get('clientes/{id?}  ', 'api\apiController@getCliente');    

    //--------- Productos
    Route::get('Productos', 'api\apiController@getProductos');
    Route::get('Compras', 'api\apiController@getCompra');

    //Producto Indiviudal
    Route::get('Productos/{id?}', 'api\apiController@getProducto');

    //--------- Facturas
    Route::get('Facturas', 'api\apiController@getFacturas');
    Route::get('Facturas/{id?}', 'api\apiController@getFactura');

    //-------- Categorias
    route::get('Categorias', 'api\apiController@getCategorias');
    route::get('Categoria/{id?}', 'api\apiController@getCategoria');
    route::get('Categorias/{id?}', 'api\apiController@clientsCategoria');
});


