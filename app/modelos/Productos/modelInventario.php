<?php

namespace App\modelos\Productos;

use Illuminate\Database\Eloquent\Model;

class modelInventario extends Model
{
    public $timestamps = false;

    protected $table = 'inventario';

    protected $fillable = [
        'cantidad', 'producto_id'
    ];
}
