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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('product_name',50);
            $table->longText('descritpion');
            $table->string('color',50);
            $table->string('size',50)->nullable();
            $table->double('unit_price',10,2);
            $table->string('stocks',50);
            $table->string('image',50);
            $table->string('status',50);
            $table->string('prod_code',50);



            $table->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
