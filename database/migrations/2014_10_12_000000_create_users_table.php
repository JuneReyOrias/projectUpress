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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username',50)->nullable();
            $table->string('firstname',50);
            $table->string('lastname',50);
            $table->string('college',50);
            $table->string('department',50);
            $table->string('image');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('contact_no',50);
            $table->string('password');
            $table->enum('role',['admin','staff', 'customer'])->default('customer');
            $table->string('cust_code',50);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
