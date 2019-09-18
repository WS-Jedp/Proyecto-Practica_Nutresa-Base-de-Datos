<?php

namespace App\modelos\facturas;

use Illuminate\Database\Eloquent\Model;

class modelFactura_compra extends Model
{
    public $timestamps = false;
    protected $table = 'factura_compra';
    protected $fillable = [
        'producto', 'cantidad', 'precio', 'descuento', 'precio_final', 'fecha', 'registro_combos_id', 'tbl_productos_id'
    ];
}
