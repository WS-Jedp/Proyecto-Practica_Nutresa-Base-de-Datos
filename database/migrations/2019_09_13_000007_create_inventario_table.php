<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarioTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'inventario';

    /**
     * Run the migrations.
     * @table inventario
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->integer('cantidad')->nullable();
            $table->integer('producto_id');

            $table->index(["producto_id"], 'fk_inventario_tbl_productos_idx');


            $table->foreign('producto_id', 'fk_inventario_tbl_productos_idx')
                ->references('id')->on('tbl_productos')
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
