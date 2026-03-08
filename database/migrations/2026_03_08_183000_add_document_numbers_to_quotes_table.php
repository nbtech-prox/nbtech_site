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
        Schema::table('quotes', function (Blueprint $table): void {
            $table->string('proforma_number')->nullable()->after('number')->unique();
            $table->string('invoice_receipt_number')->nullable()->after('proforma_number')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table): void {
            $table->dropUnique(['proforma_number']);
            $table->dropUnique(['invoice_receipt_number']);
            $table->dropColumn(['proforma_number', 'invoice_receipt_number']);
        });
    }
};
