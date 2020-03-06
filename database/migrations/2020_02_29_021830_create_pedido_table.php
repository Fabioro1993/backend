<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->bigIncrements('id_pedido');
            $table->integer('numero_pedido');

            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id_users')->on('users');
            $table->unsignedBigInteger('id_restaurant');
            $table->foreign('id_restaurant')->references('id_restaurant')->on('restaurant');

            $table->unsignedBigInteger('id_menu');
            $table->foreign('id_menu')->references('id_menu')->on('menu');
            $table->string('comentario_pedido');

            $table->string('forma_pago_pedido');
            $table->double('monto_pedido', 8, 2);

            $table->dateTime('fecha_compra_pedido');
            
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
        Schema::dropIfExists('pedido');
    }
}
