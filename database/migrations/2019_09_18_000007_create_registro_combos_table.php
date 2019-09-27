<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroCombosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'registro_combos';

    /**
     * Run the migrations.
     * @table registro_combos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->integer('tbl_productos_id');
            $table->integer('combos_id');
            $table->integer('cantidad')->nullable();

            $table->index(["combos_id"], 'fk_tbl_productos_has_combos_combos1_idx');

            $table->index(["tbl_productos_id"], 'fk_tbl_productos_has_combos_tbl_productos1_idx');


            $table->foreign('tbl_productos_id', 'fk_tbl_productos_has_combos_tbl_productos1_idx')
                ->references('id')->on('tbl_productos')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('combos_id', 'fk_tbl_productos_has_combos_combos1_idx')
                ->references('id')->on('combos')
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
