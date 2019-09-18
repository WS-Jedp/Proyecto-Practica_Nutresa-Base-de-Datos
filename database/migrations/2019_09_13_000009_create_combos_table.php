<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'combos';

    /**
     * Run the migrations.
     * @table combos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('nombre', 45)->nullable();
            $table->text('descripcion')->nullable();
            $table->integer('cantidad')->nullable();
            $table->integer('valor')->nullable();
            $table->integer('valor_final')->nullable();
            $table->integer('registros_combos_id');

            $table->index(["registros_combos_id"], 'fk_combos_registros_combos1_idx');


            $table->foreign('registros_combos_id', 'fk_combos_registros_combos1_idx')
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
