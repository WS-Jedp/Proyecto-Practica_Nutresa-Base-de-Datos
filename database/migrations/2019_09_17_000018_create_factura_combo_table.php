<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaComboTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'factura_combo';

    /**
     * Run the migrations.
     * @table factura_combo
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->integer('factura_compra_id');
            $table->integer('registros_combos_id');

            $table->index(["factura_compra_id"], 'fk_factura_compra_has_registros_combos_factura_compra1_idx');

            $table->index(["registros_combos_id"], 'fk_factura_compra_has_registros_combos_registros_combos1_idx');


            $table->foreign('factura_compra_id', 'fk_factura_compra_has_registros_combos_factura_compra1_idx')
                ->references('id')->on('factura_compra')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('registros_combos_id', 'fk_factura_compra_has_registros_combos_registros_combos1_idx')
                ->references('id')->on('registros_combos')
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
