<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//Clientes
use App\modelos\Clientes\modelCategoriesClient;
use App\modelos\Clientes\modelClient;
//Combos
use App\modelos\combos\modelCombos;
//Facturas
use App\modelos\facturas\modelFactura_compra;
//Productos
use App\modelos\Productos\modelDescuento_Producto;
use App\modelos\Productos\modelInventario;
use App\modelos\Productos\modelProducto;
//registros
use App\modelos\registros\modelRegistro_cli_fact;
use App\modelos\registros\modelRegistro_combos;
use App\modelos\registros\modelRegistro_factura;
use App\modelos\registros\modelRegistroClientes;

class apiController extends Controller
{
    public function getClientes(){
        
        $allClients = modelClient::all();

        return response()->json([
            'mensaje'=> 'Se ha consumido la API correctamente',
            'status'=> '200',
            'Clientes' => $allClients

        ]);
    }

    public function getCliente($id){

        //productos
        $cliente = modelRegistroClientes::select('registro_clientes.*', 'tbl_clientes.*', 'categorias_clientes.*', 'descuento_producto.*')
        ->join('tbl_clientes', 'tbl_clientes.id', 'registro_clientes.clientes_id')
        ->join('categorias_clientes', 'categorias_clientes.id', 'tbl_clientes.categorias_clientes_id')
        ->join('descuento_producto', 'descuento_producto.id', 'categorias_clientes.descuento_producto_id')
        ->where('registro_clientes.clientes_id', $id)
        ->first();

        return response()->json([
            'mensaje'=>'Se ha obtenido correctamente al cliente',
            'status'=> 200,
            'Cliente'=>$cliente
        ]);
    }


    public function getProductos(){
        
        $productos = modelProducto::all();

        return response()->json([
            'mensaje'=>'Se han obtenido correctamente todos los productos',
            'status'=> 200,
            'Productos'=> $productos

        ]);
    }

    public function getProducto($id){
        
        $producto = modelProducto::select('tbl_productos.*', 'inventario.*')
        ->join('inventario', 'inventario.producto_id', 'tbl_productos.id')
        ->where('tbl_productos.id', $id)
        ->first();

        return response()->json([
            'mensaje'=>'Se ha obtenido correctamente el producto',
            'status'=>200,
            'Producto'=> $producto
        ]);
    }

    public function getFacturas(){
        $facturas = modelRegistro_factura::all();

        return response()->json([
            'mensaje'=>'Se han obtenido todas la facturas correctamente',
            'status'=>200,
            'Factura'=>$facturas
        ]);
    }

    public function getFactura($id){
        
        $factura = modelRegistro_factura::select('registros_facturas.*', 'factura_compra.*')
        ->join('factura_compra', 'factura_compra.id', 'registros_facturas.factura_compra_id')
        ->where('registros_facturas.factura_compra_id', $id)
        ->first();
    
        if($factura->registro_combos_id != null || $factura->registro_combos_id != ''){
            $facturaCombo = modelRegistro_factura::select('registros_facturas.*', 'factura_compra.*', 'registro_combos.*', 'combos.*')
            ->join('factura_compra', 'factura_compra.id', 'registros_facturas.factura_compra_id')
            ->join('registro_combos','registro_combos.id', 'factura_compra.registro_combos_id')
            ->join('combos', 'combos.id', 'registro_combos.combos_id')
            ->where('registros_facturas.factura_compra_id', $id)
            ->first();

            return response()->json([
                'mensaje'=>'Se ha obtenido la factura con combo correctamente',
                'status'=> 200,
                'Factura Combo'=>$facturaCombo
            ]);
        }else{

            $facturaOnly = modelRegistro_factura::select('registros_facturas.*', 'factura_compra.*')
            ->join('factura_compra', 'factura_compra.id', 'registros_facturas.factura_compra_id')
            ->where('registros_facturas.factura_compra_id', $id)
            ->first();
         
            return response()->json([
                'mensaje'=> 'Se ha obtenido correctamente la factura del producto',
                'status'=> 200,
                'factura'=> $facturaOnly
            ]);
        }
        }
        
}
