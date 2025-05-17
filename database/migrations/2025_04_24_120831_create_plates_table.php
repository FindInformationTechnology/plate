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
        Schema::create('plates', function (Blueprint $table) {
            $table->id();

            // Ownership
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Related to emirate
            $table->foreignId('emirate_id')->constrained()->onDelete('cascade');

            $table->foreignId('code_id')->constrained()->onDelete('cascade');
            // Plate details
            $table->string('number', 5); // max 5 digits/letters
            $table->unsignedTinyInteger('length'); // auto-filled

            $table->string('image')->nullable();
            

            // Business logic
            $table->decimal('price', 10, 2)->nullable();
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_sold')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->timestamp('approved_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plates');
    }
};
