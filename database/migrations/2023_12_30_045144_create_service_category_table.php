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
        Schema::create('service_category', function (Blueprint $table) {
            $table->id();
            $table->string('category',50);
            $table->longtext('description');
            $table->timestamps();
            $table->string('type_services',50);
            $table->string('size',100);
            $table->string('unit',50);
            $table->string('color',50)->nullable();
            $table->double('unit_price',10,2);
            $table->string('status',50);
            $table->string('image',50);
            $table->string('serv_code',50);


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_category');
    }
};
