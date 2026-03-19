<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recruitments', function (Blueprint $table) {
            if (!Schema::hasColumn('recruitments', 'screenshot_path')) {
                $table->text('screenshot_path')->nullable()->after('photo_path');
            }

            if (!Schema::hasColumn('recruitments', 'cv_path')) {
                $table->string('cv_path')->nullable()->after('screenshot_path');
            }
        });

        // Ensure multi-file JSON path can be saved safely without truncation.
        if (Schema::hasColumn('recruitments', 'screenshot_path') && DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE recruitments MODIFY screenshot_path TEXT NULL');
        }
    }

    public function down(): void
    {
        // No destructive rollback to avoid removing existing production data.
    }
};
