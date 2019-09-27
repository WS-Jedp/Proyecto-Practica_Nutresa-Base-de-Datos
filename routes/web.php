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

Route::get('/', function () {
    return view('welcome');
});


//Login
Route::post('iniciarSesion', 'usuariosController\userController@loginUser');

Route::group(['middleware'=>'jwt.auth'], function(){

    Route::get('validacionToken', 'usuariosController\userController@validateToken');

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

        //Registrar Combo
    Route::post('registrarCombo', 'productosControllers\productoController@registrarCombo');

});

