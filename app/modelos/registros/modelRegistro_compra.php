<?php

namespace App\modelos\registros;

use Illuminate\Database\Eloquent\Model;

class modelRegistro_compra extends Model
{
    public $timestamps = false;

    protected $table = 'registro_compra';

    protected $fillable = [
        'tbl_clientes_id','tbl_productos_id'
    ];
}
