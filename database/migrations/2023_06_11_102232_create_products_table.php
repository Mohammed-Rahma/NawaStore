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
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
           
            // $table->foreign('category_id')->references('id')->on('categories');
            $table->foreignId('category_id')->nullable()
                  ->constrained('catrgories','id')
                  ->nullOnDelete();

            // $table->unsignedBigInteger('category_id');
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->float('compare_price')->nullable();
            $table->string('image');
            $table->enum('status' , ['draft' , 'active' , 'archived'])->default('active');
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
