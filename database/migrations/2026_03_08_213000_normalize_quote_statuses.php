<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('quotes')
            ->whereIn('status', ['started', 'sent', 'approved', 'finished', 'invoiced'])
            ->update(['status' => 'emitted']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('quotes')
            ->where('status', 'emitted')
            ->update(['status' => 'invoiced']);
    }
};
