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
            $table->integer('registro_facturas_id');
            $table->integer('registro_compra_id');

            $table->index(["registro_facturas_id"], 'fk_registro_facturas_has_registro_compra_registro_facturas1_idx');

            $table->index(["registro_compra_id"], 'fk_registro_facturas_has_registro_compra_registro_compra1_idx');


            $table->foreign('registro_facturas_id', 'fk_registro_facturas_has_registro_compra_registro_facturas1_idx')
                ->references('id')->on('registro_facturas')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('registro_compra_id', 'fk_registro_facturas_has_registro_compra_registro_compra1_idx')
                ->references('id')->on('registro_compra')
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
