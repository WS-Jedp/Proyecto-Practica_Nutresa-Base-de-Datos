<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroClientesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'registro_clientes';

    /**
     * Run the migrations.
     * @table registro_clientes
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->integer('usuario_id');
            $table->integer('clientes_id');

            $table->index(["clientes_id"], 'fk_tbl_usuario_has_tbl_clientes_tbl_clientes1_idx');

            $table->index(["usuario_id"], 'fk_tbl_usuario_has_tbl_clientes_tbl_usuario1_idx');


            $table->foreign('usuario_id', 'fk_tbl_usuario_has_tbl_clientes_tbl_usuario1_idx')
                ->references('id')->on('tbl_usuario')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('clientes_id', 'fk_tbl_usuario_has_tbl_clientes_tbl_clientes1_idx')
                ->references('id')->on('tbl_clientes')
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
