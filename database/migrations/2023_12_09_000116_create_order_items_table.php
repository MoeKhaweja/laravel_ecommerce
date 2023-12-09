<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('order_items_id');
            $table->unsignedBigInteger('product_id')->notNullable();
            $table->foreign('product_id')
                ->references('product_id')->on('products')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->unsignedBigInteger('order_id')->notNullable();
            $table->foreign('order_id')
                ->references('order_id')->on('orders')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->integer('order_items_quantity')->notNullable();
            $table->decimal('order_items_price', 10, 2)->notNullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
