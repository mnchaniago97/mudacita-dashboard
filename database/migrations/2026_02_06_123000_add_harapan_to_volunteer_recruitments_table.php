<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('volunteer_recruitments', function (Blueprint $table) {
            $table->text('harapan')->nullable()->after('keperluan_lainnya');
        });
    }

    public function down(): void
    {
        Schema::table('volunteer_recruitments', function (Blueprint $table) {
            $table->dropColumn('harapan');
        });
    }
};
