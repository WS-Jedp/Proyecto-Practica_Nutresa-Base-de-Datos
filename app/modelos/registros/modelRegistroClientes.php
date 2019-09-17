<?php

namespace App\modelos\registros;

use Illuminate\Database\Eloquent\Model;

class modelRegistroClientes extends Model
{
    public $timestamps = false;

    protected $table = 'registro_clientes';

    protected $fillable = [
        'usuario_id', 'cliente_id'
    ];
}
