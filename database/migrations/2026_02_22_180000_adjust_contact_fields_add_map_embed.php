<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (Schema::hasColumn('settings', 'kontak_hero_title')) {
                $table->dropColumn('kontak_hero_title');
            }
            if (Schema::hasColumn('settings', 'kontak_hero_subtitle')) {
                $table->dropColumn('kontak_hero_subtitle');
            }
            if (!Schema::hasColumn('settings', 'org_map_embed')) {
                $table->text('org_map_embed')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'kontak_hero_title')) {
                $table->text('kontak_hero_title')->nullable();
            }
            if (!Schema::hasColumn('settings', 'kontak_hero_subtitle')) {
                $table->text('kontak_hero_subtitle')->nullable();
            }
            if (Schema::hasColumn('settings', 'org_map_embed')) {
                $table->dropColumn('org_map_embed');
            }
        });
    }
};
