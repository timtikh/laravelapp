<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id');

            $table->foreign('user_id')
                ->on('users')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });

        Schema::create('order_products', function (Blueprint $blueprint){
            $blueprint->id();
            $blueprint->timestamps();
            $blueprint->foreignId('order_id');
            $blueprint->foreignId('product_id');
            $blueprint->integer('quantity');

            $blueprint->foreign('order_id')
                ->on('orders')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $blueprint->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
