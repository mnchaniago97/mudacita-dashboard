<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'kontak_faq_title')) {
                $table->text('kontak_faq_title')->nullable()->after('org_facebook');
            }
            if (!Schema::hasColumn('settings', 'kontak_faq_subtitle')) {
                $table->text('kontak_faq_subtitle')->nullable()->after('kontak_faq_title');
            }
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (Schema::hasColumn('settings', 'kontak_faq_title')) {
                $table->dropColumn('kontak_faq_title');
            }
            if (Schema::hasColumn('settings', 'kontak_faq_subtitle')) {
                $table->dropColumn('kontak_faq_subtitle');
            }
        });
    }
};
