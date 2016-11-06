<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolintegrantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rolintegrantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rol')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->bigInteger('telefono');
            $table->string('email');
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
        Schema::drop('rolintegrantes');
    }
}
