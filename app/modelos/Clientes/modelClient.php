<?php

namespace App\modelos\Clientes;

use Illuminate\Database\Eloquent\Model;

class modelClient extends Model
{

    public $timestamps = false;

    protected $table ='tbl_clientes';

    protected $fillable = [
        'marca', 'telefono', 'NIT', 'categorias_clientes_id'
    ];
}
