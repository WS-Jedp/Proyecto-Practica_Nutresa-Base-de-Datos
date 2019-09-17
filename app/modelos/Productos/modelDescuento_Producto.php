<?php

namespace App\modelos\Productos;

use Illuminate\Database\Eloquent\Model;

class modelDescuento_Producto extends Model
{

    public $timestamps = false;

    protected $table = 'descuento_producto';

    protected $fillable = [
        'valor'
    ];
}
