<?php

namespace App\Http\Controllers\clientesControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modelos\Productos\modelDescuento_Producto;
use App\modelos\Clientes\modelCategoriesClient;
use App\modelos\Clientes\modelClient;
use App\modelos\registros\modelRegistroClientes;

class clientController extends Controller
{
       public function agregarCliente(Request $request){
            $registroCliente = new modelRegistroClientes;
            $nuevoCliente = new modelClient;
            
            $usuario = auth()->user()->id;

            $nuevoCliente->marca = $request->marca;
            $nuevoCliente->telefono = $request->telefono;
            $nuevoCliente->NIT = $request->NIT;
            $nuevoCliente->categorias_clientes_id = $request->categorias_clientes_id;

            $nuevoCliente->save();

            $registroCliente->usuario_id = $usuario;
            $registroCliente->clientes_id = $nuevoCliente->id;

            $registroCliente->save();

            $categoriaCliente = modelClient::select('tbl_clientes.*', 'categorias_clientes.*', 'descuento_producto.*')->join('categorias_clientes',"categorias_clientes.id","=","tbl_clientes.categorias_clientes_id")
            ->join("descuento_producto","descuento_producto.id","=","categorias_clientes.descuento_producto_id")
            ->where("tbl_clientes.id","=",$nuevoCliente->id)
            ->get();


            return response()->json([
                'Mensaje' => 'El cliente '. $nuevoCliente->marca .' ha sido se ha registrado correctamente',
                'status' => 200,
                'Categoria' => $categoriaCliente
            ]);
       }
}
