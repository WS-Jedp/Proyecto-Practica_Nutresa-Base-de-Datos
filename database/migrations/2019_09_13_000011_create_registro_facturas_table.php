<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroFacturasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'registro_facturas';

    /**
     * Run the migrations.
     * @table registro_facturas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('nombre', 45)->nullable();
            $table->dateTime('fecha')->nullable();
            $table->integer('cliente_id');
            $table->integer('usuario_id');

            $table->index(["cliente_id"], 'fk_tbl_facturas_has_tbl_clientes_tbl_clientes1_idx');

            $table->index(["usuario_id"], 'fk_registro_facturas_tbl_usuario1_idx');

            $table->unique(["id"], 'id_UNIQUE');


            $table->foreign('cliente_id', 'fk_tbl_facturas_has_tbl_clientes_tbl_clientes1_idx')
                ->references('id')->on('tbl_clientes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('usuario_id', 'fk_registro_facturas_tbl_usuario1_idx')
                ->references('id')->on('tbl_usuario')
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
