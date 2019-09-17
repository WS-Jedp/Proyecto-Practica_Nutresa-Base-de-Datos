<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasClientesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'categorias_clientes';

    /**
     * Run the migrations.
     * @table categorias_clientes
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('categoria', 45)->nullable();
            $table->integer('descuento_producto_id');

            $table->index(["descuento_producto_id"], 'fk_categorias_clientes_descuento_producto1_idx');


            $table->foreign('descuento_producto_id', 'fk_categorias_clientes_descuento_producto1_idx')
                ->references('id')->on('descuento_producto')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
