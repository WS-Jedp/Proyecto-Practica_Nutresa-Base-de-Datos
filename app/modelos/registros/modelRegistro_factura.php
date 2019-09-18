<?php

namespace App\modelos\registros;

use Illuminate\Database\Eloquent\Model;

class modelRegistro_factura extends Model
{
    public $timestamps = false;
    protected $table = 'registro_facturas';
    protected $fillable = [
        'factura_compra_id', 'tbl_usuario_id' 
    ];
}
