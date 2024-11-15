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
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id', 10)->autoIncrement()->primary();
            $table->string('name', 255)->nullable();
            $table->string('other_name', 255)->nullable();        
            $table->string('scientific_name', 255)->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->integer('stock')->nullable();
            $table->string('origin', 255)->nullable();
            $table->date('expiry')->nullable();
            $table->text('image')->nullable();
            $table->string('category_id', 10)->nullable();
            $table->foreign('category_id')->references('id')->on('type_products')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
