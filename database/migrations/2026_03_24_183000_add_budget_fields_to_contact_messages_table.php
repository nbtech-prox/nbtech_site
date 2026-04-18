<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table): void {
            $table->string('type', 20)->default('contact')->after('company');
            $table->string('phone', 40)->nullable()->after('type');
            $table->string('project_type', 50)->nullable()->after('phone');
            $table->string('budget_range', 50)->nullable()->after('project_type');
            $table->string('timeline', 50)->nullable()->after('budget_range');
        });
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table): void {
            $table->dropColumn(['type', 'phone', 'project_type', 'budget_range', 'timeline']);
        });
    }
};
