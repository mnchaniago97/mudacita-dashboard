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
            // Hero Buttons
            $table->string('hero_btn1_text')->nullable()->after('hero_image_path');
            $table->string('hero_btn1_url')->nullable()->after('hero_btn1_text');
            $table->string('hero_btn2_text')->nullable()->after('hero_btn1_url');
            $table->string('hero_btn2_url')->nullable()->after('hero_btn2_text');

            // About Section
            $table->string('about_title')->nullable()->after('hero_btn2_url');
            $table->text('about_description')->nullable()->after('about_title');
            $table->string('about_image_path')->nullable()->after('about_description');
            $table->string('about_btn_text')->nullable()->after('about_image_path');
            $table->string('about_btn_url')->nullable()->after('about_btn_text');

            // Visi Section
            $table->text('visi_description')->nullable()->after('about_btn_url');
            $table->string('visi_author_name')->nullable()->after('visi_description');
            $table->string('visi_author_title')->nullable()->after('visi_author_name');
            $table->string('visi_author_image')->nullable()->after('visi_author_title');

            // Misi Section
            $table->json('misi_list')->nullable()->after('visi_author_image');
            $table->string('misi_author_name')->nullable()->after('misi_list');
            $table->string('misi_author_title')->nullable()->after('misi_author_name');
            $table->string('misi_author_image')->nullable()->after('misi_author_title');

            // Pilar Section
            $table->string('pilar_section_title')->nullable()->after('misi_author_image');
            $table->string('pilar1_title')->nullable()->after('pilar_section_title');
            $table->text('pilar1_description')->nullable()->after('pilar1_title');
            $table->string('pilar1_image_path')->nullable()->after('pilar1_description');
            $table->string('pilar2_title')->nullable()->after('pilar1_image_path');
            $table->text('pilar2_description')->nullable()->after('pilar2_title');
            $table->string('pilar2_image_path')->nullable()->after('pilar2_description');
            $table->string('pilar3_title')->nullable()->after('pilar2_image_path');
            $table->text('pilar3_description')->nullable()->after('pilar3_title');
            $table->string('pilar3_image_path')->nullable()->after('pilar3_description');
            $table->string('pilar4_title')->nullable()->after('pilar3_image_path');
            $table->text('pilar4_description')->nullable()->after('pilar4_title');
            $table->string('pilar4_image_path')->nullable()->after('pilar4_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_btn1_text', 'hero_btn1_url', 'hero_btn2_text', 'hero_btn2_url',
                'about_title', 'about_description', 'about_image_path', 'about_btn_text', 'about_btn_url',
                'visi_description', 'visi_author_name', 'visi_author_title', 'visi_author_image',
                'misi_list', 'misi_author_name', 'misi_author_title', 'misi_author_image',
                'pilar_section_title',
                'pilar1_title', 'pilar1_description', 'pilar1_image_path',
                'pilar2_title', 'pilar2_description', 'pilar2_image_path',
                'pilar3_title', 'pilar3_description', 'pilar3_image_path',
                'pilar4_title', 'pilar4_description', 'pilar4_image_path',
            ]);
        });
    }
};
