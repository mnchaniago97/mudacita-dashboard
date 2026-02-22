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
            $table->string('pilar1_subtitle')->nullable()->after('pilar1_title');
            $table->string('pilar2_subtitle')->nullable()->after('pilar2_title');
            $table->string('pilar3_subtitle')->nullable()->after('pilar3_title');
            $table->string('pilar4_subtitle')->nullable()->after('pilar4_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'pilar1_subtitle',
                'pilar2_subtitle',
                'pilar3_subtitle',
                'pilar4_subtitle',
            ]);
        });
    }
};
