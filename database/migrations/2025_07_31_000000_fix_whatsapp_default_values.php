<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix existing users with default WhatsApp values
        DB::table('users')
            ->where('whatsapp', '000000000')
            ->orWhere('whatsapp', '')
            ->orWhereNull('whatsapp')
            ->update(['whatsapp' => null]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse this migration
    }
}; 