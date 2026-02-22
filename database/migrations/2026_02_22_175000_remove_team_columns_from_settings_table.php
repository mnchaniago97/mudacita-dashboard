<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $columns = [];
            for ($i = 1; $i <= 12; $i++) {
                $columns[] = "team_{$i}_name";
                $columns[] = "team_{$i}_role";
                $columns[] = "team_{$i}_image";
                $columns[] = "team_{$i}_facebook";
                $columns[] = "team_{$i}_twitter";
                $columns[] = "team_{$i}_instagram";
            }

            $existing = array_values(array_filter($columns, fn ($col) => Schema::hasColumn('settings', $col)));
            if (count($existing) > 0) {
                $table->dropColumn($existing);
            }
        });
    }

    public function down(): void
    {
        // Intentionally left empty. Team data now stored in about_teams JSON.
    }
};
