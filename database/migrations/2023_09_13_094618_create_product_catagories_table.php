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
        Schema::create('product_catagories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->index()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('catagory_id')->index()->constrained()->onDelete('cascade')->onUpdate('cascade');
            // $table->unsignedBigInteger('product_id');
            // $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');
            // $table->unsignedBigInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_catagories');
    }
};
