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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->float('amount')->default(0);
            $table->enum('source', ['cod', 'credit', 'debet', 'apple', 'google', 'other'])->default('other');
            $table->enum('status', ['pending', 'complete', 'refund', 'partical', 'active', 'inactive', 'other'])->default('other');
            $table->text('note')->nullable();

            $table->foreignId('order_id')->index()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->index()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
