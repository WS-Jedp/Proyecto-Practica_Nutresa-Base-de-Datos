<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroComprasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'registro_compras';

    /**
     * Run the migrations.
     * @table registro_compras
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('clientes_id');
            $table->integer('productos_id');

            $table->index(["productos_id"], 'fk_tbl_clientes_has_tbl_productos_tbl_productos1_idx');

            $table->index(["clientes_id"], 'fk_tbl_clientes_has_tbl_productos_tbl_clientes1_idx');


            $table->foreign('clientes_id', 'fk_tbl_clientes_has_tbl_productos_tbl_clientes1_idx')
                ->references('id')->on('tbl_clientes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('productos_id', 'fk_tbl_clientes_has_tbl_productos_tbl_productos1_idx')
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
