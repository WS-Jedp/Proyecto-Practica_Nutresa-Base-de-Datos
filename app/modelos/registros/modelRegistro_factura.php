<?php

namespace App\modelos\registros;

use Illuminate\Database\Eloquent\Model;

class modelRegistro_factura extends Model
{
    public $timestamps = false;
    protected $table = 'registro_facturas';
    protected $fillable = [
        'nombre', 'fecha', 'cliente_id', 'usuario_id' 
    ];
}
