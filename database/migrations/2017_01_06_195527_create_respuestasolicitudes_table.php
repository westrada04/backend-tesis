<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestasolicitudes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('solicitud_id')->unsigned();
            $table->integer('correspondenciaenviada_id')->unsigned();

            $table->foreign('solicitud_id')->references('id')->on('solicitudes')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('correspondenciaenviada_id')->references('id')->on('correspondenciasenviadas')
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
        Schema::drop('respuestasolicitudes');
    }
}
