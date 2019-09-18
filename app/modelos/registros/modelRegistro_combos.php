<?php

namespace App\modelos\registros;

use Illuminate\Database\Eloquent\Model;

class modelRegistro_combos extends Model
{
    public $timestamps = false;

    protected $table = 'registro_combos';

    protected $fillable = [
        'nombre', 'descripcion', 'registro_combos_id', 'tbl_productos_id', 'factura_compra_id'
    ];
}
