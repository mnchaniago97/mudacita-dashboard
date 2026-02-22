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
            $table->text('impact_1_number')->nullable();
            $table->text('impact_1_title')->nullable();
            $table->text('impact_1_date')->nullable();
            $table->text('impact_1_text')->nullable();
            $table->text('impact_1_url')->nullable();

            $table->text('impact_2_number')->nullable();
            $table->text('impact_2_title')->nullable();
            $table->text('impact_2_date')->nullable();
            $table->text('impact_2_text')->nullable();
            $table->text('impact_2_url')->nullable();

            $table->text('impact_3_number')->nullable();
            $table->text('impact_3_title')->nullable();
            $table->text('impact_3_date')->nullable();
            $table->text('impact_3_text')->nullable();
            $table->text('impact_3_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'impact_1_number', 'impact_1_title', 'impact_1_date', 'impact_1_text', 'impact_1_url',
                'impact_2_number', 'impact_2_title', 'impact_2_date', 'impact_2_text', 'impact_2_url',
                'impact_3_number', 'impact_3_title', 'impact_3_date', 'impact_3_text', 'impact_3_url',
            ]);
        });
    }
};
