<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblClientesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tbl_clientes';

    /**
     * Run the migrations.
     * @table tbl_clientes
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('marca', 45)->nullable();
            $table->string('telefono', 45)->nullable();
            $table->string('NIT', 45)->nullable();
            $table->integer('categorias_clientes_id');

            $table->index(["categorias_clientes_id"], 'fk_tbl_clientes_categorias_clientes1_idx');

            $table->unique(["NIT"], 'NIT_UNIQUE');


            $table->foreign('categorias_clientes_id', 'fk_tbl_clientes_categorias_clientes1_idx')
                ->references('id')->on('categorias_clientes')
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
