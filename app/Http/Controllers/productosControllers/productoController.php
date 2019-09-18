<?php

namespace App\Http\Controllers\productosControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modelos\Productos\modelDescuento_Producto;
use App\modelos\Productos\modelInventario;
use App\modelos\Productos\modelProducto;
use App\modelos\Clientes\modelClient;
use App\modelos\Clientes\modelCategoriesClient;
use App\modelos\registros\modelRegistro_cli_fact;
use App\modelos\registros\modelRegistro_factura;
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
        $newRegistroCompra = new modelRegistro_cli_fact;
        $newRegistroFactura = new modelRegistro_factura;
        $newFactura_compra = new modelFactura_compra;
        $registroCombo = new modelRegistro_combos;
        $combo = new modelCombos;

        $producto = modelProducto::findOrFail($request->producto_id);
        $cliente = modelClient::findOrFail($request->cliente_id);
        $inventario = modelInventario::findOrfail($producto->id);
        $usuario = auth()->user();
        $dateTime = now();

        $descuento = modelClient::select('tbl_clientes.marca','categorias_clientes.categoria', 'descuento_producto.valor')
        ->join('categorias_clientes','categorias_clientes.id', '=', 'tbl_clientes.categorias_clientes_id')
        ->join('descuento_producto', 'descuento_producto.id', '=', 'categorias_clientes.descuento_producto_id')
        ->where('tbl_clientes.id', $cliente->id)
        ->get();

        $categoriaCliente = modelClient::select('tbl_clientes.*', 'categorias_clientes.*')
        ->join('categorias_clientes', 'categorias_clientes.id', '=', 'tbl_clientes.categorias_clientes_id')
        ->where('tbl_clientes.categorias_clientes_id', $cliente->id )
        ->first();

        
        //Descuentos
        $precioDescuento = $descuento[0]->valor * $producto->precio / 100;
        $precioFinal = ($producto->precio - $precioDescuento) * $request->cantidad;


        //Combo
        if($request->tipo_factura == 0){
                //Especificar Combo
            $combo->nombre = $request->nombreCombo;
            $combo->descripcion = $request->descripcionCombo;
            $combo->cantidad = $request->cantidad;
                $combo->precioNormal = $precioFinal;
            $combo->precioCombo = $request->precioCombo;

            $combo->save();

            //registrar Combo
            $registroCombo->tbl_productos_id = $producto->id;
            $registroCombo->combos_id = $combo->id;

            $registroCombo->save();

        }    

        //Factura Compra
        $newFactura_compra->producto = $producto->nombre;
        $newFactura_compra->cantidad = $request->cantidad;
        $newFactura_compra->precio = $producto->precio;
        $newFactura_compra->descuento = $descuento[0]->valor;
            //Descuento
        $newFactura_compra->precio_final = $precioFinal;
        $newFactura_compra->fecha = $dateTime;
            //Factura Combo
        if($request->tipo_factura == 0){
            $newFactura_compra->registro_combos_id = $registroCombo->id;
        } else{
            $newFactura_compra->registro_combos_id = null;
        }
        $newFactura_compra->tbl_productos_id = $producto->id;
        $newFactura_compra->save();

        //Registro Facturas - Clientes
        $newRegistroCompra->tbl_clientes_id = $cliente->id;
        $newRegistroCompra->factura_compra_id = $newFactura_compra->id;
        $newRegistroCompra->save(); 

        //Registro Facturas - Usuario
        $newRegistroFactura->factura_compra_id = $newFactura_compra->id;
        $newRegistroFactura->tbl_usuario_id = $usuario->id;
        $newRegistroFactura->save();

        //Inventario
        $inventario->cantidad = $inventario->cantidad - $request->cantidad;
        $inventario->save();


        //Factura Combo
        $facturaCombo = modelCombos::select('combos.*', 'registro_combos.*', 'tbl_productos.*')
        ->join('registro_combos', 'registro_combos.combos_id', '=', 'combos.id')
        ->join('tbl_productos', 'tbl_productos.id', '=', 'registro_combos.tbl_productos_id')
        ->where('combos.id', $combo->id)
        ->get();

        if($request->tipo_factura != 0){

            return response()->json([

                'mensaje' => 'La compra se ha realizado correctamente',
                'descripcion' => 'El cliente ' . $cliente->marca . ' ha comprado ' . $request->cantidad . ' producto(s) de ' . $producto->nombre, 
                'precio' => 'El precio del producto ' . $producto->nombre . ' es ' . $producto->precio . ', se le agrega un descuento del ' . $descuento[0]->valor . '% por ser cliente ' . $categoriaCliente->categoria,
                'registro de compra' => 'Se ha registrado la compra con el nuemero ' . $newRegistroCompra->id . ', en el dia ' . $dateTime,
                'precio total' => 'El valor total a pagar es ' . $precioFinal,
                'status' => '200'
                
            ]);    
           
        } else {
            
            return response()->json([
                'combo' => $combo,
                'Registro de combo' => $registroCombo,
                'Factura combo' => $facturaCombo
            ]);

        }

    } 

    
}
