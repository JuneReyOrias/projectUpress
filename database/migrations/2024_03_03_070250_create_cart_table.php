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
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->foreignId('service_category_id')->nullable();
             $table->string('lastname',50);
             $table->string('firstname',50);
             $table->string('email',50)->unique();
             $table->string('college',50)->nullable();
             $table->string('department',50)->nullable();
             $table->string('contact_no',50);
             $table->string('image')->nullable();
             $table->string('item_name',50);
             $table->enum('type', ['product', 'services']);
             $table->string('services',50)->nullable();
             $table->string('type_services',50)->nullable();
             $table->string('color',50)->nullable();
             $table->string('sizeof',50)->nullable();
             $table->string('unit',50)->nullable();
             $table->double('quantity',10,2)->nullable();
             $table->double('unit_price',10,2);
             $table->double('total_amount',10,2);
           
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
