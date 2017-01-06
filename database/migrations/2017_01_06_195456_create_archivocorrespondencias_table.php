<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivocorrespondenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivoscorrespondencias', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('archivo_id')->unsigned();
            $table->integer('correspondenciaenviada_id')->unsigned();

            $table->foreign('archivo_id')->references('id')->on('archivos')
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
        Schema::drop('archivoscorrespondencias');
    }
}
