<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table): void {
            $table->string('slug')->nullable()->after('title');
            $table->string('meta_title')->nullable()->after('order');
            $table->text('meta_description')->nullable()->after('meta_title');
        });

        $connection = Schema::getConnection();

        $services = $connection->table('services')->select('id', 'title')->orderBy('id')->get();

        $used = [];

        foreach ($services as $service) {
            $base = Str::slug($service->title) ?: 'service';
            $slug = $base;
            $suffix = 2;

            while (in_array($slug, $used, true)) {
                $slug = $base.'-'.$suffix;
                $suffix++;
            }

            $used[] = $slug;

            $connection->table('services')->where('id', $service->id)->update([
                'slug' => $slug,
                'meta_title' => $service->title.' | NBTech',
                'meta_description' => Str::limit('Conhece o serviço '.$service->title.' da NBTech e percebe como podemos ajudar a melhorar clareza, performance e crescimento digital.', 300),
            ]);
        }

        Schema::table('services', function (Blueprint $table): void {
            $table->string('slug')->nullable(false)->change();
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table): void {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'meta_title', 'meta_description']);
        });
    }
};
