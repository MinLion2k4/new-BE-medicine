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
        Schema::create('accounts', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('full_name', 255)->nullable();
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('token', 255)->nullable();
            $table->string('phone', 10)->nullable();
            $table->boolean('status')->default(1);
            $table->string('role', 10)->nullable();
           // $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
