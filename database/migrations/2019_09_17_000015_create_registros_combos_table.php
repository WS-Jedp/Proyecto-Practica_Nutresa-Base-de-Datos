<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrosCombosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'registros_combos';

    /**
     * Run the migrations.
     * @table registros_combos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('nombre', 45)->nullable();
            $table->mediumText('descripcion')->nullable();
            $table->integer('registro_combos_id');
            $table->integer('tbl_productos_id');

            $table->index(["tbl_productos_id"], 'fk_registro_combos_has_tbl_productos_tbl_productos1_idx');

            $table->index(["registro_combos_id"], 'fk_registro_combos_has_tbl_productos_registro_combos1_idx');


            $table->foreign('registro_combos_id', 'fk_registro_combos_has_tbl_productos_registro_combos1_idx')
                ->references('id')->on('combos')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('tbl_productos_id', 'fk_registro_combos_has_tbl_productos_tbl_productos1_idx')
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
