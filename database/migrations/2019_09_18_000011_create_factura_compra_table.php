<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaCompraTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'factura_compra';

    /**
     * Run the migrations.
     * @table factura_compra
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('producto', 45)->nullable();
            $table->string('cantidad', 45)->nullable();
            $table->integer('precio')->nullable();
            $table->integer('descuento')->nullable();
            $table->integer('precio_final')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('registro_combos_id')->nullable();
            $table->integer('tbl_productos_id');

            $table->index(["registro_combos_id"], 'fk_factura_compra_registro_combos1_idx');

            $table->index(["tbl_productos_id"], 'fk_factura_compra_tbl_productos1_idx');


            $table->foreign('registro_combos_id', 'fk_factura_compra_registro_combos1_idx')
                ->references('id')->on('registro_combos')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('tbl_productos_id', 'fk_factura_compra_tbl_productos1_idx')
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
