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


//Login
Route::post('iniciarSesion', 'usuariosController\userController@loginUser');

Route::group(['middleware'=>'jwt.auth'], function(){

    Route::post('validacionToken', 'usuariosController\userController@validateToken');

    // ------- Categorias
    Route::post('crearCategoria','clientesControllers\categoriasController@crearCategoria');


    //Clientes
        //Crear Clientes
    Route::post('agregarCliente', 'clientesControllers\clientController@agregarCliente');

    //Productos
        //Agregar Productos
    Route::post('agregarProducto', 'productosControllers\productoController@agregarProducto');
    
        //Comprar productos
    Route::post('comprarProductos', 'productosControllers\productoController@comprarProducto');

});