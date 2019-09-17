<?php

namespace App\modelos\Clientes;

use Illuminate\Database\Eloquent\Model;

class modelCategoriesClient extends Model
{

    public $timestamps = false;

   protected $table = 'categorias_clientes';

   protected $fillable = [
       'categoria','descuento_producto_id'
    ];
}
