<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrosFacturasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'registros_facturas';

    /**
     * Run the migrations.
     * @table registros_facturas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->integer('id');
            $table->increments('factura_compra_id');
            $table->integer('tbl_usuario_id');

            $table->index(["factura_compra_id"], 'fk_factura_compra_has_tbl_usuario_factura_compra1_idx');

            $table->index(["tbl_usuario_id"], 'fk_factura_compra_has_tbl_usuario_tbl_usuario1_idx');


            $table->foreign('factura_compra_id', 'fk_factura_compra_has_tbl_usuario_factura_compra1_idx')
                ->references('id')->on('factura_compra')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('tbl_usuario_id', 'fk_factura_compra_has_tbl_usuario_tbl_usuario1_idx')
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
