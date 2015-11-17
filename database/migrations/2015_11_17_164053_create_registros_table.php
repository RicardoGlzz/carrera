<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('nombre', 50)->nullable();
            $table->string('apellidos',100)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('imagen', 200)->nullable();
            $table->boolean('grupo')->nullable();
            $table->boolean('tutti')->nullable();
            $table->integer('id_tutti')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('registros');
    }
}
