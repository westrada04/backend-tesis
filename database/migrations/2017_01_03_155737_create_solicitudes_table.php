<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('asunto');
            $table->string('descripcion');
            $table->string('fecha');
            $table->integer('user_id')->unsigned();
            $table->integer('estadosolicitud_id')->unsigned();
            $table->integer('categoria_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('estadosolicitud_id')->references('id')->on('estadosolicitudes')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('categoria_id')->references('id')->on('categorias')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->softDeletes();
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
        Schema::drop('solicitudes');
    }
}
