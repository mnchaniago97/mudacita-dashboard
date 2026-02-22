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
        Schema::table('settings', function (Blueprint $table) {
            $teamColumns = [];
            for ($i = 1; $i <= 12; $i++) {
                $teamColumns[] = "team_{$i}_name";
                $teamColumns[] = "team_{$i}_role";
                $teamColumns[] = "team_{$i}_image";
                $teamColumns[] = "team_{$i}_facebook";
                $teamColumns[] = "team_{$i}_twitter";
                $teamColumns[] = "team_{$i}_instagram";
            }
            $existingTeams = array_values(array_filter($teamColumns, fn ($col) => Schema::hasColumn('settings', $col)));
            if (count($existingTeams) > 0) {
                $table->dropColumn($existingTeams);
            }

            if (!Schema::hasColumn('settings', 'tentang_hero_image')) {
                $table->text('tentang_hero_image')->nullable();
            }
            if (!Schema::hasColumn('settings', 'about_intro_image')) {
                $table->text('about_intro_image')->nullable();
            }
            if (!Schema::hasColumn('settings', 'about_value_image_1')) {
                $table->text('about_value_image_1')->nullable();
            }
            if (!Schema::hasColumn('settings', 'about_value_image_2')) {
                $table->text('about_value_image_2')->nullable();
            }
            if (!Schema::hasColumn('settings', 'about_value_image_3')) {
                $table->text('about_value_image_3')->nullable();
            }
            if (!Schema::hasColumn('settings', 'about_overlay_image')) {
                $table->text('about_overlay_image')->nullable();
            }
            if (!Schema::hasColumn('settings', 'about_teams')) {
                $table->text('about_teams')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $columns = [
                'tentang_hero_image',
                'about_intro_image',
                'about_value_image_1',
                'about_value_image_2',
                'about_value_image_3',
                'about_overlay_image',
                'about_teams',
            ];
            $existing = array_values(array_filter($columns, fn ($col) => Schema::hasColumn('settings', $col)));
            if (count($existing) > 0) {
                $table->dropColumn($existing);
            }
        });
    }
};
