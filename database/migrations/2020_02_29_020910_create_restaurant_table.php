<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant', function (Blueprint $table) {
            $table->bigIncrements('id_restaurant');
            $table->string('nombre_rest');
            $table->string('direccion_rest');
            $table->integer('telefono_rest');
            $table->string('social');
            $table->string('logo_rest');
            $table->unsignedBigInteger('id_dueno');
            $table->foreign('id_dueno')->references('id_users')->on('users');
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
        Schema::dropIfExists('restaurant');
    }
}
