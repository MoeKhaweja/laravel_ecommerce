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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id('cart_item_id');
            $table->unsignedBigInteger('cart_id');
            $table->foreign('cart_id')
                ->references('cart_id')->on('carts')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->integer('cart_item_quantity')->notNullable();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->references('product_id')->on('products')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
