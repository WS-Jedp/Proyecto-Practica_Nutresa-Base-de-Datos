<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroCompraTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'registro_compra';

    /**
     * Run the migrations.
     * @table registro_compra
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->integer('tbl_clientes_id');
            $table->integer('tbl_productos_id');

            $table->index(["tbl_productos_id"], 'fk_tbl_clientes_has_tbl_productos_tbl_productos1_idx');

            $table->index(["tbl_clientes_id"], 'fk_tbl_clientes_has_tbl_productos_tbl_clientes1_idx');


            $table->foreign('tbl_clientes_id', 'fk_tbl_clientes_has_tbl_productos_tbl_clientes1_idx')
                ->references('id')->on('tbl_clientes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('tbl_productos_id', 'fk_tbl_clientes_has_tbl_productos_tbl_productos1_idx')
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
