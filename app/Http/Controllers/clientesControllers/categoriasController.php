<?php

namespace App\Http\Controllers\clientesControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modelos\Productos\modelDescuento_Producto;
use App\modelos\Clientes\modelCategoriesClient;
use App\modelos\Clientes\modelClient;

class categoriasController extends Controller
{
    //---- Categorias

      //Crear Categoria

   public function crearCategoria(Request $request){

    $descuento = modelDescuento_Producto::all();
    $categoria = new modelCategoriesClient;
    $categoria->categoria = $request->categoria;
    $categoria->descuento_producto_id = $request->descuento_producto_id;

    $categoria->save();

    $categoriaRegistrada = $categoria->categoria;

    

      return response()->json([
          'Mensaje' => 'Se ha registrado correctamente la categoria',
          'Su registro es:' => $categoriaRegistrada
      ]);
}
}
