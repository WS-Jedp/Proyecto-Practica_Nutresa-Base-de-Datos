<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblUsuarioTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tbl_usuario';

    /**
     * Run the migrations.
     * @table tbl_usuario
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('nombre', 45)->nullable();
            $table->string('correo', 45)->nullable();
            $table->string('usuario', 45);
            $table->string('contraseña', 45)->nullable();

            $table->unique(["correo"], 'correo_UNIQUE');

            $table->unique(["usuario"], 'usuario_UNIQUE');
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
