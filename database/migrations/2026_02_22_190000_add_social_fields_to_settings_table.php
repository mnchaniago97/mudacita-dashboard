<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'org_instagram')) {
                $table->text('org_instagram')->nullable()->after('org_address');
            }
            if (!Schema::hasColumn('settings', 'org_twitter')) {
                $table->text('org_twitter')->nullable()->after('org_instagram');
            }
            if (!Schema::hasColumn('settings', 'org_facebook')) {
                $table->text('org_facebook')->nullable()->after('org_twitter');
            }
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (Schema::hasColumn('settings', 'org_instagram')) {
                $table->dropColumn('org_instagram');
            }
            if (Schema::hasColumn('settings', 'org_twitter')) {
                $table->dropColumn('org_twitter');
            }
            if (Schema::hasColumn('settings', 'org_facebook')) {
                $table->dropColumn('org_facebook');
            }
        });
    }
};
