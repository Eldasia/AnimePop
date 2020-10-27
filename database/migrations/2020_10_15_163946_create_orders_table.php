<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->integer('status');
            $table->text('shipping_address');
            $table->text('billing_address');
            $table->timestamps();
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained('orders');
            $table->integer('product_id')->index();
            $table->integer('price');
            $table->integer('tax');
            $table->integer('quantity');
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
        Schema::dropIfExists('order_product');
    }
}
