<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('hero_title')->nullable()->after('whatsapp_template');
            $table->string('hero_subtitle')->nullable()->after('hero_title');
            $table->text('hero_description')->nullable()->after('hero_subtitle');
            $table->string('hero_image_path')->nullable()->after('hero_description');
            $table->string('org_favicon_path')->nullable()->after('hero_image_path');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['hero_title', 'hero_subtitle', 'hero_description', 'hero_image_path']);
        });
    }
};
