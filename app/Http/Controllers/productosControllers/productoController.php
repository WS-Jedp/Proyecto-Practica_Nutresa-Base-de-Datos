<?php

namespace App\Http\Controllers\productosControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modelos\Productos\modelDescuento_Producto;
use App\modelos\Productos\modelInventario;
use App\modelos\Productos\modelProducto;
use App\modelos\Clientes\modelClient;
use App\modelos\Clientes\modelCategoriesClient;
use App\modelos\registros\modelRegistro_factura;
use App\modelos\registros\modelRegistro_compra;
use App\modelos\facturas\modelFactura_compra;



class productoController extends Controller
{
    public function agregarProducto(Request $request){
        $newInventario = new modelInventario;
        $newProducto = new modelProducto;

        $idUsuario = auth()->user()->id;

       
        $newProducto->nombre = $request->nombre;
        $newProducto->precio = $request->precio;
        $newProducto->marca = $request->marca;
        $newProducto->registroUsuario_id = $idUsuario;
        $newProducto->save();

        $newInventario->cantidad = $request->cantidad;
        $newInventario->producto_id = $newProducto->id;
        $newInventario->save();


        return response()->json([
            'Mensaje' => 'El producto ' . $newProducto->nombre . ' se ha registrado correctamente.',
            'status' => 200
        ]);
        
    }

    public function comprarProducto(Request $request){
        $newRegistroCompra = new modelRegistro_compra;
        $newRegistroFactura = new modelRegistro_factura;
        $newFactura_compra = new modelFactura_compra;
        // $updateInventario = modelInventario::findOrFail();

        $producto = modelProducto::findOrFail($request->producto_id);
        $cliente = modelClient::findOrFail($request->cliente_id);
        $usuario = auth()->user();

        //Registro compra
        $newRegistroCompra->tbl_clientes_id = $cliente->id;
        $newRegistroCompra->tbl_productos_id = $producto->id; 

        //Registro Facturas
        $newRegistroFactura->nombre = $request->nombreFactura;
        $newRegistroFactura->fecha;

        return response()->json([
            'Producto' => $producto,
            'Cliente' => $cliente,
            'Usuario' => $usuario,
            'Registro Compra'=>$newRegistroCompra
        ]);
    }
}
