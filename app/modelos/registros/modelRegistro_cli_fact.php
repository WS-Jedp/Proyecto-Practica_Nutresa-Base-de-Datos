<?php

namespace App\modelos\registros;

use Illuminate\Database\Eloquent\Model;

class modelRegistro_cli_fact extends Model
{
    public $timestamps = false;
    protected $table = 'registros_clientes_facturas';   
    protected $fillable = [
        'factura_compra_id', 'tbl_clientes'
    ];
}
