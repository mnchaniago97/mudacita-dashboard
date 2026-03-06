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
        Schema::table('recruitments', function (Blueprint $table) {
            if (!Schema::hasColumn('recruitments', 'photo_path')) {
                $table->string('photo_path')->nullable();
            }
            if (!Schema::hasColumn('recruitments', 'screenshot_path')) {
                $table->string('screenshot_path')->nullable();
            }
            if (!Schema::hasColumn('recruitments', 'cv_path')) {
                $table->string('cv_path')->nullable();
            }
            if (!Schema::hasColumn('recruitments', 'jabatan')) {
                $table->string('jabatan')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recruitments', function (Blueprint $table) {
            if (Schema::hasColumn('recruitments', 'photo_path')) {
                $table->dropColumn('photo_path');
            }
            if (Schema::hasColumn('recruitments', 'screenshot_path')) {
                $table->dropColumn('screenshot_path');
            }
            if (Schema::hasColumn('recruitments', 'cv_path')) {
                $table->dropColumn('cv_path');
            }
            if (Schema::hasColumn('recruitments', 'jabatan')) {
                $table->dropColumn('jabatan');
            }
        });
    }
};
