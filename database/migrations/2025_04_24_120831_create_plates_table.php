<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('emirate_id')->constrained('emirates')->onDelete('cascade');
            $table->foreignId('code_id')->constrained('codes')->onDelete('cascade');
            $table->string('number', 5);
            $table->unsignedTinyInteger('length');
            $table->string('image')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_sold')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_premium')->default(false);
            $table->boolean('is_urgent')->default(false);
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            
            // Add indexes for better performance
            $table->index('is_visible');
            $table->index('is_approved');
            $table->index('is_sold');
            $table->index('is_featured');
            $table->index('is_premium');
            $table->index('is_urgent');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plates');
    }
}; 