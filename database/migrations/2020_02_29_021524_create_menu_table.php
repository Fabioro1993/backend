<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('id_menu');
            $table->string('nombre_menu');
            $table->string('descr_menu');
            $table->double('precio', 8, 2);
            $table->string('imag_menu');
            $table->unsignedBigInteger('id_restaurant');
            $table->foreign('id_restaurant')->references('id_restaurant')->on('restaurant');
            $table->unsignedBigInteger('id_tipo');
            $table->foreign('id_tipo')->references('id_tipo')->on('tipo');
            $table->unsignedBigInteger('id_nivel');
            $table->foreign('id_nivel')->references('id_nivel')->on('nivel');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
