<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorrespondenciasenviadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correspondenciasenviadas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('asunto');
            $table->string('descripcion');

            $table->integer('tipo_id')->unsigned();

            $table->foreign('tipo_id')->references('id')->on('tipos')
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
        Schema::drop('correspondenciasenviadas');
    }
}
