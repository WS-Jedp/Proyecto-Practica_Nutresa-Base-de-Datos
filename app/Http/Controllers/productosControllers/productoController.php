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
use App\modelos\registros\modelRegistro_combos;
use App\modelos\facturas\modelFactura_compra;
use App\modelos\combos\modelCombos;
    


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

    //---------------------- Comprar Producto -------------------------------

    public function comprarProducto(Request $request){
        $newRegistroCompra = new modelRegistro_compra;
        $newRegistroFactura = new modelRegistro_factura;
        $newFactura_compra = new modelFactura_compra;
        $registroCombo = new modelRegistro_combos;
        $combo = new modelCombos;

        $producto = modelProducto::findOrFail($request->producto_id);
        $cliente = modelClient::findOrFail($request->cliente_id);
        $inventario = modelInventario::findOrfail($producto->id);
        $usuario = auth()->user();
        $dateTime = [now()];

        $descuento = modelClient::select('tbl_clientes.marca','categorias_clientes.categoria', 'descuento_producto.valor')
        ->join('categorias_clientes','categorias_clientes.id', '=', 'tbl_clientes.categorias_clientes_id')
        ->join('descuento_producto', 'descuento_producto.id', '=', 'categorias_clientes.descuento_producto_id')
        ->where('tbl_clientes.id', $cliente->id)
        ->get();

        //Registro compra
        $newRegistroCompra->tbl_clientes_id = $cliente->id;
        $newRegistroCompra->tbl_productos_id = $producto->id; 

        //Registro Facturas
        $newRegistroFactura->nombre = $request->nombreFactura;
        $newRegistroFactura->fecha = $dateTime;
        $newRegistroFactura->cliente_id = $cliente->id;
        $newRegistroFactura->usuario_id = $usuario->id;

        //Factura Compra
        $newFactura_compra->nombre = $producto->nombre;
        $newFactura_compra->cantidad = $request->cantidad;
        $newFactura_compra->precio = $producto->precio;
        $newFactura_compra->descuento = $descuento[0]->valor;
            //Descuento
            $precioDescuento = $descuento[0]->valor * $producto->precio / 100;
            $precioFinal = ($producto->precio - $precioDescuento) * $request->cantidad;
        $newFactura_compra->precio_final = $precioFinal;
        $newFactura_compra->registro_facturas_id = $newRegistroFactura->id;
        $newFactura_compra->registro_compra_id = $newRegistroCompra->id;

        //Inventario
        $inventario->cantidad = $inventario->cantidad - $request->cantidad;

        //Combo
            //registrar Combo
        $registroCombo->nombre = $request->nomrbeCombo;
        $registroCombo->descripcion = $request->descripcionCombo;
        $registroCombo->tbl_productos_id = $producto->id;
        $registroCombo->factura_compra_id = $newFactura_compra->id;

            //Especificar Combo
        $combo->nombre = $request->nomrbeCombo;
        $combo->descripcion = $request->descripcionCombo;
        $combo->cantidad = $request->cantidad;
        $combo->valor = $producto->precio;
        $combo->valor_final = $request->valorFinalCombo;
        $combo->registros_combos_id = $registroCombo->id;

        return response()->json([
            'Producto' => $producto,
            'Cliente' => $cliente,
            'Usuario' => $usuario,
            'Inventario' => $inventario,
            'Factura'=> $newFactura_compra,
            'Registro Compra'=>$newRegistroCompra,  
            'Descuento' => $descuento[0]->valor
        ]);
    }

    // -------- registrar Combo
    public function registrarCombo(Request $request){
        $newRegistroCompra = new modelRegistro_compra;
        $newRegistroFactura = new modelRegistro_factura;
        $newFactura_compra = new modelFactura_compra;
        $registroCombo = new modelRegistro_combos;
        $combo = new modelCombos;
        

        $producto = modelProducto::findOrFail($request->producto_id);
        $cliente = modelClient::findOrFail($request->cliente_id);
        $inventario = modelInventario::findOrfail($producto->id);
        $usuario = auth()->user();
        $dateTime = [now()];

        $descuento = modelClient::select('tbl_clientes.*', 'categorias_clientes.*', 'descuento_producto.*')
        ->join('categorias_clientes', 'categorias_clientes.id', '=', 'tbl_clientes.categorias_clientes_id')
        ->join('descuento_producto', 'descuento_producto.id', '=', 'categorias_clientes.descuento_producto_id')
        ->where('tbl_clientes.id', $cliente->id)
        ->get();

            

        return response()->json([
            'Descuento'=> $descuento[0]
        ]);

    }
}
