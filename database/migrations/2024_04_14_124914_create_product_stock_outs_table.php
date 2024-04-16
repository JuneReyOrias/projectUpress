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
        Schema::create('product_stock_outs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prodcut_stock_colors_id')->nullable();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->foreignId('sizes_id')->nullable();
            $table->double('quantity',10,2);
            $table->enum('stocktype',['In', 'Out'])->default('Out');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_stock_outs');
    }
};
