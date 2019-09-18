<?php

namespace App\modelos\combos;

use Illuminate\Database\Eloquent\Model;

class modelCombos extends Model
{
    public $timestamps = false;

    protected $table = 'combos';

    protected $fillable = [
        'nombre', 'descripcion', 'cantidad', 'precioNormal', 'precioCombo'
    ];
}
