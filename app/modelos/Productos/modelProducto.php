<?php

namespace App\modelos\Productos;

use Illuminate\Database\Eloquent\Model;

class modelProducto extends Model
{
    public $timestamps = false;

    protected $table = 'tbl_productos';

    protected $fillable = [
        'nombre', 'precio', 'descuento'
    ];
}
