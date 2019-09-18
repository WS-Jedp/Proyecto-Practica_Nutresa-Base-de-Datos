<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroClientesFacturasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'registro_clientes_facturas';

    /**
     * Run the migrations.
     * @table registro_clientes_facturas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->integer('factura_compra_id');
            $table->integer('tbl_clientes_id');

            $table->index(["tbl_clientes_id"], 'fk_factura_compra_has_tbl_clientes_tbl_clientes1_idx');

            $table->index(["factura_compra_id"], 'fk_factura_compra_has_tbl_clientes_factura_compra1_idx');


            $table->foreign('factura_compra_id', 'fk_factura_compra_has_tbl_clientes_factura_compra1_idx')
                ->references('id')->on('factura_compra')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('tbl_clientes_id', 'fk_factura_compra_has_tbl_clientes_tbl_clientes1_idx')
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
