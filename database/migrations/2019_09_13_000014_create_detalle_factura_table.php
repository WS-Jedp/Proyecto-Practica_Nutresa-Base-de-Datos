<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleFacturaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'detalle_factura';

    /**
     * Run the migrations.
     * @table detalle_factura
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('registro_facturas_id');
            $table->integer('productos_id');
            $table->string('cantidad', 45)->nullable();
            $table->integer('valor_final')->nullable();

            $table->index(["productos_id"], 'fk_registro_facturas_has_tbl_productos_tbl_productos1_idx');

            $table->index(["registro_facturas_id"], 'fk_registro_facturas_has_tbl_productos_registro_facturas1_idx');


            $table->foreign('registro_facturas_id', 'fk_registro_facturas_has_tbl_productos_registro_facturas1_idx')
                ->references('id')->on('registro_facturas')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('productos_id', 'fk_registro_facturas_has_tbl_productos_tbl_productos1_idx')
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
