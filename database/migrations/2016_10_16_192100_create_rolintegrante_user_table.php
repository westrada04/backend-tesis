<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolintegranteUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rolintegrante_user', function (Blueprint $table) {

            $table->integer('user_id')->unsigned();
            $table->integer('rolintegrante_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('rolintegrante_id')->references('id')->on('rolintegrantes')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id','rolintegrante_id']);
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
        Schema::drop('rolintegrante_user');
    }
}
