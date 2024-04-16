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
        Schema::create('track_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->foreignId('service_category_id')->nullable();
            $table->foreignId('order_listing_id')->nullable();
            $table->string('customer_name');
            $table->string('college');
            $table->string('department');
            $table->enum('order_status', ['Pending', 'Confirmed', 'Cancelled', 'OrderSlip', 'Payment', 'Processing', 'Ready for Pick up', 'Completed'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_orders');
    }
};
