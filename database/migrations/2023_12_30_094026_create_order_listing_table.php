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
        Schema::create('order_listing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->foreignId('service_category_id')->nullable();
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
            $table->string('discount',50);
            $table->double('total',8,2);
            $table->enum('order_status', ['Pending', 'Confirmed','Cancelled','OrderSlip','Payment','Processing','Ready for Pick up', 'Completed',' Return Refunded']);
            $table->string('required_date',50);
            $table->string('cancel_message');
            $table->string('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_listing');
    }
};
